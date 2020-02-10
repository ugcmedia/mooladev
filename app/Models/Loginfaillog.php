<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class loginfaillog extends Sximo  {
	
	protected $table = 'tb_user_login_fails';
	protected $primaryKey = 'fail_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_user_login_fails.* FROM tb_user_login_fails  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_user_login_fails.fail_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
