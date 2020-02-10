<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SitemapController extends Controller
{
    //
	public function index()
	{
		$sitemaps = \DB::table('tb_sitemap_settings')->where('enabled','=','Y')->where('slug','!=','')->get();	
		

	  return response()->view('sitemap.index', [
		  'sitemaps' => $sitemaps,
	  ])->header('Content-Type', 'text/xml');
	  
	}
	
	public function robots()
	{
		$setting = \ DB::table('tb_settings')->where('setting_key', 'seo_robots_txt')->first();
		echo $setting->setting_value;
	}
	
	public function sitemap(Request $request , $subsitemap = '')
	{
		
		
		$entries = array();
		$subsetting = DB::table('tb_sitemap_settings')->where('slug', $subsitemap)->first();
		$table_name = $subsetting->module;
		switch($table_name)
		{
			case 'tb_brands' :
				$entries = DB::select(DB::raw('SELECT brand_slug as slug,updated_date as updated_date FROM `tb_brands`'));
				$subsitemap = '/brand';
			break;
			case 'tb_categories' :
			$entries = DB::select(DB::raw('SELECT cat_slug as slug, updated_date FROM `tb_categories`'));
			break;
			case 'tb_coupons' :
			$entries = DB::select(DB::raw('SELECT coupon_id as slug, updated_date FROM `tb_coupons`'));
			break;
			case 'tb_deals' :
			$entries = DB::select(DB::raw('SELECT deal_id as slug, updated_date FROM `tb_deals` '));
			break;
			case 'tb_pages' :
			$entries = DB::select(DB::raw("SELECT IF(filename='homepage','',alias) as slug , IFNULL(updated,created) as updated_date  FROM `tb_pages` WHERE status = 'enable' AND pagetype = 'page' AND allow_guest <> 1"));
			break;
			case 'tb_posts' :
			$entries = DB::select(DB::raw("SELECT IF(filename='homepage','',alias) as slug , IFNULL(updated,created) as updated_date  FROM `tb_pages` WHERE status = 'enable' AND pagetype = 'post' AND allow_guest <> 1"));
			break;
			case 'tb_stores' :
			$entries = DB::select(DB::raw("SELECT store_slug as slug , updated_date FROM `tb_stores` WHERE enabled = 'Y' "));
			break;
			case 'tb_store_categories' :
			$entries = DB::select(DB::raw('SELECT slug , updated_date FROM `tb_store_categories`'));
			break;
			case 'tb_tags' :
			$entries = DB::select(DB::raw('SELECT tag_slug as slug, updated_date FROM `tb_tags`'));
			break;
			default : 
			$entries = array();
			break;
			
		}
		
		
		$fsLinks = $this->getFrontEndLinks();
		$subsitemap = $fsLinks[$table_name];
		
		 return response()->view('sitemap.submap', [
        'entries' => $entries,
		'subsetting' => $subsetting,
		'slug'=>$subsitemap
		])->header('Content-Type', 'text/xml');
		
	}
	
	public function getFrontEndLinks()
	{
		$fsLinks  = array('tb_pages'=>'','tb_posts'=>'/blog');
		$fsRes = DB::select("SELECT SUBSTR(module_frontend_slug , 1, POSITION('@'  IN module_frontend_slug)-1)  as slug, module_db  FROM `tb_module` WHERE module_frontend_slug <> '' ");

		foreach($fsRes as $fsrow)
		$fsLinks[$fsrow->module_db] = '/'.$fsrow->slug;
		
		return $fsLinks;
	}
}
