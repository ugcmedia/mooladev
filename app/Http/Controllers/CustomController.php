<?php namespace App\Http\Controllers;

use Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 

use Illuminate\Config;
use DB;


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


class CustomController extends Controller {

	function withdrawPaypal(Request $request)
	{
		
		
		
		$paypal_conf = \Config::get('paypal');
        $apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $apiContext->setConfig($paypal_conf['settings']);
		
		$this->_apiContext = $apiContext;
		
		$data = $request::all();
		$redirect = $_SERVER['HTTP_REFERER'];
		$withdrawal_id = $data['withdrawal_id'];
		$user_id = $data['user_id'];
		$mode = $data['mode'];
		$amount_pay = $data['amount'];
		$mode_info1 = $data['mode_info1'];
		$payment_note = $data['payment_note'];
		$transaction_id = time().$withdrawal_id;
		if($mode=='paypal')
		{
			
			$payouts = new \PayPal\Api\Payout();
				// This is how our body should look like:
				/*
				 * {
							"sender_batch_header":{
								"sender_batch_id":"2014021801",
								"email_subject":"You have a Payout!"
							},
							"items":[
								{
									"recipient_type":"EMAIL",
									"amount":{
										"value":"1.0",
										"currency":"USD"
									},
									"note":"Thanks for your patronage!",
									"sender_item_id":"2014031400023",
									"receiver":"shirt-supplier-one@mail.com"
								}
							]
						}
				 */
				$senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
				// ### NOTE:
				// You can prevent duplicate batches from being processed. If you specify a `sender_batch_id` that was used in the last 30 days, the batch will not be processed. For items, you can specify a `sender_item_id`. If the value for the `sender_item_id` is a duplicate of a payout item that was processed in the last 30 days, the item will not be processed.
				// #### Batch Header Instance
				$senderBatchHeader->setSenderBatchId($transaction_id)
					->setEmailSubject( str_replace( array('#WEBSITE','#AMOUNT'),array(config('sximo.cnf_appname'),$amount_pay ),config('settingConfig.paypal_subject') )  );
				// #### Sender Item
				// Please note that if you are using single payout with sync mode, you can only pass one Item in the request
				$senderItem = new \PayPal\Api\PayoutItem();
				$senderItem->setRecipientType('Email')
					->setNote(str_replace( array('#WEBSITE','#AMOUNT'),array(config('sximo.cnf_appname'),$amount_pay ),config('settingConfig.paypal_body') ))
					->setReceiver($mode_info1)
					->setSenderItemId($transaction_id)
					->setAmount(new \PayPal\Api\Currency('{
										"value":'.$amount_pay.',
										"currency":"'.config('settingConfig.paypal_currency').'"
									}'));
				$payouts->setSenderBatchHeader($senderBatchHeader)
					->addItem($senderItem);
				// For Sample Purposes Only.
				$request = clone $payouts;
				// ### Create Payout
				try {
	
					$output = $payouts->createSynchronous($apiContext);
				}
				catch (Exception $ex) {
					
					// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
					ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
					exit(1);
				}
				// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
				$payout_id = $output->getBatchHeader()->getPayoutBatchId();
				
				DB::table('tb_user_withdrawals')->where('withdrawal_id',$withdrawal_id)->update([
				  'status'   => 'processing',
				  'payment_reference_number'   => $payout_id,
				  'payment_note'   => $payment_note,
				  'payment_transaction_id' => $transaction_id,
				  'payment_date'   => date('Y-m-d')
				]);

				return redirect()->back()->with('success', 'Processed Successfully');

		}
	}
}


