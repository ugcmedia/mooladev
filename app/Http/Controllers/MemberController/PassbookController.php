<?php
namespace App\Http\Controllers\MemberController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Models\Member;
use Session;
use Auth;
use Validator;
use Hash;
use Mail;
use App\Helpers\EmailAlerts;
/**
 *
 */
class PassbookController extends Controller
{

    public function index() {
      $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('passbook')->first();

      $data['passbook']        = DB::table("vw_passbook")->where('user_id',Auth::guard('member')->id())->paginate(25);



        return view('member-dash.passbook.index',compact('data'));
    }

    public function     monthlyPass() {
      $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('passbook')->first();
        return view('member-dash.passbook.monthly',compact('data'));
    }

}
