<?php namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Partner extends Authenticatable {

	protected $table      = 'tb_vendor_account';
	protected $primaryKey = 'vendor_id';
	public $fillable      = ['vendor_code','email','vendor_name','va_salt','va_hash','password',
													'email_verified','joined','va_token'];
	public $timestamps = false;

		public function authorAttributes()
			 {
					 return [
							 'vendor_name' => $this->vendor_name,
							 'vendor_email' => $this->vendor_email,
							 //'avatar' => 'gravatar', // optional
					 ];
			 }
}
