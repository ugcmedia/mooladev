<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class faqcats extends Sximo  {
	
	protected $table = 'tb_faq_cats';
	protected $primaryKey = 'faq_cat_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_faq_cats.* FROM tb_faq_cats  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_faq_cats.faq_cat_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
