<?php
namespace App\Http\Controllers\MemberController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Models\Member;
use Session;
use Auth;
use Validator;
use Hash;

/**
 *
 */
class NotificationController extends Controller
{

    public function index(Request $request) {
      $perPage = 20;

	  $type = 'all';
	  $currentPage = 1;

	  if( isset($_GET['type'])	  ) $type  = $_GET['type'];
	  if( isset($_GET['page'])	  ) $currentPage  = $_GET['page'];


      $data['page_data']                         = DB::table('tb_cashback_widgets')->wherecb_page('Notifications')->first();
      $data['alerts']                            = DB::table('tb_user_alert_settings')->get();


	  if($type=='cashback')
		Paginator::currentPageResolver(function() use ($currentPage) {return $currentPage;});
	else
		Paginator::currentPageResolver(function() use ($currentPage) {return 1;});

	  $data ['notification']['cashback']          = DB::table('vw_alert_transaction')->whereuser_id(Auth::guard('member')->id())->paginate($perPage);


	  if($type=='withdrawals')
		Paginator::currentPageResolver(function() use ($currentPage) {return $currentPage;});
	else
		Paginator::currentPageResolver(function() use ($currentPage) {return 1;});


	  $data['notification']['withdraw']          = DB::table('vw_alert_withdrawal')->whereuser_id(Auth::guard('member')->id())->paginate($perPage);


	  if($type=='bonus')
		Paginator::currentPageResolver(function() use ($currentPage) {return $currentPage;});
	else
		Paginator::currentPageResolver(function() use ($currentPage) {return 1;});


	 $data['notification']['bonus']             = DB::table('vw_alert_bonus')->whereuser_id(Auth::guard('member')->id())->paginate($perPage);

	  if($type=='referral')
		Paginator::currentPageResolver(function() use ($currentPage) {return $currentPage;});
	else
		Paginator::currentPageResolver(function() use ($currentPage) {return 1;});

	$data['notification']['referal']           = DB::table('vw_alert_referral')->whereuser_id(Auth::guard('member')->id())->paginate($perPage);
	  if($type=='broadcast')
		Paginator::currentPageResolver(function() use ($currentPage) {return $currentPage;});
	else
		Paginator::currentPageResolver(function() use ($currentPage) {return 1;});

	  $data['notification']['broadcast']         = DB::table('vw_alert_broadcast')->whereuser_id(Auth::guard('member')->id())->paginate($perPage);

    $notiCounts = array();
    $countAry = DB::select("SELECT COUNT(*) objCount , 'bonus' as objType FROM `vw_alert_bonus` WHERE user_id = ".Auth::guard('member')->id()." AND user_read = 'N'
    UNION
    SELECT COUNT(*) objCount , 'broad' as objType FROM `vw_alert_broadcast` WHERE user_id = ".Auth::guard('member')->id()." AND user_read = 'N'
    UNION
    SELECT COUNT(*) objCount , 'referral' as objType FROM `vw_alert_referral` WHERE user_id = ".Auth::guard('member')->id()." AND user_read = 'N'
    UNION
    SELECT COUNT(*) objCount , 'cashback' as objType FROM `vw_alert_transaction` WHERE user_id = ".Auth::guard('member')->id()." AND user_read = 'N'
    UNION
    SELECT COUNT(*) objCount , 'withdrawal' as objType FROM `vw_alert_withdrawal` WHERE user_id = ".Auth::guard('member')->id()." AND user_read = 'N'");
    $totalCount =0;
    foreach ($countAry as $countAr) {
      $notiCounts[$countAr->objType] = $countAr->objCount;
      $totalCount += $countAr->objCount;
    }
    $notiCounts['totalCount'] = $totalCount;
    $data['notiCounts'] = $notiCounts;

        return view('member-dash.notification.index',compact('data'));
    }

    public function markNotifyRead()
    {
       $user_id = Auth::guard('member')->id();

       DB::table('tb_user_bonus_changes')
       ->join('tb_user_bonus', 'tb_user_bonus.bonus_id', '=', 'tb_user_bonus_changes.bonus_id')
       ->where('tb_user_bonus.user_id',$user_id)->update(['user_read'=>'Y']);

       DB::table('tb_user_referrals_changes')
       ->join('tb_user_referrals', 'tb_user_referrals.refid', '=', 'tb_user_referrals_changes.refid')
       ->where('tb_user_referrals.user_id',$user_id)->update(['user_read'=>'Y']);

       DB::table('tb_user_withdrawals_changes')
       ->join('tb_user_withdrawals', 'tb_user_withdrawals.withdrawal_id', '=', 'tb_user_withdrawals_changes.withdrawal_id')
       ->where('tb_user_withdrawals.user_id',$user_id)->update(['user_read'=>'Y']);


        DB::table('tb_user_transaction_changes')
        ->join('tb_user_transaction', 'tb_user_transaction.utrid', '=', 'tb_user_transaction_changes.utrid')
        ->where('tb_user_transaction.user_id',$user_id)->update(['user_read'=>'Y']);

        DB::table('tb_user_broadcasts')->where('user_id',$user_id)->update(['user_read'=>'Y']);

        return ['msg' => 'Mark Read Success'];
    }


	public function goBroadcast(Request $request,$broadcast_id)
	{
		$user_id = Auth::guard('member')->id();
		$linkRow = DB::table('tb_broadcast_alerts')->where('broadcast_id',$broadcast_id)->first();
		$gotolink = url($linkRow->click_link);
		DB::table('tb_user_broadcasts')->where('user_id',$user_id)->where('broadcast_id',$broadcast_id)->update(['user_read'=>'Y']);
		return redirect($gotolink);
	}

}
