<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class contactsubmits extends Sximo  {
	
	protected $table = 'tb_contacts';
	protected $primaryKey = 'contact_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_contacts.* FROM tb_contacts  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_contacts.contact_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
