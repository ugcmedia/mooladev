<?php namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable {

	protected $table      = 'tb_vendors';
	protected $primaryKey = 'vendor_id';
	public $fillable      = ['vendor_code','vendor_name','vendor_contact_number','vendor_slug','vendor_logo','vendor_desc',
                            'vendor_cashback','cashback_enabled','cashback_type','vendor_status','outlet_address','outlet_lat',
                            'outlet_long','outlet_location','outlet_primary_image','outlet_gallery','outlet_attachment','outlet_name',
                            'vendor_rating','vendor_votes','vendor_categories','vendor_website','vendor_support_email','vendor_phnumber',
                            'vendor_howto','vendor_policy','vendor_featured','vendor_stats','clicks'
												];

}
