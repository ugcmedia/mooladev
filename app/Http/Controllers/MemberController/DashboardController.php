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
class DashboardController extends Controller
{

    public function index(Request $request)
     {

    //  $data['page_data']    =  DB::table('tb_cashback_widgets')->wherecb_page('Dashboard')->first();
        /*cashback Data start */



        // $data['cashback_data']  = DB::table('tb_user_transaction')
        //                           ->join('tb_stores','tb_stores.store_id','=','tb_user_transaction.merchant_id')
        //                           ->whereuser_id(Auth::guard('member')->id())
        //                           ->orderBy('tb_user_transaction.transaction_time','desc')
        //                           ->take(25)->select('tb_user_transaction.*', 'store_name')
        //                           ->get();

        // $data['bonus_data']     =  DB::table('tb_user_bonus')
        //                           ->join('tb_bonus_types','tb_bonus_types.bonus_code','=','tb_user_bonus.bonus_type')
        //                           ->whereuser_id(Auth::guard('member')->id())
        //                           ->orderBy('tb_user_bonus.date_added','desc')
        //                           ->take(25)
        //                           ->get();

        // $data['refer_data']    =  DB::table('tb_user_referrals')
        //                             ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_referrals.ref_id')
        //                             ->join('tb_stores','tb_stores.store_id','=','tb_user_referrals.merchant_id')
        //                             ->select('tb_user_referrals.refid','tb_user_referrals.awarded_date','tb_user_referrals.bonus_amount','tb_user_referrals.status',
        //                                      'tb_cashback_users.first_name','tb_stores.store_name','tb_cashback_users.last_name','tb_cashback_users.mobile_verified','tb_cashback_users.email_verified')
        //                             ->where('tb_user_referrals.user_id','=',Auth::guard('member')->id())
        //                             ->orderBy('tb_user_referrals.utrid','desc')
        //                             ->take(25)
        //                             ->get();


		// $netData = DB::table('tb_network')->select('network_id','trans_convert_days')->get();

		// foreach($netData as $net)
		// $data['network_days'][$net->network_id] = $net->trans_convert_days;
        //
        // if ($request->ajax()) {
        //   if($request->cashback) {
        //     $data['cashback_data']  = DB::table('tb_user_transaction')
        //                               ->join('tb_stores','tb_stores.store_id','=','tb_user_transaction.merchant_id')
        //                               ->whereuser_id(Auth::guard('member')->id())
        //                               ->orderBy('tb_user_transaction.transaction_time','desc');
        //
        //
        //         $data['cashback_data']    =  $data['cashback_data']->paginate(25);
        //              return view('member-dash.member-partials.cashback-detail', compact('data'));
        //          }
        //
        //   /* Cashback data end here */
        //   /*bonus Data start */
        //     if($request->bonus) {
        //
        //       $data['bonus_data']     = DB::table('tb_user_bonus')
        //                                ->join('tb_bonus_types','tb_bonus_types.bonus_code','=','tb_user_bonus.bonus_type')
        //                                ->whereuser_id(Auth::guard('member')->id())
        //                                ->orderBy('tb_bonus_types.date_added','desc');
        //
        //
        //
        //           $data['bonus_data']    =  $data['bonus_data']->paginate(25);
        //
        //                return view('member-dash.member-partials.bonus-detail', compact('data'));
        //            }
        //
        //      /* bonus data end here */
        //      //refer
        //        if($request->refer) {
        //          $data['refer_data']    =  DB::table('tb_user_referrals')
        //                                       ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_referrals.ref_id')
        //                                       ->select('tb_user_referrals.refid','tb_user_referrals.joined_date','tb_user_referrals.bonus_amount','tb_user_referrals.status','tb_user_referrals.validity_date',
        //                                                'tb_cashback_users.first_name','tb_cashback_users.last_name','tb_cashback_users.mobile_verified','tb_cashback_users.email_verified','tb_cashback_users.join_date')
        //                                       ->where('tb_user_referrals.user_id','=',Auth::guard('member')->id())
        //                                       ->orderBy('joined_date','desc');
        //
        //           $data['refer_data']    =  $data['refer_data']->paginate(25);
        //
        //           return view('member-dash.member-partials.refer-detail', compact('data'));
        //
        //        }
        //
        //
        //   }


$data='';
if( isset( Session::get('memberDetail')->member_id) )
    {
      //  	$user_id=Session::get('memberDetail')->member_id;

        // $data=DB::table('tb_user_transaction')
        //         ->where('user_id', '=',$user_id)
        //         ->get();

        $data=DB::table('tb_user_transaction')
                              ->join('tb_vendors', function ($join)
                               {
                                        $join->on('tb_user_transaction.vendor_code', '=', 'tb_vendors.vendor_code')
                                        ->where('tb_user_transaction.user_id', '=',Session::get('memberDetail')->member_id);
                                })
                                ->get();






    }
    //print_r($data);
        return view('member-dash.dashboard',compact('data'));
    }


