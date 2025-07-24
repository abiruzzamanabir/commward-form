<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Nomination;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = Invoice::where('trash',false)->get();
        $total = Nomination::where('trash', false)->get();
        return view('invoice.index', [
            'form_type' =>'store',
            'count' => count($total),
            'all_invoice' => $invoice,
        ]);
    }
    public function form()
    {
        return view('invoice.form', [
            'form_type' =>'store',
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
        $this->validate($request, [
            'name' => 'required',
            'invoice' => 'required|unique:invoices',
            'total' => 'required',
        ]);

            Invoice::create([
                'name' => $request->name,
                'invoice' => $request->invoice,
                'total' => $request->total,
                'available' => $request->total,
            ]);
            // $user_data = [
            //     'invoice' => $request->invoice,
            // ];
            // Mail::to($request->email)->send(new NominationSubmitMail($data));
            // $user_data->notify(new PaymentNotification($user_data));
            // Mail::to($request->email)->send(new MakePaymentMail($user_data));
            return back()->with('success', 'Invoice Added Successfully');

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
        $invoice= Invoice::findOrFail($id);
        return view('invoice.form',[
            'form_type' =>'edit',
            'edit' => $invoice,
        ]);
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
        $update_date = Invoice::findOrFail($id);
        $used = count(Nomination::where('invoice', $request->invoice)->get());
        $available= $request->total-$used;
        if ($request->total>=$update_date->used) {
            $update_date->update([
                'name' => $request->name,
                    'invoice' => $request->invoice,
                    'total' => $request->total,
                    'used' => $used,
                    'available' => $available,
            ]);
            return redirect()->route('invoice.index')->with('success', 'Invoice Updated Successfully');
        } else {
            return redirect()->route('invoice.index')->with('danger', "'Invoice Number Must Be Greater Than $update_date->used'");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Invoice::where('id', $id)->first();

        if ($data->trash) {
            $data->update([
                'trash' => false,
            ]);
        } else {
            $data->update([
                'trash' => true,
            ]);
        }
        return back()->with('success', 'Invoice Deleted successfully');
    }
}
