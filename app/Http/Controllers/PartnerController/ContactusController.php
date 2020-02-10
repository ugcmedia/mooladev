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
use App\Helpers\AppClass;

/**
 *
 */
class ContactusController extends Controller
{

    public function index() {
          $data['page_data']  = DB::table('tb_cashback_widgets')->wherecb_page('Contact')->first();
          return view('member-dash.contact-us.index',compact('data'));
    }

    public function store(Request $request) {
      $validator = Validator::make($request->all(),[
              'reason'          => 'required|max:255',
              'sub_reason'          => 'required|max:255',
              'message'             => 'required|min:10',
          ]);

      if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->with('error')->withInput();
      }

       $insertContactUs = DB::table('tb_contacts')->insert(['name' => Session::get('memberDetail')->first_name,'email' => Session::get('memberDetail')->email,
      ]);
       if($insertContactUs) {
         $searchArr          = ['#NAME','#REASON','#MESSAGE'];
         $repArr             = [Session::get('memberDetail')->first_name,$request->reason,$request->message];
         $getEmailTemp       = AppClass::getTemplateByKey('contact_query_recd');

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
           if($getEmailTemp->sms_enabled == 'Y') {
               AppClass::sendSMSWithName(Session::get('memberDetail')->mobile_number,$smsBody);
           }
           AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,Session::get('memberDetail')->email);
         }
         return redirect()->back()->with('success',trans('actionMsg.contactus_submit_success') );
       }
       else {
         return redirect()->back()->with('error',trans('actionMsg.contactus_submit_error') );
       }

    }

}
