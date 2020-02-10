<?php

namespace App\Http\Controllers\Auth;

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
use App\Models\Member;

/* without login Main page Lode*/

 use App\Helpers\AppClass;
 use App\Helpers\MobileDetect;

class LoginController extends Controller
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function DoMemberLogin(Request $request,Member $member)
    {
      $rules = array(
        'email' => 'required|email', // make sure the email is an actual email
        'password' => 'required|string|min:6'
      );

        // password has to be greater than 3 characters and can only be alphanumeric and);
        // checking all field

        $userExist  = $member->whereemail( Input::get('email'))->first();
     	  $refUrl       = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url('/');
        $currentUrl = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : $refUrl;
        $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
          {
            return redirect()->back()->withErrors($validator) // send back all errors to the login form
            ->with('lerror','login-msg')->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
          }

         if(!empty($userExist))
         {
              if($userExist->account_status=="banned") {
                return redirect()->back()->with('lcerror',['msg' => trans('actionMsg.account_banned_msg'),'type' =>'login']);
              }

            if($userExist->creation_mode == 'G') {
              return redirect()->back()->with('lcerror',['msg' => trans('actionMsg.login_using_google_msg'),'type' =>'login']);
            }
            if($userExist->creation_mode == 'F') {
              return redirect()->back()->with('lcerror',['msg' => trans('actionMsg.login_using_fb_msg'),'type' =>'login']);

            }
            $userdata = array(
              'email' => Input::get('email') ,
              'password' => Input::get('password')
            );

            // attempt to do the login
            if (Auth::guard('member')->attempt($userdata))
              {
                  //dd($currentUrl);
                  DB::table('tb_user_login_logs')->insert( array('user_id'=>Auth::guard('member')->id() , 'ip_addr'=>$request->ip())  );
                  Session::put('memberDetail',$member->find(Auth::guard('member')->id()));
                  return redirect($currentUrl)->with('lsuccess',['msg' => trans('actionMsg.login_success_msg'),'type' =>'login']);
              }
              else
              {
  				          $this->failUser(Input::get('email'),Input::get('password'));
                    return redirect()->back()->with('lcerror',['msg' => trans('actionMsg.email_pass_incorrect_msg'),'type' =>'login']);
              }
        }
        else
         {
  			      $this->failUser(Input::get('email'),Input::get('password'));
              return redirect()->back()->with('lerror',['msg' => trans('actionMsg.email_pass_incorrect_msg'),'type' =>'login'])->withInput(Input::except('password'));

            //  return redirect()->back()->withmerror('Invalid login');
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
