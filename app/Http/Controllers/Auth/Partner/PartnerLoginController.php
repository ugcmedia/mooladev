<?php

namespace App\Http\Controllers\Auth\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use App\User;
use Crypt;
use Session;
use DB;
use App\Models\Partner;

class PartnerLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //dd('sss');
      $this->middleware('guest', ['except' => 'logout']);
    }

    public function index(Request $request)
    {

    //  dd($request);

      return view('partner.login.index');

    }

    public function doPartnerLogin(Request $request, Partner $partner)
    {
      //dd($request);
      //dd($partner);
      // Creating Rules for Email and Password
      // echo "<pre>";
      // var_dump($_POST);
      // var_dump($_SERVER);
      // die();

      $rules = array(
        'email' => 'required|email', // make sure the email is an actual email
        'password' => 'required|string|min:6'
      );

      // password has to be greater than 3 characters and can only be alphanumeric and);
      // checking all field

      $userExist  = $partner->whereemail( Input::get('email'))->first();

// echo"<pre>";
//       echo $userExist ;
//       die();

   	  ///$refUrl                 = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url('/');
      //$currentUrl = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : $refUrl;
      $currentUrl = url('partner/overview');

      if(!empty($userExist))
       {

            		  if($userExist->account_status == 'banned')
                  {
                      return redirect()->back()->with('vlerror',['msg' => trans('actionMsg.account_banned_msg'),'type' =>'login']);
                  }

        $validator = Validator::make(Input::all() , $rules);

        // if the validator fails, redirect back to the form
                if ($validator->fails())
                  {
                    return redirect()->back()->withErrors($validator) // send back all errors to the login form
                    ->with('vlerror','login')->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
                  }
          // if($userExist->creation_mode == 'G') {
          //   return redirect()->back()->with('merror',['msg' => trans('actionMsg.login_using_google_msg'),'type' =>'login']);
          // }
          // if($userExist->creation_mode == 'F') {
          //   return redirect()->back()->with('merror',['msg' => trans('actionMsg.login_using_fb_msg'),'type' =>'login']);
          // }
          $userdata = array(
            'email' => Input::get('email') ,
            'password' => Input::get('password')
          );


          // attempt to do the login
        //  dd(Auth::guard('partner')->attempt($userdata));
                if (Auth::guard('partner')->attempt($userdata))
                {
                      $checkVendorDetail  = DB::table('tb_vendors')->wherevendor_code($userExist->vendor_code)->first();
                      Session::put('partnerDetail',$partner->find(Auth::guard('partner')->id()));

                                  if($checkVendorDetail != null )
                                   {
                                    return redirect('partner/partner-overview')->with('vlsuccess',['msg' => trans('actionMsg.login_success_msg'),'type' =>'login']);
                                  }
                                  else
                                  {
                                    return redirect('partner/complete-profile')->with('vlsuccess',['msg' => trans('actionMsg.login_success_msg'),'type' =>'login']);
                                  }
      				                //DB::table('tb_user_login_logs')->insert( array('user_id'=>Auth::guard('member')->id() , 'ip_addr'=>$request->ip())  );
                              //    return redirect($currentUrl)->with('msuccess',['msg' => trans('actionMsg.login_success_msg'),'type' =>'slogin']);
                  }
                  else
                  {
                    //dd('ssss');
      				          //$this->failUser(Input::get('email'),Input::get('password'));
                    return redirect()->back()->with('vlerror',['msg' => trans('actionMsg.email_pass_incorrect_msg'),'type' =>'login']);
                  }
      }
      else
      {

			     //$this->failUser(Input::get('email'),Input::get('password'));

          return redirect()->back()->with('vlerror',['msg' => trans('actionMsg.email_pass_incorrect_msg'),'type' =>'login']);
          //return redirect()->back()->withErrors($validator)->with('jnerror','join-Now-msg')->withInput();
      }

    }


	public function failUser($username,$password)
	{

				$ipAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
				if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {    $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])); }

				$fail_data = array(
				'ip_addr' => $ipAddress,
				'username' => $username,
				'password' => $password,
				'lock_time' => date('Y-m-d H:i:s',strtotime('now + '.config('sximo.cnf_restricttime'))),
				'referrer' => (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null  ),
				'user_agent' => (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null  ));
				DB::table('tb_user_login_fails')->insert($fail_data);


	}

    public function memLogout() {

        Auth::guard('member')->logout();
        Session::put('memberDetail',null);
        //return redirect('/');
        return redirect()->to('/')->with('msuccess',['msg' => trans('actionMsg.logout_success_msg'),'type' =>'slogout']);

    }


}
