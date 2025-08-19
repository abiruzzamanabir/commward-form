<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Theme;
use App\Mail\NominationSubmitMail;
use Illuminate\Support\Facades\Mail;
use PDF;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        $theme= Theme::find(1);
        $total = $theme->amount+($theme->amount*0.15);
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $request->ukey; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "Commward 2025";
        $post_data['value_b'] = "Commward 2025";
        $post_data['value_c'] = "Commward 2025";
        $post_data['value_d'] = "Commward 2025";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        // echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $card_issuer= $request->input('card_issuer');
        $tran_date= $request->input('tran_date');
        $bank_tran_id= $request->input('bank_tran_id');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','tran_date')->orderBy('id','desc')->first();
        $order_information = DB::table('nominations')
            ->where('ukey', $tran_id)
            ->select('id','created_at','name', 'email', 'phone','ukey','address','category','organization')->first();

        if ($order_details->status == 'Pending' || $order_details->status == 'Processing') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing', 'card_issuer' => $card_issuer,'tran_date'=> $tran_date,'bank_tran_id'=>$bank_tran_id]);

                $update_status = DB::table('nominations')
                    ->where('ukey', $tran_id)
                    ->update(['payment' => '2','trash' => false,'pv'=>true]);
            $user_data = [
                'id' => $order_information->id,
                'date' => $tran_date,
                'name' => $order_information->name,
                'email' => $order_information->email,
                'phone' => $order_information->phone,
                'ukey' => $tran_id,
                'address' => $order_information->address,
                'category' => $order_information->category,
                'organization' => $order_information->organization,
                'transaction_id' => $order_details->transaction_id,
                'tran_date' => $tran_date,
                'status' => $order_details->status,
                'currency' => $order_details->currency,
                'amount' => $order_details->amount,
                'card_issuer' => $card_issuer,
            ];

            // $user_data["name"] = $request->name;
            // $user_data["email"] = $request->email;
            // $user_data["phone"] = $request->phone;
            // $user_data["ukey"] = $ukey;
            // $user_data["title"] = $request->title;
            // $user_data["category"] = $request->category;
            // $user_data["organization"] = $request->organization_name;
            // Mail::to($request->email)->send(new NominationSubmitMail($data));
            // $user_data->notify(new PaymentNotification($user_data));
            // Mail::to($request->email)->send(new MakePaymentMail($user_data));
            $pdf = PDF::loadView('invoice_pdf', $user_data)->setPaper('a4', 'potrait')->set_option('marginTop', '1px')->set_option('marginLeft', '1px')->set_option('marginRight', '1px')->set_option('marginBottom', '1px');

            Mail::send('email.nomination', $user_data, function ($message) use ($user_data, $pdf) {
                $message->to($user_data["email"], $user_data["email"])
                    ->subject('Payment Received Mail')
                    ->attachData($pdf->output(), "invoice_pdf_".$user_data["ukey"].".pdf");
            });
                    // Mail::to($order_information->email)->send(new NominationSubmitMail($order_information,$order_details));
                    // return redirect()->route('form.index')->with('success', 'Transaction is successfully Completed');
                                return redirect()->route('form.thank', $tran_id);

                }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            // return redirect()->route('form.index')->with('success', 'Transaction is successfully Completed');
                        return redirect()->route('form.thank', $tran_id);

        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return redirect()->route('nomination.index')->with('warning', 'Invalid Transaction');
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);

            return redirect()->route('form.index')->with('danger', 'Transaction is Falied');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return redirect()->route('form.index')->with('success', 'Transaction is already Successful');
        } else {
            return redirect()->route('form.index')->with('warning', 'Transaction is Invalid');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            return redirect()->route('form.index')->with('danger', 'Transaction is Cancel');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return redirect()->route('form.index')->with('success', 'Transaction is already Successful');
        } else {
            return redirect()->route('form.index')->with('danger', 'Transaction is Invalid');
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    return redirect()->route('form.index')->with('success', 'Transaction is successfully Completed');
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                return redirect()->route('form.index')->with('success', 'Transaction is already successfully Completed');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                return redirect()->route('form.index')->with('warning', 'Invalid Transaction');
            }
        } else {
            return redirect()->route('form.index')->with('danger', 'Invalid Data');
        }
    }

}
