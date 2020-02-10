<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class appbackups extends Sximo  {
	
	protected $table = 'migrations';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT migrations.* FROM migrations  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE migrations.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
