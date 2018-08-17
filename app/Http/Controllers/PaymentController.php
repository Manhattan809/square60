<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use App\Membership;
use App\Offer;
use App\User;

class PaymentController extends Controller
{
	private $_api_context;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		/** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function payWithpaypal($offer_id)
    {
    	$offer = Offer::where('id', $offer_id)->first();

		Session::put('offer_id', $offer_id);
		Session::put('membership_amount', $offer->amount);

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		$item_1 = new Item();
		$item_1->setName($offer->membership) /** item name **/
		            ->setCurrency('USD')
		            ->setQuantity(1)
		            ->setPrice($offer->amount); /** unit price **/
		$item_list = new ItemList();
		$item_list->setItems(array($item_1));
		$amount = new Amount();
		$amount->setCurrency('USD')
				->setTotal($offer->amount);
		$transaction = new Transaction();
		$transaction->setAmount($amount)
		            ->setItemList($item_list)
		            ->setDescription($offer->membership);
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/
						->setCancelUrl(URL::route('status'));
		$payment = new Payment();
		$payment->setIntent('Sale')
				->setPayer($payer)
				->setRedirectUrls($redirect_urls)
				->setTransactions(array($transaction));
		/** dd($payment->create($this->_api_context));exit; **/
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				\Session::put('error', 'Connection timeout');
				return Redirect::route('paywithpaypal');
			} else {
				\Session::put('error', 'Some error occur, sorry for inconvenient');
				return Redirect::route('paywithpaypal');
			}
		}
		foreach ($payment->getLinks() as $link) {
			if ($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
		/** add payment ID to session **/
		Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
			/** redirect to paypal **/
			return Redirect::away($redirect_url);
		}
		\Session::put('error', 'Unknown error occurred');
		return Redirect::route('paywithpaypal');
	}

	public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $offer_id = Session::get('offer_id');
        $amount = Session::get('membership_amount');
		/** clear the session payment ID **/
		Session::forget('paypal_payment_id');
		Session::forget('offer_id');
		Session::forget('membership_amount');
		if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
			\Session::put('error', 'Payment failed');
			return Redirect::route('home');
		}
		$payment = Payment::get($payment_id, $this->_api_context);
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
		/**Execute the payment **/
		$result = $payment->execute($execution, $this->_api_context);
		if ($result->getState() == 'approved') {
			\Session::put('success', 'Payment success');

			$start = date_create(date('Y-m-d'));
			$date = date_create(date('Y-m-d'));
			date_add($date, date_interval_create_from_date_string('1 month'));
			$end = date_format($date, 'Y-m-d');

			Membership::where('status', 1)
			          ->where('user_id', Auth::id())
			          ->update(['status' => 0]);

			$mem = new Membership;
	        $mem->user_id = Auth::id();
	        $mem->payment_id = $payment_id;
	        $mem->offer_id = $offer_id;
	        $mem->amount = $amount;
	        $mem->date_start = $start;
	        $mem->date_end = $end;
	        $mem->status = true;
	        $mem->save();

			return Redirect::route('home');
		}
		\Session::put('error', 'Payment failed');
		return Redirect::route('home');
	}

	public function payWithstripe(Request $request) 
	{
    	$offer = Offer::where('id', $request->get('offer_id'))->first();

        $offer_id = $offer->id;
        $amount = $offer->amount;
        $membership = $offer->membership;

		\Session::put('success', 'Payment success');

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey("sk_test_gd4NY9yWtbxW9aH7r7dfqklJ");

		// Token is created using Checkout or Elements!
		// Get the payment token ID submitted by the form:
		$token = $_POST['stripeToken'];
		$charge = \Stripe\Charge::create([
		    'amount' => str_replace('.', '', $amount),
		    'currency' => 'usd',
		    'description' => $membership,
		    'source' => $token,
		]);

        $payment_id = $token;
		$start = date_create(date('Y-m-d'));
		$date = date_create(date('Y-m-d'));
		date_add($date, date_interval_create_from_date_string('1 month'));
		$end = date_format($date, 'Y-m-d');

		Membership::where('status', 1)
		          ->where('user_id', Auth::id())
		          ->update(['status' => 0]);

		$mem = new Membership;
        $mem->user_id = Auth::id();
        $mem->payment_id = $payment_id;
        $mem->offer_id = $offer_id;
        $mem->amount = $amount;
        $mem->date_start = $start;
        $mem->date_end = $end;
        $mem->status = true;
        $mem->save();

		return Redirect::route('home');
	}
}
