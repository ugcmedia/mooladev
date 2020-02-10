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
use App\Helpers\AppClass;


/**
 *
 */
class WithdrawController extends Controller
{

    public function index()
     {

      //  $data['page_data']        =  DB::table('tb_cashback_widgets')->wherecb_page('Withdrawal')->first();
      //  $data['payout_type']      =  DB::table('tb_payout_types')->whereenabled('Y')->get();
      //  $data['payout_data']      = DB::table('tb_cashback_user_methods')->join('tb_payout_types','tb_payout_types.code','=','tb_cashback_user_methods.payout_type')->where('tb_cashback_user_methods.member_id',Auth::guard('member')->id())->where('tb_payout_types.enabled','Y')->get();
         //       DB::select('SELECT * FROM `tb_cashback_user_methods` um , `tb_payout_types` pt WHERE um.member_id = '.Auth::guard('member')->id().' AND um.payout_type = pt.code AND pt.enabled = \'Y\' ');
    //    $data['withdraw_history'] =  DB::table('tb_user_withdrawals')->join('tb_payout_types','tb_payout_types.code','=','tb_user_withdrawals.mode')->where('tb_user_withdrawals.user_id',Auth::guard('member')->id())->orderBy('tb_user_withdrawals.withdrawal_request_date','DESC')->paginate(2);
  //       DB::select('SELECT * FROM `tb_user_withdrawals` uw , `tb_payout_types` py WHERE uw.user_id = '.Auth::guard('member')->id().' AND uw.mode = py.code ORDER BY withdrawal_request_date DESC' );
		$withdraw_meta = array();
	//	$withdraw_vw_res = DB::table('vw_alert_withdrawal')->where('user_id',Auth::guard('member')->id())->get();
		//foreach($withdraw_vw_res as $wthres)
		//$withdraw_meta[$wthres->withdrawal_id][] = array('change_time'=>$wthres->change_time,'status'=>$wthres->new_status );

		$data['withdraw_meta'] = $withdraw_meta;

       return view('member-dash.withdraw.index',compact('data'));
    }

    public function storePayouts(Request $request) {

      $insertIntoPayout = DB::table('tb_cashback_user_methods')->insert([
        'member_id'      => Auth::guard('member')->id(),
        'payout_type'    => $request->payout_type,
        'payout_info1'   => $request->info1,
        'payout_info2'   => $request->info2,
        'payout_info3'   => $request->info3,
        'payout_info4'   => $request->info4,
        'payout_info5'   => $request->info5,
      ]);

      if($insertIntoPayout) {


        return redirect()->back()->with('success',trans('actionMsg.withdraw_submit_success'));
      }
      else {
        return redirect()->back()->with('error',trans('actionMsg.withdraw_submit_error'));
      }

    }

    public function updatePayouts(Request $request ,$id) {
        $updatePayout = DB::table('tb_cashback_user_methods')->wheremetid($id)->update([
          'payout_info1'   => $request->info1,
          'payout_info2'   => $request->info2,
          'payout_info3'   => $request->info3,
          'payout_info4'   => $request->info4,
          'payout_info5'   => $request->info5,
        ]);
        return redirect()->back()->with('success',trans('actionMsg.withdraw_update_success'));
    }

    public function deletePayouts($id) {
        $deletePayout = DB::table('tb_cashback_user_methods')->wheremetid($id)->delete();
        return redirect()->back()->with('success',trans('actionMsg.withdraw_delete_error'));
    }

