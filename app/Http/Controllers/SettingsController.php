<?php namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;


class SettingsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'settings';
	static $per_page	= '10';

	public function __construct()
	{
		parent::__construct();
		$this->model = new Settings();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = array();

		// $this->data = array_merge(array(
		// 	'pageTitle'	=> 	$this->info['title'],
		// 	'pageNote'	=>  $this->info['note'],
		// 	'pageModule'=> 'settings',
		// 	'return'	=> self::returnUrl()
		//
		// ),$this->data);


	}

	public function index( Request $request,Settings $setting,$type )
	{	
		if(!\Auth::check())
		return redirect('user/login')->with('status', 'error')->with('message','You are not login');
		switch (true) {
			case ($type == 'system_setting'):
				$fields  = $setting->wheresetting_group('General')->orderBy('seqID', 'asc')->get();
				$data   = array(
					'pageTitle'		=> 'System setting',
					'pageNote'		=>  'System setting',
					'pageModule'	=> 'settings',
					'return'			=> self::returnUrl()
				);
			break;
			 case ($type  == 'developer'):
				 $fields  = $setting->wheresetting_group('Developer')->orderBy('seqID', 'asc')->get();
				 $data   = array(
					 'pageTitle'	=> 'Developer setting',
					 'pageNote'		=>   'Developer setting',
					 'pageModule'	=>  'settings',
					 'return'			=> self::returnUrl()
				 );
				 break;
				 case ($type == 'cashback'):
				 $fields  = $setting->wheresetting_group('Cashback')->orderBy('seqID', 'asc')->get();
				 $data   = array(
					 'pageTitle'	=> 'Cashback setting',
					 'pageNote'		=>   'Cashback setting',
					 'pageModule'	=>  'settings',
					 'return'			=> self::returnUrl()
				 );
				break;
				case ($type == 'referral'):
				 $fields  = $setting->wheresetting_group('Referral')->orderBy('seqID', 'asc')->get();
				 $data   = array(
					 'pageTitle'	=> 'Referral setting',
					 'pageNote'		=>   'Referral setting',
					 'pageModule'	=>  'settings',
					 'return'			=> self::returnUrl()
				 );
				break;
				case ($type == 'payout'):
				$fields  = $setting->wheresetting_group('payout')->orderBy('seqID', 'asc')->get();
				$data   = array(
					'pageTitle'	=> 'Payout setting',
					'pageNote'		=>   'payout setting',
					'pageModule'	=>  'settings',
					'return'			=> self::returnUrl()
				);
					break;
					case($type == 'homepage'):
							$fields  = $setting->wheresetting_group('Homepage')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Home Page setting',
								'pageNote'		=>   'Home Page setting',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;
				case($type == 'menu'):
							$fields  = $setting->wheresetting_group('Menu')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Menu setting',
								'pageNote'		=>   'Menu setting',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;
				case($type == 'seo'):
							$fields  = $setting->wheresetting_group('SEO')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'SEO setting',
								'pageNote'		=>   'SEO setting',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;
				case($type == 'listing'):
							$fields  = $setting->wheresetting_group('Listing')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Listing setting',
								'pageNote'		=>   'Listing setting',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;
				case($type == 'module'):
							$fields  = $setting->wheresetting_group('Module')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Module setting',
								'pageNote'		=>   'Module setting',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;	
				case($type == 'social'):
							$fields  = $setting->wheresetting_group('Social')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Social setting',
								'pageNote'		=>   'Social setting',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;
				case($type == 'ads'):
							$fields  = $setting->wheresetting_group('Ads')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Google Ads/Banner Management',
								'pageNote'		=>   'Manage Google Ads/Promo Banners',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;
				case($type == 'email'):
							$fields  = $setting->wheresetting_group('Email')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Email Template Settings',
								'pageNote'		=>   'Customize Email Template',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;
				case($type == 'app'):
							$fields  = $setting->wheresetting_group('App')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Mobile App Settings',
								'pageNote'		=>   'Mobile App Template',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;case($type == 'vendor'):
							$fields  = $setting->wheresetting_group('Vendor')->orderBy('seqID', 'asc')->get();
							$data   = array(
								'pageTitle'	=> 'Vendor Settings',
								'pageNote'		=>   'Vendor Settings',
								'pageModule'	=>  'settings',
								'return'			=> self::returnUrl()
							);
				break;
			default:
				// code...
				break;
		}

		return view('settings.index',$data,compact('fields'));

	}

	public function updateSetting(Request $request , Settings $setting) {


			foreach ($request->setting_value as $key => $value) {
				if(is_array($request->setting_value[$key])) {
						$implode = implode($request->setting_value[$key],',');
						$settingUpdate = $setting->wheresetting_key($key)->update(['setting_value' => $implode]);
				}
				else {
					$settingUpdate = $setting->wheresetting_key($key)->update(['setting_value' => $request->setting_value[$key]]);
				}

			}


			$getSetting   = settings::all();
        $val  =		"<?php \n";
        $val  .= 	"return [\n";
        foreach ($getSetting as $key => $value) {
            $val  .= " '".$value->setting_key."' => '".addslashes ($value->setting_value)."'  ,\n";
        }
        $val  .= 	"'cnf_maintenance' 			=> '".$request->input('cnf_maintenance')."',\n";
        $val  .= 	"];\n";
        			$filename = base_path().'/config/settingConfig.php';
        			$fp=fopen($filename,"w+");
        			fwrite($fp,$val);
        			fclose($fp);
					
			return redirect()->back()->with('message','Setting Successfully updated')->with('status','success');

	}




}
