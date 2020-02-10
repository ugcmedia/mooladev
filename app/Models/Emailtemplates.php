<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class emailtemplates extends Sximo  {
	
	protected $table = 'tb_email_templates';
	protected $primaryKey = 'template_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_email_templates.* FROM tb_email_templates  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_email_templates.template_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
