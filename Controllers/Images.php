<?php
namespace App\Controllers;
use App\Models\BlogModel;

class Images extends BaseController{
	
	public function watermark($blog_id, $blog_title, $blog_description) {
		$imgPath = 'public/upload/og/'.siteSet('default_og_image');
		$default_font = 'public/upload/og/'.siteSet('default_og_font');
		$random_name = generateRandomString(20).'-'.hash_encode($blog_id);
		
		$blog_description1 = substr($blog_description, 0, 80);
		$blog_description2 = substr($blog_description, 80, 80);
		
		$og_color = hexToRgb(siteSet('default_og_color'));
		$image = \Config\Services::image()
		    ->withFile($imgPath)
		    ->flatten($og_color[0],$og_color[1],$og_color[2])
		    ->text(siteSet('default_og_sitename'), [
		        'color'      => siteSet('default_og_text_primary_color'),
		        'opacity'    => 0,
		        'withShadow' => false,
		        'hAlign'     => 'center',
		        'vAlign'     => 'top',
		        'fontPath' => $default_font,
		        'fontSize'   => 90,
		        'vOffset' => 300
		    ])
		    //BLOG TITLE
		    ->text($blog_title, [
		        'color'      => siteSet('default_og_title_color'),
		        'opacity'    => 0,
		        'withShadow' => false,
		        'hAlign'     => 'center',
		        'vAlign'     => 'top',
		        'fontPath' => $default_font,
		        'fontSize'   => 50,
		        'vOffset' => 440
		    ])
		    // BLOG Description
		    ->text($blog_description1, [
		        'color'      => siteSet('default_og_desc_color'),
		        'opacity'    => 0,
		        'withShadow' => false,
		        'hAlign'     => 'center',
		        'vAlign'     => 'top',
		        'fontPath' => $default_font,
		        'fontSize'   => 35,
		        'vOffset' => 520
		    ])
		    ->text($blog_description2, [
		        'color'      => siteSet('default_og_desc_color'),
		        'opacity'    => 0,
		        'withShadow' => false,
		        'hAlign'     => 'center',
		        'vAlign'     => 'top',
		        'fontPath' => $default_font,
		        'fontSize'   => 35,
		        'vOffset' => 570
		    ])
		    //SITE URL
		    ->text(getenv('app.baseURL'), [
		        'color'      => siteSet('default_og_text_primary_color'),
		        'opacity'    => 0,
		        'withShadow' => false,
		        'hAlign'     => 'center',
		        'vAlign'     => 'top',
		        'fontPath' => $default_font,
		        'fontSize'   => 30,
		        'vOffset' => 630
		    ])
		    ->save('public/upload/blog/'. $random_name.'.png');
		    return $random_name.'.png';

	}

}
