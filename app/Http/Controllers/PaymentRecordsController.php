<?php

namespace App\Http\Controllers;

use App\Models\PaymentRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $payment_details = $user->payment_details;
        $payment_records = PaymentRecords::where('payment_details_id',$payment_details->id)->get();
        return view('payments.index',compact('payment_records'));
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
     * @param  \App\Models\PaymentRecords  $paymentRecords
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentRecords $paymentRecords)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentRecords  $paymentRecords
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentRecords $paymentRecords)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentRecords  $paymentRecords
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentRecords $paymentRecords)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentRecords  $paymentRecords
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentRecords $paymentRecords)
    {
        //
    }
}
