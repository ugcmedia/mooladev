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
class TicketController extends Controller
{

    public function index() {
        $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('Tickets')->first();
        $data['ticket']          = DB::table('tb_tickets')->select('tb_tickets.*','tb_stores.store_name','tb_user_transaction.transaction_amount','tb_user_transaction.merchant_id','tb_user_transaction.transaction_time')
                                   ->join('tb_user_transaction','tb_user_transaction.utrid','=','tb_tickets.transaction_id')
                                   ->join('tb_stores','tb_stores.store_id','=','tb_tickets.store_id')
                                   ->where('tb_tickets.user_id',Auth::guard('member')->id())
                                   ->orderBy('tb_tickets.raised_date','desc')
                                   ->get();

        return view('member-dash.ticket.index',compact('data'));
    }

    public function createTicket(Request $request) {

      $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('Tickets')->first();
    //  $data['getStores']       = DB::select('SELECT * FROM `tb_stores` WHERE store_id IN (SELECT merchant_id FROM `tb_user_transaction` WHERE user_id = '.Auth::guard('member')->id().' AND transaction_id NOT IN (SELECT transaction_id FROM tb_tickets) )');
        $data['getStores'] = DB::select('SELECT DISTINCT ts.* FROM `tb_user_transaction` ,  `tb_stores` ts  WHERE transaction_id NOT IN (SELECT transaction_id FROM `tb_tickets`) AND user_id = '.Auth::guard('member')->id().' AND store_id = merchant_id');
      $data['reason']          = DB::table('tb_status')->wherestatus_type('tickets')->get();

      if($request->getTrans) {
          $data  = DB::select('SELECT * FROM `tb_user_transaction` WHERE user_id = '.Auth::guard('member')->id().' AND merchant_id = '.$request->store_id);

          $odata = '';
          if(count($data) > 0) {
            foreach ($data as $key => $value) {
                $odata .= '<option value="'.$value->transaction_id.'">'.$value->transaction_time.'</opiton>';
            }
          }
          return $odata;
      }

      return view('member-dash.ticket.createTicket',compact('data'));
    }

     public function storeTicket(Request $request) {

      $validator = Validator::make($request->all(),[
             "store_id" => 'required|max:255',
             "trans_id"  => 'required|max:255',
             "reason"  => 'required|max:255',
          ]);

      if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->with('error')->withInput();
      }

        $data = [

          'transaction_id'      => $request->trans_id ,
          'user_id'             => Auth::guard('member')->id(),
          'reason'              => $request->reason,
          'user_note'           => $request->note,
          'store_id'            => $request->store_id,
          'status'              => 'open',

        ];

       $insertMissingCash = DB::table('tb_tickets')->insert($data);
       if($insertMissingCash) {

      //   $storeName          = DB::table('tb_stores')->wherestore_id($request->store_id)->first();
         $lastId             = DB::getPdo()->lastInsertId();
         $searchArr          = ['#SupportTicketID ','#SupportTicketContent'];
         $repArr             = [$lastId,$request->note,];
         $getEmailTemp       = AppClass::getTemplateByKey('support_tkt_created');

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


         return redirect()->back()->with('success',trans('actionMsg.ticket_submit_success'));
       }
       else {
         return redirect()->back()->with('error',trans('actionMsg.ticket_submit_error'));
       }

    }


    public function viewTicket($id) {
      $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('Tickets')->first();
      $ticket                  =  DB::table('tb_tickets')->select('tb_tickets.*','tb_stores.store_name','tb_user_transaction.transaction_amount','tb_user_transaction.merchant_id','tb_user_transaction.transaction_time')
                                 ->join('tb_user_transaction','tb_user_transaction.utrid','=','tb_tickets.transaction_id')
                                 ->join('tb_stores','tb_stores.store_id','=','tb_tickets.store_id')
                                 ->where('tb_tickets.ticket_id',$id)
                                 ->where('tb_tickets.user_id',Auth::guard('member')->id())
                                 ->first();

        $comments        = DB::table('tb_ticket_comments')->whereticket_id($id)->orderBy('tcmid','Desc')->get();

        return view('member-dash.ticket.viewTicket',compact('ticket','comments','data'));
    }


    public function closeTicket($id) {
      DB::table('tb_tickets')->whereticket_id($id)->update(['status' => 'close','closed_by' => 'user']);
      return  redirect()->route('member.ticket')->with('success',trans('actionMsg.ticket_close_success'));
    }

    public function ReopenTicket($id) {
      DB::table('tb_tickets')->whereticket_id($id)->update(['status' => 'reopen','closed_by' => 'user']);
      return  redirect()->back()->with('success',trans('actionMsg.ticket_reopen_success'));
    }

    public function storeComment(Request $request) {

      $insertCommentData = [
        'ticket_id' => $request->ticket_id,
        'comment'  => $request->comment,
        'added_by'  => 'user',
      ];

        $insertComment  = DB::table('tb_ticket_comments')->insert($insertCommentData);
        if($insertComment)
          return redirect()->back()->with('success',trans('actionMsg.ticket_comment_success'));
        else
          return redirect()->back()->with('error',trans('actionMsg.ticket_comment_error'));

    }

}
