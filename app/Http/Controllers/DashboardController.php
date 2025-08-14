<?php

namespace App\Http\Controllers;

use App\Mail\MakePaymentMail;
use App\Mail\NominationSubmitMail;
use App\Models\Invoice;
use App\Models\Nomination;
use App\Notifications\Notifications\PaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nomination = Nomination::where('trash', false)->get();

        $total = Nomination::where('trash', true)->get();
        $totalpv = Nomination::where('pv', true)->get();
        $invoice = Invoice::where('trash', false)->get();

        return view('dashboard.index', [
            'page' => 'dashboard',
            'count' => $total->count(),
            'countpv' => $totalpv->count(),
            'invoice' => $invoice->count(),
            'all_nomination' => $nomination,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_date = Nomination::findOrFail($id);


        $update_date->update([
            'comment' => ucwords($request->comment),
        ]);

        return back()->with('success', 'Comment Added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data = Nomination::findOrFail($id);
        if ($delete_data->invoice != null) {
            $invoice = Invoice::where('invoice', $delete_data->invoice)->first();
            $invoice->update([
                'used' => $invoice->used - 1,
                'available' => $invoice->available + 1,
            ]);
        }
        $delete_data->delete();

        return back()->with('success', 'Data deleted successfully');
    }
    public function makePayment(Request $request)
    {
        $user_data = Nomination::where('ukey', $request->ukey)->first();
        $update_date = Nomination::findOrFail($user_data->id);
        // $user_data->notify(new PaymentNotification($user_data));
        Mail::to($request->email)->send(new MakePaymentMail($user_data));
        $update_date->update([
            'paymentLinkSend' => $user_data->paymentLinkSend + 1,
        ]);
        return redirect()->route('dashboard.index')->with('success', 'Payment Link Successfully Send To ' . $user_data->name);
    }
    public function paymentConfirmation(Request $request)
    {
        $order_information = Nomination::where('ukey', $request->ukey)->first();
        $update_date = Nomination::findOrFail($order_information->id);
        $order_details = DB::table('orders')
            ->where('transaction_id', $request->ukey)
            ->select('transaction_id', 'status', 'currency', 'amount', 'card_issuer', 'tran_date')->first();
        // Mail::to($order_information->email)->send(new NominationSubmitMail($order_information,$order_details));


        $user_data = [
            'id' => $order_information->id,
            'date' => $order_details->tran_date,
            'name' => $order_information->name,
            'email' => $order_information->email,
            'phone' => $order_information->phone,
            'ukey' => $request->ukey,
            'address' => $order_information->address,
            'title' => $order_information->title,
            'category' => $order_information->category,
            'organization' => $order_information->organization,
            'transaction_id' => $order_details->transaction_id,
            'status' => $order_details->status,
            'currency' => $order_details->currency,
            'amount' => $order_details->amount,
            'card_issuer' => $order_details->card_issuer,
            'tran_date' => $order_details->tran_date,
        ];

        $pdf = PDF::loadView('invoice_pdf', $user_data)->setPaper('a4', 'potrait')->set_option('marginTop', '1px')->set_option('marginLeft', '1px')->set_option('marginRight', '1px')->set_option('marginBottom', '1px');

        Mail::send('email.nomination', $user_data, function ($message) use ($user_data, $pdf) {
            $message->to($user_data["email"], $user_data["email"])
                ->subject('Payment Confirmation Mail')
                ->attachData($pdf->output(), "invoice-" . $user_data["ukey"] . ' | ' . time() . ".pdf");
        });
        $update_date->update([
            'confirmLinkSend' => $order_information->confirmLinkSend + 1,
        ]);


        return redirect()->route('paymentverified.index')->with('success', 'Confirmation Mail Successfully Send To ' . $order_information->name);
    }
    public function trash()
    {
        $nomination = Nomination::where('trash', true)->get();
        $total = Nomination::where('trash', false)->get();
        $totalpv = Nomination::where('pv', true)->get();
        $invoice = Invoice::where('trash', false)->get();
        return view('dashboard.index', [
            'page' => 'trash',
            'count' => count($total),
            'countpv' => count($totalpv),
            'invoice' => count($invoice),
            'all_nomination' => $nomination,
        ]);
    }
    public function pv()
    {
        $nomination = Nomination::where('pv', true)->get();
        $total = Nomination::where('trash', false)->get();
        $count1 = Nomination::where('trash', true)->get();
        $invoice = Invoice::where('trash', false)->get();
        return view('dashboard.index', [
            'page' => 'pv',
            'count' => count($total),
            'count1' => count($count1),
            'invoice' => count($invoice),
            'all_nomination' => $nomination,
        ]);
    }
    public function updateStatus($id)
    {
        $data = Nomination::where('ukey', $id)->first();

        if ($data->status) {
            $data->update([
                'status' => false,
            ]);
        } else {
            $data->update([
                'status' => true,
            ]);
        }
        return back()->with('success', 'Status updated successfully');
    }
    public function updateTrash($id)
    {
        $data = Nomination::where('ukey', $id)->first();

        if ($data->trash) {
            $data->update([
                'trash' => false,
            ]);
        } else {
            $data->update([
                'trash' => true,
            ]);
        }
        return back()->with('success', 'Trash updated successfully');
    }
    public function updatePV($id)
    {
        $data = Nomination::where('ukey', $id)->first();

        if ($data->pv) {
            $data->update([
                'pv' => false,
            ]);
        } else {
            $data->update([
                'pv' => true,
                'trash' => false,
            ]);
        }
        return back()->with('success', 'Payment Status updated successfully');
    }
    public function commentEmpty($id)
    {

        $update_date = Nomination::findOrFail($id);
        $update_date->update([
            'comment' => null,
        ]);

        return back()->with('success', 'Comment Removed');
    }
}
