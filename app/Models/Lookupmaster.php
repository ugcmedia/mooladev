<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class lookupmaster extends Sximo  {
	
	protected $table = 'tb_lookups';
	protected $primaryKey = 'lookupid';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_lookups.* FROM tb_lookups  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_lookups.lookupid IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