    public function cashback_transaction(Request $request)
    {

            $data='';
            if( isset( Session::get('memberDetail')->member_id) )
                {
                    // 	$user_id=Session::get('memberDetail')->member_id;
                    //
                    // $data=DB::table('tb_user_transaction')
                    //         ->where('user_id', '=',$user_id)
                    //         ->get();

                    $data=DB::table('tb_user_transaction')
                                          ->join('tb_vendors', function ($join)
                                           {
                                                    $join->on('tb_user_transaction.vendor_code', '=', 'tb_vendors.vendor_code')
                                                    ->where('tb_user_transaction.user_id', '=',Session::get('memberDetail')->member_id);
                                            })
                                            ->get();
                }
              //  print_r($data);





            return view('member-dash.cashback.Cashback_Transaction',compact('data'));
    }

    public function claim_cashback(Request $request)
    {
      $data=DB::table('tb_user_transaction')
               ->where('user_id', '=',Session::get('memberDetail')->member_id)
               ->where('status', '=','declined' )
               ->get();



//print_r($data);
            return view('member-dash.cashback.claim_cashback',compact('data'));
    }


    public function dummyNoti($id = null) {
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

   public function upload_receipt(Request $req)
    {


    //  dd(Auth::guard('member')->id() );

      $image=($_FILES["chk_image"]["name"]);
      $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));


      if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif"  && $imageFileType != "pdf")
      {
       $req->session()->put('invalid_image', '<strong>Ohh.... !</strong> ( '.$imageFileType.' ) is not allowed ,Please Select Image File.(like, jpg , png , pdf )');
       return redirect()->back()->withInput();
      }

      //  dd($req);

      $vendor_code=DB::table('tb_user_transaction')->select('vendor_code')->where('transaction_id',$req->transaction_id)->get();


$data=array('tick_user_id'=>Auth::guard('member')->id(),
                      'tick_transaction_id' =>$req->transaction_id,
                      'tick_vendor_code' =>$vendor_code[0]->vendor_code,
                      'tick_crDate'=>date("Y-m-d"),
                      'tick_image' =>$image,
                      'user_comment'=>$req->comment,
                      'tick_status'=>$req->status
                    );
//print_r($data);

    $check=DB::table('tb_missing_cashback')->where('tick_transaction_id',$req->transaction_id)->count();

//dd($check);
// print_r ($check);
// die();


      if($check == '0')
      {
                   $add_missing_cashback=DB::table('tb_missing_cashback')->insert($data);
                   //echo$add_missing_cashback;


                   							if ($add_missing_cashback)
                   							{

                   										$req->session()->put('miss_chashback_tra', '<strong>Thank You!</strong>  For for Uploding Your Claim Cashback Report We Will Chack Soon and We Will Get Back To You.');
                   										return redirect()->back();
                   								//echo "<script> alert(' Thank You For for Uploding Your Purchase Receipt We Will Chack Soon and We Will Get Back To You	.'); </script>";

                   							}
                   							else
                   							{
                   										$req->session()->put('miss_chashback_tra', '<strong>Sorry!</strong>  For for Uploding Data is invalid <strong>Please Try again</strong>... ');
                   										return redirect()->back();
                   								//echo "<script> alert('Tb_user_transaction data Not  save.'); </script>";

                   							}

        }
          else
            {
                $req->session()->put('all_redy', '<strong>Ohh!</strong>  Your Claim Cashback Report is  <strong> All Redy Submited.</strong>... ');
                return redirect()->back();
            }










    }

}
