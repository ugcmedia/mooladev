<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class blocks extends Sximo  {
	
	protected $table = 'tb_content_block';
	protected $primaryKey = 'block_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_content_block.* FROM tb_content_block  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_content_block.block_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
