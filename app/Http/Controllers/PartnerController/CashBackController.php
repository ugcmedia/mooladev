<?php
namespace App\Http\Controllers\PartnerController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Partner;
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
class CashBackController extends Controller
{

    public function index()
    {




    }


    public function manage_cashback()
    {

                // dd(Session::get('partnerDetail'));
                $data='';

                if( isset( Session::get('partnerDetail')->vendor_id  ))
                    {
                      //  	$user_id=Session::get('memberDetail')->member_id;

                        // $data=DB::table('tb_user_transaction')
                        //         ->crossJoin('tb_cashback_users')
                        //         ->where('vendor_code', '=',Session::get('partnerDetail')->vendor_code)
                        //         ->where('tb_cashback_users.member_id','tb_user_transaction.user_id')
                        //         // ->orderBy('order_date', 'desc')
                        //         ->get();



                                $data=DB::table('tb_user_transaction')
                                                              ->join('tb_cashback_users', function ($join)
                                                              {
                                                                $join->on('tb_user_transaction.user_id', '=', 'tb_cashback_users.member_id')
                                                                          ->where('vendor_code', '=',Session::get('partnerDetail')->vendor_code);
                                                              })
                                                              ->orderBy('tb_user_transaction.order_date', 'desc')
                                                              ->get();
                    }
                            // print_r($data);
                            // die();


               return view('partner.cashback.managecashback',compact('data'));

    }


    public function update_cashback(Request $req)
    {

//dd($req);
          $v_coment= DB::table('tb_user_transaction')
                      ->where('transaction_id', $req->transaction)
                      ->where('user_id',$req->user)
                      ->update(
                                                [
                                                  'awarded_date' => date("Y-m-d H:i:s"),
                                                'vendor_comment' =>$req->v_comment ,
                                                'status' => $req->status
                                              ]
                                                  );

                            if(  $v_coment)
                            {
                                 $req>session()->put('v_updated','Record Updated.');
                                return back();
                            }
                              else
                              {
                                     $req->session()->put('v_updated','Record Not Updated.');
                                      return back();
                              }
      }

    public function cashback_dispuite()
    {
        $data='';
       //  dd(Session::get('partnerDetail'));
                if( isset( Session::get('partnerDetail')->vendor_id  ))
                    {
                          //  	$user_id=Session::get('memberDetail')->member_id;
                          $data=DB::table('tb_missing_cashback')
                                  ->select('tick_transaction_id','first_name','last_name','tick_crDate','tick_status','user_comment')
                                    ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_missing_cashback.tick_user_id')
                                    ->where('tick_vendor_code', '=',Session::get('partnerDetail')->vendor_code)
                                    ->get();
                    }
          // print_r($data);
          // die();
          return view('partner.cashback.cashbackdispuite',compact('data'));

    }





  }
