<?php
namespace App\Libraries;

use Exception;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\URI;
use CodeIgniter\HTTP\UserAgent;


use stdClass;

class Yt
{
    const JSON_REGEX = '/{"responseContext":(.*)}/';
    const BODY_REGEX = '/<body .*>(.*?)<\/body>/s';

    private bool $forceJson;

    public function __construct($forceJson = false)
    {
        $this->forceJson = $forceJson;
    }

    public function get(string $videoId)
    {
        $client = new CURLRequest();
        $headers = $this->forceJson ? [
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36',
        ] : [
            'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ];
        $response = $client->get('https://www.youtube.com/watch?v=' . $videoId, [], ['headers' => $headers]);

        $html = $response->getBody();
        preg_match(self::JSON_REGEX, $html, $matches);
        if (isset($matches[0])) {
            $contents = json_decode($matches[0])
                ->contents
                ->twoColumnWatchNextResults
                ->results
                ->results
                ->contents;
            $primary = $contents[0]->videoPrimaryInfoRenderer;
            $secondary = $contents[1]->videoSecondaryInfoRenderer;
            $description = join('', array_map(fn ($d) => $d->text, isset($secondary->description) ? $secondary->description->runs : []));

            return (object) [
                'title' => $primary->title->runs[0]->text,
                'description' => $description,
                'viewCount' => $this->viewsToInt(
                    $primary->viewCount->videoViewCountRenderer->viewCount->simpleText
                ),
                'date' => $this->parseDate($primary->dateText->simpleText),
            ];
        }
        return $this->getParseHTML($html);
    }

    private function parseDate($date)
    {
        return str_replace(['Premiered ','Published on ', ','], ['', '', ''], $date);
    }

    public function getParseHTML($html)
    {
        preg_match(self::BODY_REGEX, $html, $matches);
        $crawler = new Crawler($matches[0]);

        $title = $crawler->filter('#eow-title')->text();
        $description = strip_tags(
            $crawler->filter('#eow-description')->html(),
            '<br>');
        $viewCount = $crawler->filter('.watch-view-count')->text();
        $date = $crawler->filter('.watch-time-text')->text();
        return (object) [
            'title' => $title,
            'description' => str_replace('<br>', "\n",$description),
            'viewCount' => $this->viewsToInt($viewCount),
            'date' => $this->parseDate($date),
        ];
    }

    public function viewsToInt(string $text): int {
        return (int) str_replace([' views', ','], ['', ''], $text);
    }

public function search(string $term, int $page = 1): array
{
    $request = service('request');
    $client = \Config\Services::curlrequest([
        'base_uri' => 'https://www.youtube.com/',
        'headers' => $this->forceJson ? [
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36',
        ] : [
            'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ],
    ]);
    
    $response = $client->get('results?page=' . $page . '&search_query=' . urlencode($term));
    $html = $response->getBody();
    
    return $this->searchParseHTML($html);
}

public function searchParseJson($json): array
{
        $decodedJson = json_decode($json);
        print_r($decodedJson);
        exit();
    $contents = $decodedJson
        ->contents
        ->twoColumnSearchResultsRenderer
        ->primaryContents
        ->sectionListRenderer
        ->contents[0]
        ->itemSectionRenderer
        ->contents;
    $results = [];
    foreach ($contents as $video) {
        if (property_exists($video, 'videoRenderer')) {
            $results[] = (object) [
                'id' => $video->videoRenderer->videoId,
                'title' => $video->videoRenderer->title->runs[0]->text,
            ];
        }
    }
    return $results;
}

private function searchParseHTML($html): array
{
    preg_match(self::BODY_REGEX, $html, $matches);
    $dom = new \DOMDocument();

    libxml_use_internal_errors(true);
    $dom->loadHTML($matches[0]);
    libxml_clear_errors();

    $xpath = new \DOMXPath($dom);
    $items = $xpath->query("//li[contains(@class, 'yt-uix-tile')]");
    $results = [];

    foreach ($items as $item) {
        $result = $this->parseNodeWithDOM($item, $xpath);
        if (property_exists($result, 'id')) {
            $results[] = $result;
        }
    }

    return $results;
}

private function parseNodeWithDOM(\DOMElement $node, \DOMXPath $xpath): object
{
    try {
        $anchor = $xpath->query(".//a[contains(@class, 'yt-uix-tile-link')]", $node)->item(0);
        $videoId = substr($anchor->getAttribute('href'), 9);
        $title = $anchor->getAttribute('title');

        return (object) [
            'id' => $videoId,
            'title' => $title,
        ];
    } catch (\Exception $exception) {}

    return new stdClass();
}



private function parseNode(Crawler $node): object
{
    try {
        return (object) [
            'id' => substr(
                $node->filter('.yt-lockup-title > a')->attr('href'),
                9
            ),
            'title' => $node->filter('.yt-lockup-title > a')->attr('title'),
        ];
    } catch (Exception $exception) {}
    return new stdClass();
}

}
