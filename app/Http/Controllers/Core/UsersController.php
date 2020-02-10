<?php namespace App\Http\Controllers\core;


use App\Http\Controllers\Controller;
use App\Models\Core\Users;
use App\Models\Core\Groups;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;
use App\Helpers\AppClass;

class UsersController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'users';
	static $per_page	= '10';

	public function __construct()
	{
		parent::__construct();
		$this->model = new Users();
		$this->info = $this->model->makeInfo( $this->module);
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'core/users',
			'return'	=> self::returnUrl()

		);

	}

	public function index( Request $request )
	{
		// Make Sure users Logged
		if(!\Auth::check())
			return redirect('user/login')->with('status', 'error')->with('message','You are not login');

		$filter = [
			'params' => " AND tb_groups.level > '".Users::level(session('gid'))."'"
		];
		$this->grab( $request , $filter ) ;
		if($this->access['is_view'] ==0)
			return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');
		// Render into template
		return view( 'core.'. $this->module.'.index',$this->data);
	}

	function create( Request $request )
	{
		$this->hook( $request  );

		if($this->access['is_add'] ==0)
			return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');

		$this->data['row'] = $this->model->getColumnTable( $this->info['table']);
		$this->data['id'] = '';
		return view('core.users.form',$this->data);

	}
	function edit( Request $request , $id )
	{
		$this->hook( $request , $id );
		if(!isset($this->data['row']))
			return redirect($this->module)->with('message','Record Not Found !')->with('status','error');

		if($this->access['is_edit'] ==0 )
			return redirect('dashboard')->with('message',__('core.note_restric'))->with('status','error');


		$this->data['row'] = (array) $this->data['row'];
		$this->data['id'] = $id;
		return view('core.users.form',$this->data);
	}
	function show( Request $request , $id )
	{
		/* Handle import , export and view */
		$task =$id ;
		switch( $task)
		{
			case 'search':
				return $this->getSearch();
				break;
			case 'blast':
				return $this->getBlast( $request);
				break;

			case 'comboselect':
				return $this->getComboselect( $request );
				break;
			case 'import':
				return $this->getImport( $request );
				break;
			case 'export':
				return $this->getExport( $request );
				break;
			default:
				$this->hook( $request , $id );
				if(!isset($this->data['row']))
					return redirect($this->module)->with('message','Record Not Found !')->with('status','error');

				if($this->access['is_detail'] ==0)
					return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');

				return view('core.users.view',$this->data);
				break;
		}
	}

	function store( Request $request  )
	{
		$task = $request->input('action_task');
		switch ($task)
		{
			default:
				return $this->postSave( $request );
				break;
			case 'delete':
				$result = $this->destroy( $request );
				return redirect('core/'.$this->module.'?'.$this->returnUrl())->with($result);
				break;

			case 'import':
				return $this->PostImport( $request );
				break;

			case 'copy':
				$result = $this->copy( $request );
				return redirect('core/'.$this->module.'?'.$this->returnUrl())->with($result);
				break;
		}

	}

	function postSave( $request, $id =0)
	{

		$rules = $this->validateForm();
		if($request->input('id') =='')
		{
			$rules['password'] 				= 'required|between:6,12|confirmed';
			$rules['password_confirmation'] = 'required|between:6,12';
			$rules['email'] 				= 'required|email|unique:tb_users';
			$rules['username'] 				= 'required|alpha_num|min:2|unique:tb_users';

		} else {
			if($request->input('password') !='')
			{
				$rules['password'] 				='required|between:6,12|confirmed';
				$rules['password_confirmation'] ='required|between:6,12';
			}
		}
		if(!is_null($request->file('avatar'))) $rules['avatar'] = 'mimes:jpg,jpeg,png,gif,bmp';

		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost( $request );
			if($request->input('id') =='')
			{
				$data['password'] = \Hash::make($request->input('password'));
			} else {
				if($request->input('password') !='')
				{
					$data['password'] = \Hash::make($request->get('password'));
				} else {
					unset($data['password']);
				}
			}


			$id = $this->model->insertRow($data , $request->input('id'));

			if(!is_null($request->file('avatar')))
			{
				$updates = array();
				$file = $request->file('avatar');
				$destinationPath = './uploads/users/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				 $newfilename = $id.'.'.$extension;
				$uploadSuccess = $request->file('avatar')->move($destinationPath, $newfilename);
				if( $uploadSuccess ) {
				    $updates['avatar'] = $newfilename;
				}
				$this->model->insertRow($updates , $id );
			}

			if(!is_null($request->input('apply')))
			{
				$return = 'core/users/'.$id.'/edit?return='.self::returnUrl();
			} else {
				$return = 'core/users?return='.self::returnUrl();
			}

			return redirect($return)->with('message',__('core.note_success'))->with('status','success');

		} else {

			return redirect()->back()->with('message',__('core.note_error'))->with('status','error')
			->withErrors($validator)->withInput();
		}
	}

	public function destroy( $request)
	{
		// Make Sure users Logged
		if(!\Auth::check())
			return redirect('user/login')->with('status', 'error')->with('message','You are not login');

		$this->access = $this->model->validAccess($this->info['id'] , session('gid'));
		if($this->access['is_remove'] ==0)
			return redirect('dashboard')
				->with('message', __('core.note_restric'))->with('status','error');
		// delete multipe rows
		if(count($request->input('ids')) >=1)
		{
			$this->model->destroy($request->input('ids'));

			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
        	return ['message'=>__('core.note_success_delete'),'status'=>'success'];

		} else {
			return ['message'=>__('No Item Deleted'),'status'=>'error'];
		}

	}

	function getBlast()
	{

		$this->data = array(
			'pageTitle'	=> 'Blast Email',
			'pageNote'	=> 'Send email to users'
		);
		//return view('core.users.blastsms',$this->data);
		return view('core.users.blast',$this->data);
	}

	function getSmsBlast()
	{
		$this->data = array(
			'pageTitle'	=> 'Blast SMS',
			'pageNote'	=> 'Send SMS to users'
		);
		return view('core.users.blastsms',$this->data);
	}

	function postDoblast( Request $request)
	{

		$rules = array(
			'subject'		=> 'required',
			'message'		=> 'required|min:10',
			'user_type'		=> 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes())
		{

			if(!is_null($request->input('user_type')))
			{
				$count = 0;
				$user_type = $request->input('user_type');

				{
					switch($user_type)
					{
						case 'all' :
						$users = \DB::table('tb_cashback_users')->get();
						break;
						case 'email_no' :
						$users = \DB::table('tb_cashback_users')->where('email_verified','=','N')->get();
						break;
						case 'email_yes' :
						$users = \DB::table('tb_cashback_users')->where('email_verified','=','Y')->get();
						break;
						case 'both_yes' :
						$users = \DB::table('tb_cashback_users')->where('email_verified','=','Y')->where('mobile_verified','=','Y')->get();
						break;
						case 'custom_list' :
						$users = explode(',',$request->input('custom_list'));
						break;
						default :
						$users = array();
						break;


					}



					foreach($users as $row)
					{
						$data['data'] 	= $request->input('message');
						$data['row']		= $row;
						if($user_type=='custom_list')
						$data['to'] = $row;
						else
						$data['to']			= $row->email;
						$data['subject']	= $request->input('subject');
						$data['cnf_appname'] = $this->config['cnf_appname'];
						$data['cnf_sender'] = $this->config['cnf_email'];
					//	dd($data['to']);

						AppClass::sendEmail($data['subject'],$purpose=null,config('settingConfig.dev_email_sender_name'),config('settingConfig.dev_email_sender'),config('settingConfig.dev_email_replyto'),null,$data['data'],$data['to'],$fullName = null);


						// if($this->config['cnf_mail'] && $this->config['cnf_mail'] =='swift')
						// {
						// 	\Mail::send('mailEmail', $data, function ($message) use ($data) {
					  //   		$message->to($data['to'])->subject($data['subject']);
						//
					  //   	});
						//
						//
					  //   } else {
					  //   	$message = view('mailEmail',$data);
						// 	$headers  = 'MIME-Version: 1.0' . "\r\n";
						// 	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						// 	$headers .= 'From: '.$this->config['cnf_appname'].' <'.$this->config['cnf_email'].'>' . "\r\n";
						// 		mail($data['to'], $data['subject'], $message, $headers);
					  //   }

						//
						++$count;
					}

				}
				return redirect('core/users/blast')->with('message','Total '.$count.' Message has been sent')->with('status','success');

			}
			return redirect('core/users/blast')->with('message','No Message has been sent')->with('status','info');


		} else {

			return redirect('core/users/blast')->with('message', 'The following errors occurred')->with('status','error')
			->withErrors($validator)->withInput();

		}

	}

	function postDoblastSms( Request $request)
	{

		$rules = array(
			'message'		=> 'required|min:10',
			'user_type'		=> 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes())
		{

			if(!is_null($request->input('user_type')))
			{
				$count = 0;
				$user_type = $request->input('user_type');
				$message = $request->input('message');

				{
					switch($user_type)
					{
						case 'all' :
						$users = \DB::table('tb_cashback_users')->get();
						break;
						case 'email_no' :
						$users = \DB::table('tb_cashback_users')->where('email_verified','=','N')->get();
						break;
						case 'email_yes' :
						$users = \DB::table('tb_cashback_users')->where('email_verified','=','Y')->get();
						break;
						case 'both_yes' :
						$users = \DB::table('tb_cashback_users')->where('email_verified','=','Y')->where('mobile_verified','=','Y')->get();
						break;
						case 'custom_list' :
						$users = explode(',',$request->input('custom_list'));
						break;
						default :
						$users = array();
						break;


					}

/* 					$sms_api = null;
					$devSettings = array();

					$devRes = \DB::table('tb_settings')->where('setting_group','=','Developer')->get();
					foreach($devRes as $devRw)
					$devSettings[$devRw->setting_key] = trim( $devRw->setting_value);
					$sms_api = str_ireplace( array('#API_KEY','#SENDER','#MESSAGE') , array($devSettings['dev_sms_apikey'],$devSettings['dev_sms_apisender'],$message),$devSettings['dev_sms_apiurl']  );
 */
					foreach($users as $row)
					{
						/* if($user_type=='custom_list')
							$sms_api = str_replace('#NUMBER',$row,$sms_api);
						else
						$sms_api = str_replace('#NUMBER',$row->mobile_number,$sms_api);

						AppClass::curlMe($sms_api); */
						
						if( is_numeric($row) )
						AppClass::sendSMS($row,$message);
						else
						AppClass::sendSMS($row->mobile_number,$message);	

						++$count;
					}

				}
				return redirect('core/blast-sms')->with('message','Total '.$count.' Message has been sent')->with('status','success');

			}
			return redirect('core/blast-sms')->with('message','No Message has been sent')->with('status','info');


		} else {

			return redirect('core/blast-sms')->with('message', 'The following errors occurred')->with('status','error')
			->withErrors($validator)->withInput();

		}

	}

	public function getSearch( $mode = 'native')
	{

		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['searchMode'] = 'native';
		$this->data['pageUrl']		= url('core/users');
		return view('sximo.module.utility.search',$this->data);

	}

}
