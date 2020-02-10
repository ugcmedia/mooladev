<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class managereviews extends Sximo  {
	
	protected $table = 'tb_vendor_reviews';
	protected $primaryKey = 'review_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_vendor_reviews.* FROM tb_vendor_reviews  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_vendor_reviews.review_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
