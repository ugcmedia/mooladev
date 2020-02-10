<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class managevencategories extends Sximo  {
	
	protected $table = 'tb_vendor_categories';
	protected $primaryKey = 'cat_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_vendor_categories.* FROM tb_vendor_categories  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_vendor_categories.cat_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
