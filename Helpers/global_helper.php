<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014-2019 British Columbia Institute of Technology
 * Copyright (c) 2019-2020 CodeIgniter Foundation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *x
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    CodeIgniter
 * @author     CodeIgniter Dev Team
 * @copyright  2019-2020 CodeIgniter Foundation
 * @license    https://opensource.org/licenses/MIT    MIT License
 * @link       https://codeigniter.com
 * @since      Version 4.0.0
 * @filesource
 */

/**
 * CodeIgniter Date Helpers
 *
 * @package CodeIgniter
 */
            
// get Site Config
if(! function_exists('siteSet')) {
	function siteSet($var) {
		$db = \Config\Database::connect();		
		$t = $db->query("SELECT $var FROM settings WHERE _id = 1")->getRow();
		return $t->$var;
	}
}

function convertDuration($duration) {
    $parts = explode(':', $duration);
    $minutes = $parts[0];
    $seconds = $parts[1];
    $totalSeconds = ($minutes * 60) + $seconds;
    $formattedDuration = 'PT' . $minutes . 'M' . $seconds . 'S';
    return $formattedDuration;
}

function hexToRgb($hex) {
  $hex = str_replace("#", "", $hex);
  if(strlen($hex) == 3) {
    $r = hexdec(substr($hex,0,1).substr($hex,0,1));
    $g = hexdec(substr($hex,1,1).substr($hex,1,1));
    $b = hexdec(substr($hex,2,1).substr($hex,2,1));
  } else {
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
  }
  return array($r, $g, $b);
}

function add_class_based_on_value($i) {
    if (!is_numeric($i) || $i == '') {
        return 'text-muted';
    } elseif ($i <= 10) {
        return 'text-muted';
    } elseif ($i <= 29) {
        return 'text-success';
    } elseif ($i <= 50) {
        return 'text-warning';
    } elseif ($i <= 70) {
        return 'text-deepOrange';
    } else {
        return 'text-danger';
    }
}

