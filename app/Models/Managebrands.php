<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class managebrands extends Sximo  {
	
	protected $table = 'tb_brands';
	protected $primaryKey = 'brand_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_brands.* FROM tb_brands  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_brands.brand_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
