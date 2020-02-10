<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class scheduling extends Sximo  {
	
	protected $table = 'users';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT users.* FROM users  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE users.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
