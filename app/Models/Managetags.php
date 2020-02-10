<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class managetags extends Sximo  {
	
	protected $table = 'tb_tags';
	protected $primaryKey = 'tag_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_tags.* FROM tb_tags  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_tags.tag_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
