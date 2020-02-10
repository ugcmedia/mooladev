<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class sitemaps extends Sximo  {
	
	protected $table = 'tb_sitemap_settings';
	protected $primaryKey = 'ssid';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_sitemap_settings.* FROM tb_sitemap_settings  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_sitemap_settings.ssid IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
