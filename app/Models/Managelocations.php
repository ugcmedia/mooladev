<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class managelocations extends Sximo  {
	
	protected $table = 'tb_location_master';
	protected $primaryKey = 'location_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_location_master.* FROM tb_location_master  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_location_master.location_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
