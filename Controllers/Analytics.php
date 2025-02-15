<?php
namespace App\Controllers;
use App\Models\BlogModel;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

class Analytics extends BaseController {

	public function index() {
		$total_visitor = $this->total_visitor();
		print_r($total_visitor);
		exit();
		$data['visitor']['total'] = $total_visitor['total'];
		$data['visitor']['last7'] = $total_visitor['last7'];
		$data['visitor']['today'] = $total_visitor['today'];
		$data['visitor']['yesterday'] = $total_visitor['yesterday'];
		$data['visitor']['popular_pages_thismonth'] = $this->popular_pages('thismonth');
		$data['visitor']['popular_pages_today'] = $this->popular_pages('today');
		$data['visitor']['popular_pages_yesterday'] = $this->popular_pages('yesterday');

		return view('admin/analytics/index', $data);

	}

    public function real_time() {

    }

	public function real_time2() {
		if ((!empty(siteSet('gAnalytics_ViewId'))) OR (siteSet('gAnalytics_ViewId') != 0) ) {

			$client = new \Google_Client();
			$client->setAuthConfig('public/upload/'.siteSet('gAnalytics_jsonFile'));
			$client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
			$analytics = new \Google_Service_Analytics($client);

			$result = $analytics->data_realtime->get('ga:'.siteSet('gAnalytics_ViewId'), 'rt:activeVisitors', ['dimensions' => 'rt:pagePath,rt:country,rt:city,rt:longitude,rt:latitude,rt:deviceCategory,rt:browser']);
			$arr = ['online' => $result->getTotalResults(), 'data' => $result->getRows()];
			echo json_encode($arr);
		}
	}

public function total_visitor() {
	$property_id = '373470302';

	// Using a default constructor instructs the client to use the credentials
	// specified in GOOGLE_APPLICATION_CREDENTIALS environment variable.
	$client = new BetaAnalyticsDataClient([
        'credentials' => 'public/upload/'.siteSet('gAnalytics_jsonFile')
    ]);

	// Make an API call.
	$response = $client->runReport([
	    'property' => 'properties/' . $property_id,
	    'dateRanges' => [
	        new DateRange([
	            'start_date' => '2020-03-31',
	            'end_date' => 'today',
	        ]),
	    ],
	    'dimensions' => [new Dimension(
	        [
	            'name' => 'city',
	        ]
	    ),
	    ],
	    'metrics' => [new Metric(
	        [
	            'name' => 'activeUsers',
	        ]
	    )
	    ]
	]);

	// Print results of an API call.
	print 'Report result: ' . PHP_EOL;

	foreach ($response->getRows() as $row) {
	    print $row->getDimensionValues()[0]->getValue()
	        . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
	}
}


	public function total_visitor2() {
		if ((!empty(siteSet('gAnalytics_ViewId'))) OR (siteSet('gAnalytics_ViewId') != 0) ) {

			$client = new \Google_Client();
			$client->setAuthConfig('public/upload/'.siteSet('gAnalytics_jsonFile'));
			$client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
			$analytics = new \Google_Service_Analytics($client);

			$total = $analytics->data_ga->get('ga:'.siteSet('gAnalytics_ViewId'), '999daysAgo', 'today', 'ga:users');
			$last7 = $analytics->data_ga->get('ga:'.siteSet('gAnalytics_ViewId'), '7daysAgo', 'today', 'ga:users');
			$today = $analytics->data_ga->get('ga:'.siteSet('gAnalytics_ViewId'), '0daysAgo', 'today', 'ga:users');
			$yesterday = $analytics->data_ga->get('ga:'.siteSet('gAnalytics_ViewId'), 'yesterday', 'yesterday', 'ga:users');

			if (!empty($total->getRows())) { $data['total'] = $total->getRows()[0][0]; } else { $data['total'] = 0;}
			if (!empty($last7->getRows())) { $data['last7'] = $last7->getRows()[0][0]; } else { $data['last7'] = 0;}
			if (!empty($today->getRows())) { $data['today'] = $today->getRows()[0][0]; } else { $data['today'] = 0;}
			if (!empty($yesterday->getRows())) { $data['yesterday'] = $yesterday->getRows()[0][0]; } else { $data['yesterday'] = 0;}
			if (!empty($data)) { return $data; } 
		}
	}

	public function popular_pages($day) {
		if ((!empty(siteSet('gAnalytics_ViewId'))) OR (siteSet('gAnalytics_ViewId') != 0) ) {

			$client = new \Google_Client();
			$client->setAuthConfig('public/upload/'.siteSet('gAnalytics_jsonFile'));
			$client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
			$analytics = new \Google_Service_Analytics($client);
			$optParams = array('max-results' => 10, 'dimensions' => 'ga:pageTitle, ga:pagePath, ga:sessionCount', 'sort' => '-ga:pageviews');
			if ($day == 'thismonth') {
				$result = $analytics->data_ga->get('ga:'.siteSet('gAnalytics_ViewId'), '30daysAgo', 'today', 'ga:pageviews', $optParams);
			} else if ($day == 'today') {
				$result = $analytics->data_ga->get('ga:'.siteSet('gAnalytics_ViewId'), '0daysAgo', 'today', 'ga:pageviews', $optParams);
			} else if ($day == 'yesterday') {
				$result = $analytics->data_ga->get('ga:'.siteSet('gAnalytics_ViewId'), 'yesterday', 'yesterday', 'ga:pageviews', $optParams);
			}
			if (!empty($result->getRows())) { return $result->getRows(); }
		}
	}

}
