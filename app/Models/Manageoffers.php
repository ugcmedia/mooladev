<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class manageoffers extends Sximo  {
	
	protected $table = 'tb_offers';
	protected $primaryKey = 'offer_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_offers.* FROM tb_offers  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_offers.offer_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
