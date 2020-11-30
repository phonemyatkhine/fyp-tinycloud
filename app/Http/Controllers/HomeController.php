<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentDetails;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile() {
        $user = Auth::user();
        $paymentDetails = PaymentDetails::where("user_id",$user->id)->first();
        return view('auth.profile',compact("user","paymentDetails"));
    }

    public function updateProfile(Request $request) {

        $attributes = $request->validate([
            'name' =>  ['required'],
            'email'   =>  ['required','email'],
        ]);
        $user = Auth::user();
        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        $user->phone_no = $request->phone_no;
        $user->save();
        return \redirect()->route('profile');

    }

    public function updatePayment(Request $request) {

        $attributes = $request->validate([
            'card_type' =>  ['required'],
            'card_no'   =>  ['required'],
            'postal_code'   =>  ['required'],
            'country' => ['required'],
        ]);
        $paymentDetails = PaymentDetails::where("user_id",Auth::id())->first();
        $paymentDetails->card_type = $attributes['card_type'];
        $paymentDetails->card_no = $attributes['card_no'];
        $paymentDetails->postal_code = $attributes['postal_code'];
        $paymentDetails->country = $attributes['country'];

        $paymentDetails->save();
        return \redirect()->route('profile');

    }
}