function index_format_number($number) {
    if ($number >= 1000000000) {
        return round($number / 1000000000, 1) . 'B';
    } elseif ($number >= 1000000) {
        return round($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000) {
        return round($number / 1000, 1) . 'K';
    } else {
        return $number;
    }
}

if (! function_exists('totalComments')) {
	function totalComments($blog_id) {
		$db = \Config\Database::connect();
		$query = $db->query("SELECT * FROM comments WHERE status = 'active' AND blog_id = $blog_id ");
		$results = $query->getResult();
		
		return count($results);
	}
}

function formatDateTime($datetime) {
    $date = new DateTime($datetime);
    $formatted = $date->format('Y-m-d\TH:i:sP');
    return $formatted;
}

function getRandomKeyword($text) {
	// Metindeki kelime öbeklerini bir diziye ayır
	$keywordGroups = explode(',', $text);

	$longestKeywordLength = 0;
	$longestKeywordGroups = [];

	// En uzun kelime öbeklerini bul
	foreach ($keywordGroups as $keywordGroup) {
		$keywordGroup = trim($keywordGroup);
		$keywordLength = strlen($keywordGroup);

		// Kelime öbeği, daha önceki en uzun kelime öbeklerinden daha uzunsa, güncelle
		if ($keywordLength > $longestKeywordLength) {
			$longestKeywordLength = $keywordLength;
			$longestKeywordGroups = [$keywordGroup];
		} else if ($keywordLength == $longestKeywordLength) {
			$longestKeywordGroups[] = $keywordGroup;
		}
	}

	// En uzun kelime öbeklerinden rastgele birini seç
	$randomIndex = array_rand($longestKeywordGroups);
	$randomKeywordGroup = $longestKeywordGroups[$randomIndex];

	return $randomKeywordGroup;
}

if (! function_exists('getBlogImage')) {
	function getBlogImage($image = NULL) {
		$cdn_url = getenv('site.cdnUrl');
		if (!empty($cdn_url)) {
			$image_url = $cdn_url; 
		} else {
			$image_url = getenv('app.baseURL');
		}
		
		if (!empty($image)) {
			return $image_url.'/public/upload/blog/'.$image;
		} else {
			return $image_url.'/public/upload/blog/no-image.png';
		}
	}
}

if (! function_exists('getAuthorAvatarImage')) {
	function getAuthorAvatarImage($image = NULL) {
		$cdn_url = getenv('site.cdnUrl');
		if (!empty($cdn_url)) {
			$image_url = $cdn_url; 
		} else {
			$image_url = getenv('app.baseURL');
		}
		
		if (!empty($image)) {
			return $image_url.'/public/upload/authors/'.$image;
		} else {
			return $image_url.'/public/upload/authors/no-image.png';
		}
	}
}



if (! function_exists('getBlogContentImage')) {
	function getBlogContentImage($image = NULL) {
		$cdn_url = getenv('site.cdnUrl');
		if (!empty($cdn_url)) {
			$image_url = $cdn_url; 
		} else {
			$image_url = getenv('app.baseURL');
		}
		
		if (!empty($image)) {
			return $image_url.'/public/upload/blog/'.$image;
		}
	}
}



if(!function_exists('getblogSeoUrl')) {
	function getblogSeoUrl($seo_name, $_id) {
		return getenv('app.baseURL').'/'.$seo_name.'-'.hash_encode($_id).'.html';
	}
}

if(!function_exists('getpageSeoUrl')) {
	function getpageSeoUrl($seo_name, $_id) {
		return getenv('app.baseURL').'/p/'.$seo_name.'-'.$_id.'.html';
	}
}

// HASH Encode
if(!function_exists('hash_encode')) {
	function hash_encode($id) {
		$hashids = new Hashids\Hashids('TROAS', 0, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
		$hash_id = $hashids->encode($id);
		return $hash_id; 
	}
}


if(!function_exists('hash_decode')) {
	function hash_decode($id) {
		$hashids = new Hashids\Hashids('TROAS', 0, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
		$hash_id = $hashids->decode($id);
		return $hash_id; 
	}
}

if(!function_exists('trtarihsaat')) {
	function trtarihsaat($date) {
		if (!empty($date)) {
			$sonuc	= date('d/m/Y H:i:s', strtotime($date));
			return $sonuc;
		}
	}
}

if(!function_exists('trtarih')) {
	function trtarih($date) {
		if (!empty($date)) {
			$sonuc	= date('d/m/Y', strtotime($date));
			return $sonuc;
		}
	}
}

function link_keywords($content) {
    // Define your keywords and their corresponding URLs in an associative array
    $keywords = array(
        'Smart Home' => '/page1.php',
        'keyword2' => '/page2.php',
        'keyword3' => '/page3.php'
    );

    // Initialize a variable to count the number of replacements
    $replacements = 0;

    // Loop through each keyword and replace it with a link to the corresponding page
    foreach ($keywords as $keyword => $url) {
        // Check if the keyword exists in the content as a whole word
        $pattern = "/\b" . preg_quote($keyword) . "\b/i";
        $matches = preg_match_all($pattern, $content, $matchesArray);

        if ($matches > 0 && $replacements < 2) {
            // Replace up to 2 occurrences of the keyword with a link to the corresponding page
            for ($i = 0; $i < min($matches, 2 - $replacements); $i++) {
                $content = preg_replace($pattern, "<a href='$url'>$keyword</a>", $content, 1);
                $replacements++;
            }
        }
    }

    return $content;
}


function download_image_and_convert_to_webp($image_url, $save_path, $quality = 80) {

//$image_url = 'https://images.unsplash.com/photo-1234567890';
//$save_path = 'path/to/new/image.webp';
//$quality = 80;
//download_image_and_convert_to_webp($image_url, $save_path, $quality);

    $image_data = file_get_contents($image_url);
    $image = imagecreatefromstring($image_data);
    imagewebp($image, $save_path, $quality);
    imagedestroy($image);
}


function insert_image_at_interval($content, $interval, $image_title, $image_src = NULL) {

    if (empty($image_src)) {
        return $content;
    }

    // Split the content into paragraphs
    $paragraphs = explode('</p>', $content);

    // Insert the image HTML after the specified paragraph
    $counter = 0;
    $result = '';
    $inserted = false;
    foreach ($paragraphs as $index => $paragraph) {
        // Append the paragraph to the result
        $result .= $paragraph . '</p>';

        // Increment the counter
        $counter++;

        // Check if it's time to insert the image
        if ($counter == $interval && !$inserted && isset($paragraphs[$index+1])) {
            // Insert the image HTML code
            $result .= '<p><img class="lazy contentImage" data-original="' . $image_src . '" src="' . $image_src . '" title="'.$image_title.'" alt="'.$image_title.'"></p>';

            // Set inserted flag to true
            $inserted = true;
        }
    }

    return $result;
}


function add_headings($content) {
    $dom = new DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $xpath = new DOMXPath($dom);
    
    // get all the <p><strong> tags
    $p_strong_tags = $xpath->query('//p/strong');
    $heading_level = 3; // start with h3
    $last_subheading_level = 0; // initialize the last subheading level to 0
    $table_of_contents = '<div class="table-of-contents"><ul>';

    
    foreach ($p_strong_tags as $tag) {
        // create a new heading element
		$heading_text = htmlspecialchars($tag->nodeValue, ENT_QUOTES | ENT_HTML5);
		$heading = $dom->createElement("h$heading_level", $heading_text);
        
        // add an ID attribute to the heading element based on the text content
        $id = strtolower(str_replace(' ', '-', $tag->nodeValue));
        $heading->setAttribute('id', $id);
        
        // add a table of contents item for the heading
        $table_of_contents .= "<li><a href='#$id'>$tag->nodeValue</a></li>";
        
        // replace the <strong> tag with the new heading element
        $tag->parentNode->replaceChild($heading, $tag);
        
        // update the last subheading level
        $last_subheading_level = $heading_level;
        
        // increment the heading level up to h6, but don't go beyond if there are more subheadings
        if ($heading_level < 6 && $xpath->query("following-sibling::p/strong", $tag)->length == 0) {
            $heading_level++;
        }
    }
    
    // if the last subheading is h6, set the remaining subheadings to h6 as well
    if ($last_subheading_level == 6) {
        $p_strong_tags = $xpath->query('//p/strong');
        foreach ($p_strong_tags as $tag) {
            $heading = $dom->createElement("h6", $tag->nodeValue);
            $tag->parentNode->replaceChild($heading, $tag);
        }
    }
    
    // close the table of contents
    $table_of_contents .= '</ul></div>';

    
    // add the table of contents to the beginning of the content
    $new_content = $table_of_contents . $dom->saveHTML();
    
    return $new_content;
}


if(!function_exists('uzun_metin_kes')) {
	function uzun_metin_kes($metin, $karakter) {
	  $metin =(mb_strlen($metin,'UTF-8') > $karakter ) ? mb_substr($metin,0,$karakter,'UTF-8').'...' : $metin;
	  return $metin;
	}
}

function calculate_reading_time($content) {
    $content = strip_tags($content); 
    $word_count = str_word_count($content);
    $reading_time = ceil($word_count / 200);
    return $reading_time;
}

if(!function_exists('seflink')) {
	function seflink($text) {
		$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
		$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
		$text = strtolower(str_replace($find, $replace, $text));
		$text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
		$text = trim(preg_replace('/\s+/', ' ', $text));
		$text = str_replace(' ', '-', $text);
		$text = str_replace('.', '', $text);
		$text = str_replace(',', '', $text);
		return $text;
	}
}

function specialCharClear($data_str) {
	$data_str =str_replace("`","",$data_str);
	$data_str =str_replace("=","",$data_str);
	$data_str =str_replace("&","",$data_str);
	$data_str =str_replace("%","",$data_str);
	$data_str =str_replace("!","",$data_str);
	$data_str =str_replace("#","",$data_str);
	$data_str =str_replace("<","",$data_str);
	$data_str =str_replace(">","",$data_str);
	$data_str =str_replace("*","",$data_str);
	$data_str =str_replace("And","",$data_str);
	$data_str =str_replace("'","",$data_str);
	$data_str =str_replace("chr(34)","",$data_str);
	$data_str =str_replace("chr(39)","",$data_str);
	return $data_str;
}

if (! function_exists('formatBytes')) {
	function formatBytes($bytes, $precision = 2) { 
	    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	    $bytes = max($bytes, 0); 
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	    $pow = min($pow, count($units) - 1); 
	    return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
}

// ALERT Box
if(!function_exists('alertbox')) {
	function alertbox($status, $text, $icon) {
		switch($status) {
			case 'BS00': $statu = 'danger'; break;
			case 'BS01': $statu = 'success'; break;
			case 'BS02': $statu = 'warning'; break;
			case 'BS03': $statu = 'info'; break;
			case 'no_data': $statu = 'info'; break;
			case 'BS04': $statu = 'success'; break;
			case 'BS05': $statu = 'success'; break;
			case 'delete_cache': $statu = 'success'; break;
			case 'openai_apikey': $statu = 'danger'; break;
			case 'openai_blog_cron': $statu = 'info'; break;
			case 'unsplash_accesskey': $statu = 'danger'; break;
			case 'unsplash_status': $statu = 'info'; break;
			
		}
		return '<div class="text-center alert alert-'.$statu.'"><i class="fa '.$icon.' fa-2x pull-left"></i><h5>'.$text.'</h5></div>';
	}
}

if(!function_exists('toast')) {
	function toast($status) {
		switch($status) {
			case 'BS00': $style = '#a94442'; $icon = 'error'; break;
			case 'BS01': $style = '#3c763d'; $icon = 'success'; break;
			case 'BS02': $style = '#8a6d3b'; $icon = 'warning'; break;
			case 'BS03': $style = '#31708f'; $icon = 'info'; break;
			case 'no_data': $style = '#31708f'; $icon = 'info'; break;
			case 'BS04': $style = '#3c763d'; $icon = 'success'; break;
			case 'BS05': $style = '#3c763d'; $icon = 'success'; break;
				
		}
		return '<script>
		$.toast({ 
		  heading : "'.lang('Global.general.info_text').'",
		  text : "'.lang('Global.alert.'.$status).'", 
		  showHideTransition : "slide",  
		  bgColor : "'.$style.'",              
		  textColor : "#eee",  
		  icon: "'.$icon.'",          
		  allowToastClose : true,       
		  hideAfter : 5000,              
		  stack : 5,
		  textAlign : "left",
		  position : "top-right",
		  loaderBg: "#fff"
		})
		</script>';
	}
}

// get Site User Info
if(! function_exists('getUserInfo')) {
	function getUserInfo($id) {
		$db = \Config\Database::connect();		
		$t = $db->query("SELECT * FROM users WHERE _id = $id")->getRow();
		return $t;
	}
}

if(! function_exists('getBlogInfo')) {
	function getBlogInfo($id) {
		$db = \Config\Database::connect();		
		$t = $db->query("SELECT * FROM blogs WHERE _id = $id")->getRow();
		return $t;
	}
}

if(!function_exists('checkstatus')) {
	function checkstatus($status) {
		switch($status) {
			case 'active': return '<span class="badge badge-success">'.lang('Global.general.status_active_text').'</span>'; break;
			case 'passive': return '<span class="badge badge-warning">'.lang('Global.general.status_passive_text').'</span>'; break;
			case 'pending': return '<span class="badge badge-danger">'.lang('Global.general.status_pending_text').'</span>'; break;
			case 'draft': return '<span class="badge badge-dark">'.lang('Global.general.status_draft_text').'</span>'; break;

		}
	}
}

if(!function_exists('checkPriority')) {
	function checkPriority($priority) {
		switch($priority) {
			case 0: return '<span class="label label-info">'.lang('Global.blogs.priority.low_text').'</span>'; break;
			case 1: return '<span class="label label-purple">'.lang('Global.blogs.priority.high_text').'</span>'; break;
			case 2: return '<span class="label label-danger">'.lang('Global.blogs.priority.higher_text').'</span>'; break;

		}
	}
}


if (! function_exists('footerPages')) {
	function footerPages() {
		$db = \Config\Database::connect();
		$query = $db->query("SELECT * FROM pages WHERE status='active' AND footer = 1 AND blog = 0 ORDER BY name ASC LIMIT 0,3");
		$results = $query->getResult();
		return $results;
	}
}

if(!function_exists('generateRandomString')) {
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}


/*

function fix_json_data($json_data) {
    // JSON verilerini diziye dönüştürme
    $data = json_decode($json_data, true);

    // Anahtar adlarını al
    $keys = array_keys($data[0]);

    // Hangi anahtarın soru-cevap çiftlerini içerdiğini belirle
    $question_key = "";
    foreach ($keys as $key) {
        if (is_array($data[0][$key]) && isset($data[0][$key][0]["question"]) && isset($data[0][$key][0]["answer"])) {
            $question_key = $key;
            break;
        }
    }

    // "questions" veya farklı bir anahtar adı altında veri var mı kontrol et
    if (empty($question_key)) {
        // Hata: Soru-cevap çiftleri içeren bir anahtar adı yok
        return $json_data;
    } else {
        // Soru-cevap çiftlerini içeren bir anahtar adı bulundu
        $questions = array();
        foreach ($data[0][$question_key] as $question) {
            $questions[] = array(
                "question" => $question["question"],
                "answer" => $question["answer"]
            );
        }

        return json_encode($questions);
    }
}

function temizle($str) {
	$str     = str_replace('\u','',$str);
	$str     = str_replace('\n','',$str);
	$str     = str_replace('00a0',' ',$str);
	$str = preg_replace('/u([\da-fA-F]{4})/', '', $str);
	return $str;
}

function JobAutoKeywords($text, $job_title) {
	$text = str_replace("{job_title}", $job_title, $text);
	return $text;
}

function descLanguage($text, $q) {
	$text = str_replace("{keyword}", $q, $text);
	return $text;
}

if(!function_exists('checkstatus')) {
	function checkstatus($status) {
		switch($status) {
			case 'active': return '<span class="badge badge-success">'.lang('Global.general.status_active_text').'</span>'; break;
			case 'passive': return '<span class="badge badge-warning">'.lang('Global.general.status_passive_text').'</span>'; break;
			case 'pending': return '<span class="badge badge-dark">'.lang('Global.general.status_pending_text').'</span>'; break;
			case 'banned': return '<span class="badge badge-danger">'.lang('Global.general.status_banned_text').'</span>'; break;
			case 'rejected': return '<span class="badge badge-warning">'.lang('Global.general.status_rejected_text').'</span>'; break;
			case 'reject': return '<span class="badge badge-danger">'.lang('Global.general.status_reject_text').'</span>'; break;
			case 'read': return '<span class="badge badge-dark">'.lang('Global.general.status_read_text').'</span>'; break;
			case 'planning': return '<span class="badge badge-warning">'.lang('Global.general.status_planning_text').'</span>'; break;
			case 'unread': return '<span class="badge badge-danger">'.lang('Global.general.status_unread_text').'</span>'; break;
			case 'complete': return '<span class="badge badge-success">'.lang('Global.general.status_complete_text').'</span>'; break;
			case 'later': return '<span class="badge badge-warning">'.lang('Global.general.status_later_text').'</span>'; break;
			case 'worker': return '<span class="badge badge-dark">'.lang('Global.general.status_worker_text').'</span>'; break;
			case 'success': return '<span class="badge badge-success">'.lang('Global.general.status_success_text').'</span>'; break;

		}
	}
}


function timeConvert($zaman){
    $zaman =  strtotime($zaman);
    $zaman_farki = time() - $zaman;
    $saniye = $zaman_farki;
    $dakika = round($zaman_farki/60);
    $saat = round($zaman_farki/3600);
    $gun = round($zaman_farki/86400);
    $hafta = round($zaman_farki/604800);
    $ay = round($zaman_farki/2419200);
    $yil = round($zaman_farki/29030400);
    if( $saniye < 60 ){
        if ($saniye == 0){
            return "az önce";
        } else {
            return $saniye .' saniye önce';
        }
    } else if ( $dakika < 60 ){
        return $dakika .' dakika önce';
    } else if ( $saat < 24 ){
        return $saat.' saat önce';
    } else if ( $gun < 7 ){
        return $gun .' gün önce';
    } else if ( $hafta < 4 ){
        return $hafta.' hafta önce';
    } else if ( $ay < 12 ){
        return $ay .' ay önce';
    } else {
        return $yil.' yıl önce';
    }
}

// get Site Config
if(! function_exists('getCategoryInfo')) {
	function getCategoryInfo($id) {
		$db = \Config\Database::connect();		
		$t = $db->query("SELECT * FROM categories WHERE _id = $id")->getRow();
		return $t;
	}
}




*/
