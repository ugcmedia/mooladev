<?php namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable {

	protected $table      = 'tb_cashback_users';
	protected $primaryKey = 'member_id';
	public $fillable      = ['creation_mode','email','first_name','last_name','salt','hashkey','remember_token','password','mobile_number','referral_code','referred_by',
													'activation_key','account_status','mobile_verified','email_verified','join_date','profile_picture','social_ref_key','social_ref_code','referral_commission','referral_validity',
													'social_link','s_email','mail_token','mail_send_timestamp'
												];

		public function authorAttributes()
			 {
					 return [
							 'name' => $this->first_name,
							 'email' => $this->email,
							 'avatar' => 'gravatar', // optional
					 ];
			 }
}
