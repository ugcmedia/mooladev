<?php
namespace App\Http\Controllers\PartnerController;
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
class DashboardController extends Controller
{

    public function index(Request $request)
    {

    //   $data['page_data']    =  DB::table('tb_cashback_widgets')->wherecb_page('Dashboard')->first();
        /*cashback Data start */
    //     $data['cashback_data']  = DB::table('tb_user_transaction')
    //                               ->join('tb_stores','tb_stores.store_id','=','tb_user_transaction.merchant_id')
    //                               ->whereuser_id(Auth::guard('member')->id())
    //                               ->orderBy('tb_user_transaction.transaction_time','desc')
    //                               ->take(25)->select('tb_user_transaction.*', 'store_name')
    //                               ->get();
    //
    //     $data['bonus_data']     =  DB::table('tb_user_bonus')
    //                               ->join('tb_bonus_types','tb_bonus_types.bonus_code','=','tb_user_bonus.bonus_type')
    //                               ->whereuser_id(Auth::guard('member')->id())
    //                               ->orderBy('tb_user_bonus.date_added','desc')
    //                               ->take(25)
    //                               ->get();
    //
    //     $data['refer_data']    =  DB::table('tb_user_referrals')
    //                                 ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_referrals.ref_id')
    //                                 ->join('tb_stores','tb_stores.store_id','=','tb_user_referrals.merchant_id')
    //                                 ->select('tb_user_referrals.refid','tb_user_referrals.awarded_date','tb_user_referrals.bonus_amount','tb_user_referrals.status',
    //                                          'tb_cashback_users.first_name','tb_stores.store_name','tb_cashback_users.last_name','tb_cashback_users.mobile_verified','tb_cashback_users.email_verified')
    //                                 ->where('tb_user_referrals.user_id','=',Auth::guard('member')->id())
    //                                 ->orderBy('tb_user_referrals.utrid','desc')
    //                                 ->take(25)
    //                                 ->get();
		// $netData = DB::table('tb_network')->select('network_id','trans_convert_days')->get();
    //
		// foreach($netData as $net)
		// $data['network_days'][$net->network_id] = $net->trans_convert_days;
    //     //
    //     // if ($request->ajax()) {
    //     //   if($request->cashback) {
    //     //     $data['cashback_data']  = DB::table('tb_user_transaction')
    //     //                               ->join('tb_stores','tb_stores.store_id','=','tb_user_transaction.merchant_id')
    //     //                               ->whereuser_id(Auth::guard('member')->id())
    //     //                               ->orderBy('tb_user_transaction.transaction_time','desc');
    //     //
    //     //
    //     //         $data['cashback_data']    =  $data['cashback_data']->paginate(25);
    //     //              return view('member-dash.member-partials.cashback-detail', compact('data'));
    //     //          }
    //     //
    //     //   /* Cashback data end here */
    //     //   /*bonus Data start */
    //     //     if($request->bonus) {
    //     //
    //     //       $data['bonus_data']     = DB::table('tb_user_bonus')
    //     //                                ->join('tb_bonus_types','tb_bonus_types.bonus_code','=','tb_user_bonus.bonus_type')
    //     //                                ->whereuser_id(Auth::guard('member')->id())
    //     //                                ->orderBy('tb_bonus_types.date_added','desc');
    //     //
    //     //
    //     //
    //     //           $data['bonus_data']    =  $data['bonus_data']->paginate(25);
    //     //
    //     //                return view('member-dash.member-partials.bonus-detail', compact('data'));
    //     //            }
    //     //
    //     //      /* bonus data end here */
    //     //      //refer
    //     //        if($request->refer) {
    //     //          $data['refer_data']    =  DB::table('tb_user_referrals')
    //     //                                       ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_referrals.ref_id')
    //     //                                       ->select('tb_user_referrals.refid','tb_user_referrals.joined_date','tb_user_referrals.bonus_amount','tb_user_referrals.status','tb_user_referrals.validity_date',
    //     //                                                'tb_cashback_users.first_name','tb_cashback_users.last_name','tb_cashback_users.mobile_verified','tb_cashback_users.email_verified','tb_cashback_users.join_date')
    //     //                                       ->where('tb_user_referrals.user_id','=',Auth::guard('member')->id())
    //     //                                       ->orderBy('joined_date','desc');
    //     //
    //     //           $data['refer_data']    =  $data['refer_data']->paginate(25);
    //     //
    //     //           return view('member-dash.member-partials.refer-detail', compact('data'));
    //     //
    //     //        }
    //     //
    //     //
    //     //   }



//dd( Session::get('partnerDetail'));


    $data=$total_sale=$my_offer=$total_cashback=$total_customer=$total_offer="";

    if( isset( Session::get('partnerDetail')->vendor_id  ))
        {
                $data=DB::table('tb_user_transaction')
                                                  ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_transaction.user_id')
                                                  ->where('vendor_code', '=',Session::get('partnerDetail')->vendor_code)
                                                  ->orderBy('tb_user_transaction.order_date', 'desc')
                                                  ->limit(5)
                                                  ->get();

                  $my_offer=DB::table('tb_offers')
                                                  ->where('vendor_code', '=',Session::get('partnerDetail')->vendor_code)
                                                  ->limit(5)
                                                  ->orderBy('clicks', 'desc')
                                                  ->get();
                  //Total Values

                      $total_sale=DB::table('tb_user_transaction')
                                                 ->where('vendor_code', '=',Session::get('partnerDetail')->vendor_code)
                                                 ->sum('transaction_amount');
                      $total_cashback=DB::table('tb_user_transaction')
                                                  ->where('vendor_code', '=',Session::get('partnerDetail')->vendor_code)
                                                  ->where('status','confirmed')
                                                   ->sum('cashback_amount');
                      $total_customer=DB::table('tb_user_transaction')
                                                    ->where('vendor_code', '=',Session::get('partnerDetail')->vendor_code)
                                                    ->count();

                      $total_offer=DB::table('tb_offers')
                                                      ->where('vendor_code', '=',Session::get('partnerDetail')->vendor_code)
                                                      ->count();
            // print_r($my_offer);
            // die();

            // $data=DB::table('tb_missing_cashback')
            //                       ->join('tb_vendors', function ($join)
            //                        {
            //                                 $join->on('tb_user_transaction.vendor_code', '=', 'tb_vendors.vendor_code')
            //                                 ->where('tb_user_transaction.user_id', '=',Session::get('memberDetail')->member_id);
            //                         })
            //                         ->get();




    }
     return view('partner.dashboard',compact('data'),
                        ['total_sale'=>$total_sale,
                        'total_cashback'=>$total_cashback,
                        'total_customer'=>$total_customer,
                        'total_offer'=>  $total_offer,
                        'my_offer'=>$my_offer
                        ]);
  }

    public function dummyNoti($id = null)
     {
      if(!$id) {
        $getUsers = DB::table('tb_cashback_users')->where('account_status','active')->get();
        foreach ($getUsers as $key => $value) {
            PushNotification::PushNotifications(trans('notification.welcome.title'),trans('notification.welcome.sub_title'),'dealswoot-desktop-'.$value->member_id.'');
        }
      }
      else {
        $getUsers = DB::table('tb_cashback_users')->where('account_status','active')->where('member_id',$id)->first();
        PushNotification::PushNotifications(trans('notification.welcome.title'),trans('notification.welcome.sub_title'),'dealswoot-desktop-'.$id);
      }

    }


}
