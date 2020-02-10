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
use App\Helpers\PushNotification;

/**
 *
 */
class CashBackActivityController extends Controller
{

    public function index(Request $request) {
      PushNotification::PushNotifications(trans('notification.welcome.title'),trans('notification.welcome.sub_title'),'dealswoot-desktop-'.Auth::guard('member')->id().'');
       $data['page_data']  = DB::table('tb_cashback_widgets')->wherecb_page('Activity')->first();

      /*cashback Data start */
      $data['cashback_data']  = DB::table('tb_user_transaction')
                                ->join('tb_stores','tb_stores.store_id','=','tb_user_transaction.merchant_id')
                                ->whereuser_id(Auth::guard('member')->id())
                                ->orderBy('tb_user_transaction.transaction_time','desc')
								                ->select('tb_user_transaction.*', 'store_name')
                                ->paginate(25);

     $data['bonus_data']     =  DB::table('tb_user_bonus')
                                ->join('tb_bonus_types','tb_bonus_types.bonus_code','=','tb_user_bonus.bonus_type')
                                ->whereuser_id(Auth::guard('member')->id())
                                ->orderBy('tb_user_bonus.date_added','desc')
                              ->paginate(25);

     // $data['refer_data']    =  DB::table('tb_user_referrals')
     //                              ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_referrals.ref_id')
     //                              ->select('tb_user_referrals.refid','tb_user_referrals.joined_date','tb_user_referrals.bonus_amount','tb_user_referrals.status','tb_user_referrals.validity_date',
     //                                  'tb_cashback_users.first_name','tb_cashback_users.last_name','tb_cashback_users.mobile_verified','tb_cashback_users.email_verified','tb_cashback_users.join_date')
     //                              ->where('tb_user_referrals.user_id','=',Auth::guard('member')->id())
     //                              ->orderBy('tb_user_referrals.joined_date','desc')
     //                            ->paginate(25);

  $data['refer_data']    =  DB::table('tb_user_referrals')
                              ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_referrals.ref_id')
                              ->join('tb_stores','tb_stores.store_id','=','tb_user_referrals.merchant_id')
                              ->select('tb_user_referrals.refid','tb_user_referrals.awarded_date','tb_user_referrals.bonus_amount','tb_user_referrals.status',
                                       'tb_cashback_users.first_name','tb_stores.store_name','tb_cashback_users.last_name','tb_cashback_users.mobile_verified','tb_cashback_users.email_verified')
                              ->where('tb_user_referrals.user_id','=',Auth::guard('member')->id())
                              ->orderBy('tb_user_referrals.utrid','desc')
                              ->paginate(25);

    $data['click_data']    =  DB::table('tb_clicks')
                            ->join('tb_stores','tb_stores.store_id','=','tb_clicks.store_id')
                            ->where('tb_clicks.user_id','=',Auth::guard('member')->id())
                            ->orderBy('tb_clicks.click_time','desc')
                            ->paginate(25);

    $netData       = DB::table('tb_network')->select('network_id','trans_convert_days')->get();


    		$cashback_meta = array();
    		$cashback_vw_res = DB::table('vw_alert_transaction')->where('user_id',Auth::guard('member')->id())->get();
    		foreach($cashback_vw_res as $cbres)
    		$cashback_meta[$cbres->transaction_id][] = array('change_time'=>$cbres->change_time,'status'=>$cbres->new_status,'amount'=>$cbres->new_cashback );

    		$data['cashback_meta'] = $cashback_meta;

    		$bonus_meta = array();
    		$bonus_vw_res = DB::table('vw_alert_bonus')->where('user_id',Auth::guard('member')->id())->get();
    		foreach($bonus_vw_res as $bnsres)
    		$bonus_meta[$bnsres->bonus_id][] = array('change_time'=>$bnsres->change_time,'status'=>$bnsres->new_status );

    		$data['bonus_meta'] = $bonus_meta;

    		$referral_meta = array();
    		$ref_vw_res = DB::table('vw_alert_referral')->where('user_id',Auth::guard('member')->id())->get();
    		foreach($ref_vw_res as $refres)
    		$referral_meta[$refres->refid][] = array('change_time'=>$refres->change_time,'status'=>$refres->new_status );

    		$data['referral_meta'] = $referral_meta;

      foreach($netData as $net) {
        $data['network_days'][$net->network_id] = $net->trans_convert_days;
      }

      if ($request->ajax()) {
        if($request->cashback) {
          $data['cashback_data']  = DB::table('tb_user_transaction')
                                    ->join('tb_stores','tb_stores.store_id','=','tb_user_transaction.merchant_id')
                                    ->orderBy('tb_user_transaction.transaction_time','desc')
  								                  ->select('tb_user_transaction.*', 'store_name')
                                    ->whereuser_id(Auth::guard('member')->id());
              if($request->c_search != '') {
                $data['cashback_data']  =  $data['cashback_data']->where('tb_stores.store_name', 'like', '%' . $request->c_search . '%');
              }

             $whereInStatus =   $this->buildStatus($request);
              if(Count($whereInStatus) > 0) {
                $data['cashback_data']  =   $data['cashback_data']->whereIn('tb_user_transaction.status',$whereInStatus);
              }
              $data['cashback_data']    =  $data['cashback_data']->paginate(25);

                   return view('member-dash.member-partials.cashback-detail', compact('data'));
               }
        /* Cashback data end here */

        /*bonus Data start */
          if($request->bonus) {

            $data['bonus_data']     = DB::table('tb_user_bonus')
                                     ->join('tb_bonus_types','tb_bonus_types.bonus_code','=','tb_user_bonus.bonus_type')
                                     ->whereuser_id(Auth::guard('member')->id());
                                     // ->orderBy('tb_bonus_types.date_added','desc');

                $whereInStatus =   $this->buildStatus($request);

                 if(Count($whereInStatus) > 0) {
                   $data['bonus_data']  =   $data['bonus_data']->whereIn('tb_user_bonus.status',$whereInStatus);
                 }
                if($request->c_search != '') {
                  $data['bonus_data']  =  $data['bonus_data']->where('tb_bonus_types.bonus_name', 'like', '%' . $request->c_search . '%');
                }
                $data['bonus_data']    =  $data['bonus_data']->paginate(25);

                     return view('member-dash.member-partials.bonus-detail', compact('data'));
                 }

           /* bonus data end here */
           //refer
             if($request->refer) {
               $data['refer_data']    =  DB::table('tb_user_referrals')
                                            ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_referrals.ref_id')
                                            ->select('tb_user_referrals.refid','tb_user_referrals.joined_date','tb_user_referrals.bonus_amount','tb_user_referrals.status','tb_user_referrals.validity_date',
                                                     'tb_cashback_users.first_name','tb_cashback_users.last_name','tb_cashback_users.mobile_verified','tb_cashback_users.email_verified','tb_cashback_users.awarded_date')
                                            ->where('tb_user_referrals.user_id','=',Auth::guard('member')->id())
                                            ->orderBy('tb_user_referrals.joined_date','desc');
                if($request->c_search != '') {

                  $data['refer_data']  =  $data['refer_data']->where('tb_cashback_users.first_name', 'like', '%' . $request->c_search . '%');
                }
                $data['refer_data']    =  $data['refer_data']->paginate(25);

                return view('member-dash.member-partials.refer-detail', compact('data'));


             }

             //click
             if($request->click) {
               $data['click_data']    =  DB::table('tb_clicks')
                                       ->join('tb_stores','tb_stores.store_id','=','tb_clicks.store_id')
                                       ->where('tb_clicks.user_id','=',Auth::guard('member')->id())
                                       ->orderBy('tb_clicks.click_time','desc');

                if($request->c_search != '') {
                  $data['click_data']  =  $data['click_data']->where('tb_stores.store_name', 'like', '%' . $request->c_search . '%');
                }
                $data['click_data']    =  $data['click_data']->paginate(25);

                return view('member-dash.member-partials.click-detail', compact('data'));


             }
        }



                  //    die;
       return view('member-dash.cashback-activity.index',compact('data'));
    }

    public function buildStatus($request) {

      $status_requested = [];
      if($request->has('pending') && $request->has('confirmed') && $request->has('declined') ) {
          $status_requested  =['pending','approved','declined','confirmed'];
      }
      if($request->has('pending')) {
        $status_requested  =['pending'];
      }
      if($request->has('confirmed')) {
        $status_requested  = ['approved','confirmed'];
      }
      if($request->has('declined')) {
        $status_requested  = ['declined'];
      }
      if($request->has('pending') && $request->has('confirmed')) {
        $status_requested  = ['pending','approved','confirmed'];
      }
      if($request->has('confirmed') && $request->has('declined')) {
        $status_requested  = ['approved','declined','confirmed'];
      }
      if($request->has('pending') && $request->has('declined')) {
        $status_requested  = ['pending','declined'];
      }
        return $status_requested;
    }

}
