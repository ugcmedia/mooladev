<?php
namespace App\Http\Controllers\MemberController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Member;
use Session;
use Auth;
use Validator;
use Hash;
use Mail;
use App\Helpers\EmailAlerts;
// use App\Helpers\PushNotification;
use App\Http\Controllers\MemberController\PushNotification;

/**
 *
 */
class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $data='';
        return view('member-dash.dashboard',compact('data'));
    }



}
