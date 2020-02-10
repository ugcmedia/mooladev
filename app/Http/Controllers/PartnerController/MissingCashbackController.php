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
class MissingCashbackController extends Controller
{

    public function index() {
        $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('MissingCashback')->first();
        $data['missingCashback'] = DB::table('tb_missing_cashback')->select('tb_missing_cashback.*','tb_stores.store_name','tb_clicks.click_time')
                                   ->join('tb_stores','tb_stores.store_id','=','tb_missing_cashback.tick_store_id')
                                   ->join('tb_clicks','tb_clicks.click_id','=','tb_missing_cashback.click_id')
                                   ->orderBy('tb_missing_cashback.tick_crDate','desc')
                                   ->wheretick_user_id(Auth::guard('member')->id())->get();

        return view('member-dash.missing-cashback.index',compact('data'));
    }

    public function createClaim(Request $request) {
      $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('MissingCashback')->first();
      $data['getStores']       = DB::select('SELECT * FROM `tb_stores` WHERE store_id IN (SELECT store_id FROM `tb_clicks` WHERE user_id = '.Auth::guard('member')->id().'  AND click_id NOT IN (SELECT click_id FROM `tb_missing_cashback`) AND click_time BETWEEN DATE_SUB(CURRENT_DATE , INTERVAL '.config("settingConfig.cb_claim_max_days").' DAY) AND DATE_SUB(CURRENT_DATE, INTERVAL  '.config("settingConfig.cb_claim_min_days").' DAY) AND network_id IS NOT NULL AND cashback_enabled = \'Y\')');

      if($request->getClicks) {
          $data  = DB::select('SELECT * FROM `tb_clicks` WHERE user_id = '.Auth::guard('member')->id().' AND click_id NOT IN (SELECT click_id FROM `tb_missing_cashback`) AND  store_id = '.$request->store_id.' AND click_time BETWEEN DATE_SUB(CURRENT_DATE , INTERVAL '.config("settingConfig.cb_claim_max_days").' DAY) AND DATE_SUB(CURRENT_DATE, INTERVAL '.config("settingConfig.cb_claim_min_days").' DAY) AND network_id IS NOT NULL AND cashback_enabled = \'Y\' ');
          $odata = '';
          if(count($data) > 0) {
            foreach ($data as $key => $value) {
                $odata .= '<option value="'.$value->click_id.'">'.$value->click_time.'</opiton>';
            }
          }

          return $odata;
      }
      return view('member-dash.missing-cashback.createClaim',compact('data'));
    }

     public function storeCashback(Request $request) {

      $validator = Validator::make($request->all(),[
             "store_id" => 'required|max:255',
             "click_id"  => 'required|max:255',
             "from"  => 'required|max:255',
             "order_id"  => 'required|max:255',
             "date_purchase"  => 'required|max:255',
             "proof_purchase"  => 'required|max:255',
             'user_comment'    => 'required'
          ]);

      if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->with('error')->withInput();
      }
        if($request->hasFile('ticket_image')) {
         $file = $request->ticket_image;

         $rules = array(
           'image' => 'mimes:jpeg,jpg,png,pdf|required|max:50000' // max 10000kb
         );
         // Now pass the input and rules into the validator
         $validator = Validator::make($fileArray, $rules);
         if ($validator->fails())
        {
            return redirect()->back()->with('error',trans('actionMsg.validation_img_error_missing'));
        }
         $extension = $request['ticket_image']->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         $ticket_image = $fileName;

         $file->move(public_path().'/uploads/images/user/', $fileName);
       }
       else {
        $ticket_image  = $request->ticket_image;
       }



        $data = [

          'trans_date'    => $request->date_purchase,
          'click_id'      => $request->click_id ,
          'network_id'    => '',
          'tick_user_id'  => Auth::guard('member')->id(),
          'tick_orderid'  => $request->order_id,
          'tick_amt'      => $request->total_amt,
          'tick_store_id' => $request->store_id,
          'user_comment'  => $request->user_comment,
        //  'user_desc'     => $request->proof_purchase ,
          'tick_image'    => $ticket_image,
          'tick_status'   => 'open',
          'tick_crDate'   => date('Y-m-d') ,
        ];
       $insertMissingCash  = DB::table('tb_missing_cashback')->insert($data);
        // dd($data);


       $lastId             = DB::getPdo()->lastInsertId();
       $updateMissingCash  = DB::select('UPDATE `tb_missing_cashback` mc , `tb_clicks` c
                                         SET mc.network_id = c.network_id , mc.click_url = c.out_link
                                         WHERE c.click_id = mc.click_id AND  tick_pkey = '.$lastId.''  );



       if($insertMissingCash) {

         $storeName          = DB::table('tb_stores')->wherestore_id($request->store_id)->first();
         $lastId             = DB::getPdo()->lastInsertId();
         $searchArr          = ['#MCClaimID','#StoreName','#OrderID','#TransactionAmount','#TransactionDate'];
         $repArr             = [$lastId,$storeName->store_name,$request->order_id,$request->total_amt,$request->date_purchase];
         $getEmailTemp       = AppClass::getTemplateByKey('missing_cashback_claim');

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
           // $smsBody          = str_ireplace('#FIRSTNAME',$createUser->first_name,$smsBody);
           // $smsBody          = str_ireplace('#LASTNAME',$createUser->last_name,$smsBody);
           if($getEmailTemp->sms_enabled == 'Y') {
               AppClass::sendSMSWithName($user->mobile_number,$smsBody);
           }
           AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,Session::get('memberDetail')->email);
         }


         return redirect()->back()->with('success',trans('actionMsg.missing_cashback_submit_success'));
       }
       else {
         return redirect()->back()->with('error',trans('actionMsg.missing_cashback_submit_error'));
       }

    }


    public function viewClaim($id) {
      $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('MissingCashback')->first();


      $missingCashDetail = DB::table('tb_missing_cashback')->select('tb_missing_cashback.*','tb_stores.store_name','tb_clicks.click_time')
                                 ->join('tb_stores','tb_stores.store_id','=','tb_missing_cashback.tick_store_id')
                                 ->join('tb_clicks','tb_clicks.click_id','=','tb_missing_cashback.click_id')
                                 ->wheretick_pkey($id)->first();
        $comments        = DB::table('tb_missing_cashback_comments')->wheretick_pkey($id)->orderBy('mccid','Desc')->get();
        return view('member-dash.missing-cashback.viewClaim',compact('missingCashDetail','comments','data'));
    }

    public function closeClaim($id) {
      DB::table('tb_missing_cashback')->wheretick_pkey($id)->update(['tick_status' => 'close','closed_by' => 'user','closed_date' => date('Y-m-d H:i:s')]);
      return  redirect()->route('member.missingCashback')->with('success',trans('actionMsg.missing_cashback_close_success'));
    }

    public function ReopenClaim($id) {

      DB::table('tb_missing_cashback')->wheretick_pkey($id)->update(['tick_status' => 'open','closed_by' => 'user']);
      return  redirect()->back()->with('success',trans('actionMsg.missing_cashback_reopen_success'));
    }

    public function storeComment(Request $request) {

      $insertCommentData = [
        'tick_pkey' => $request->claim_id,
        'comments'  => $request->comment,
        'added_by'  => 'user',
      ];

        $insertComment  = DB::table('tb_missing_cashback_comments')->insert($insertCommentData);
        if($insertComment)
          return redirect()->back()->with('success',trans('actionMsg.missing_cashback_comment_success'));
        else
          return redirect()->back()->with('error',trans('actionMsg.missing_cashback_comment_error'));

    }

}