    public function DoWithdraw(Request $request) {
        $getBal  = AppClass::getAllBal();

		if($request->withdrawal_amount <= 0 ){
          return redirect()->back()->with('error',trans('actionMsg.withdraw_transfer_error'));
        }


        $avail_reward  = $getBal['reward-confirmed'] - $getBal['Paidout'][0]->paidReward;
        $avail_cashback  = $getBal['cashback-confirmed'] - $getBal['Paidout'][0]->paidCashback;
        $avail_bonus  = $getBal['bonus-confirmed'] - $getBal['Paidout'][0]->paidBonus;
		$allowed_cashback = 0;
		 $payout_mode = DB::table('tb_payout_types')->wherecode($request->mode)->first();
		$allowed_modes = explode(',',$payout_mode->cashback_allowed) ;

		if( AppClass::Isfirst_trans())
		$min_transaction = $payout_mode->minimum_first_transaction;
		else
		$min_transaction = $payout_mode->minimum_transaction;

		if($request->withdrawal_amount < $min_transaction ){
          return redirect()->back()->with('error',trans('actionMsg.withdraw_transaction_error'));
        }



		if( in_array('reward',$allowed_modes))
			$allowed_cashback += $avail_reward;
		if( in_array('cashback',$allowed_modes))
			$allowed_cashback += $avail_cashback;
		if( in_array('bonus',$allowed_modes))
			$allowed_cashback += $avail_bonus;

		$user_exceed = true; $user_subzero = true;

		if( $request->withdrawal_amount <= $allowed_cashback  )
			$user_exceed = false;
		if($request->withdrawal_amount>0)
			$user_subzero = false;

		if(!$user_exceed )
		{
		$pending_amount = $request->withdrawal_amount;

		$total_amount = $request->withdrawal_amount;
		$bonus_amount = 0;
		$cashback_amount = 0;
		$reward_amount= 0;

		if( in_array('bonus',$allowed_modes))
		{
		if($pending_amount > $avail_bonus && $pending_amount > 0)
		$bonus_amount = $avail_bonus;
		else
			$bonus_amount = $pending_amount;

		$pending_amount = $pending_amount - $bonus_amount;
		}

		if( in_array('reward',$allowed_modes))
		{
		if($pending_amount > $avail_reward && $pending_amount > 0)
		$reward_amount = $avail_reward;
		else
			$reward_amount = $pending_amount;

		$pending_amount = $pending_amount - $reward_amount;

		}


		if( in_array('cashback',$allowed_modes))
		{
		if($pending_amount > $avail_cashback && $pending_amount > 0)
		$cashback_amount = $avail_cashback;
		else
			$cashback_amount = $pending_amount;

		$pending_amount = $pending_amount - $cashback_amount;
		}


		if($pending_amount != 0 )
				return redirect()->back()->with('error',trans('actionMsg.withdraw_amount_error'));

		$insertToWithdraw  = true;
		 	DB::table('tb_user_withdrawals')->insert([
          'user_id'                 => Auth::guard('member')->id(),
          'mode'                    => $request->mode,
          'amount'                  => $request->withdrawal_amount,
		  'cashback_amount'			=> $cashback_amount,
		  'reward_amount'			=> $reward_amount,
		  'bonus_amount'			=> $bonus_amount,
          'mode_info1'              => $request->mode_info1,
          'mode_info2'              => $request->mode_info2,
          'mode_info3'              => $request->mode_info3,
          'mode_info4'              => $request->mode_info4,
          'mode_info5'              => $request->mode_info5,
          'withdrawal_request_date' => date('Y-m-d   H:i:s'),
          'status'                  => 'requested'
        ]);
        if($insertToWithdraw) {


        $lastId             = DB::getPdo()->lastInsertId();
        $searchArr          = ['#PayoutRequestID','#PayoutMode','#PayoutDetails','#PayoutAmount'];
        $repArr             = [$lastId,$request->mode,$request->mode_info1.'('.$request->mode_info2.')', $request->withdrawal_amount];
        $getEmailTemp       = AppClass::getTemplateByKey('payout_requested');

        if($getEmailTemp) {
          $subject          = $getEmailTemp->subject;
          $purpose          = $getEmailTemp->purpose;
          $sender_name      = $getEmailTemp->sender_name;
          $sender_email     = $getEmailTemp->sender_email;
          $reply_to         = $getEmailTemp->reply_to;
          $cc_email         = $getEmailTemp->cc_email;
          $body             = $getEmailTemp->body;
          $body             = str_ireplace($searchArr,$repArr,$body);
          $smsBody          = $getEmailTemp->sms_body;
          $smsBody          = str_ireplace('#FIRSTNAME',Session::get('memberDetail')->first_name,$smsBody);
          $smsBody          = str_ireplace('#LASTNAME',Session::get('memberDetail')->last_name,$smsBody);
          if($getEmailTemp->sms_enabled == 'Y') {
              AppClass::sendSMSWithName(Session::get('memberDetail')->mobile_number,$smsBody);
          }
          AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,Session::get('memberDetail')->email);
        }


          return redirect()->back()->with('success',trans('actionMsg.withdraw_request_success'));
        }
        else {
          return redirect()->back()->with('error',trans('actionMsg.withdraw_request_error'));
        }
		}
		else {
          return redirect()->back()->with('error',trans('actionMsg.withdraw_funds_error'));
        }


    }

	public function isFirstWithdrawal()
	{


		$withdrawCount = DB::table('tb_user_withdrawals')->where('user_id',Auth::guard('member')->id())->where('status','<>','rejected')->count();
		if($withdrawCount>0)
			return false;
		else
			return true;

	}

}
