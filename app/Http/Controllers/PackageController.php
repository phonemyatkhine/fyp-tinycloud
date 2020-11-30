<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\StoragePackage;
use App\Models\PaymentDetails;
use App\Models\PaymentRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('packages.index',compact("packages"));
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
     * @param  \App\Models\UserStorageInfo  $userStorageInfo
     * @return \Illuminate\Http\Response
     */
    public function show(UserStorageInfo $userStorageInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserStorageInfo  $userStorageInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(UserStorageInfo $userStorageInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserStorageInfo  $userStorageInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserStorageInfo $userStorageInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserStorageInfo  $userStorageInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserStorageInfo $userStorageInfo)
    {
        //
    }

    public function buyPackage(Package $package) {
        if(!Auth::user()) {
            return redirect()->route('packages.index')->with('warning','Please sign into your account to buy packages');
        } else {
            $storage = Auth::user()->storages;
            $storage =$storage[0];
            $current_storage_package = StoragePackage::where('storage_id',$storage->id)->first();
            if($current_storage_package && $current_storage_package->updated_date >= date("Y-m-d")) {
                return redirect()->route('packages.index')->with('warning','You can only buy one package each month');
            }
            $storage_package = New StoragePackage;
            $storage_package->storage_id = $storage->id;
            $storage_package->package_id = $package->id;
            $storage_package->updated_date = date("Y-m-d");
            
            $payment_details = Auth::user()->payment_details;
            if(!$payment_details->card_no) {
                return redirect()->route('packages.index')->with('warning','Please update your payment details under profile to buy packages');
            }
            $payment_records =  New PaymentRecords;
            $payment_records->payment_details_id = $payment_details->id;
            $payment_records->package_id = $package->id;
            $payment_records->amount = $package->price;
            $payment_records->paid_date =  date("Y-m-d");

            $storage->total_space = $storage->total_space + $package->additional_space;
            $storage_package->save();
            $payment_records->save();
            $storage->save();
            return redirect()->route('storages.index');
        }
    }
}
