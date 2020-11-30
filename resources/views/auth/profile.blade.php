@extends('layouts.app')

@section('css')
    <style>
        .profile-main-div {
            margin: 20px 50px 10px 50px;
            border: 1px solid #E0E0E0;
            width: 100%;
            height: 90%;
            border-radius: 8px;
        }
        .profile-div {
            width: 40%;
            height: 90%;
            border-right: 0.5px solid #E0E0E0;
            margin: 20px;
            margin-top:0px;
        }
        .profile-head{
            color: #2577FF;
            padding-left: 20px;
        }
        .profile-div>div{
            float: left;
            padding: 20px;
            width: 100%;
        }
        .payment-div{
            margin: 20px;
            margin-top: 5px;
        }
        .payment-div>div{
            float: left;
            padding: 20px;
            width: 100%;
        }
        .payment-div>h3{
            color: #2577FF;
        }
        .profile-contents {
            padding: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="profile-main-div row">
        <div class="profile-div">  
            @if (request()->is('profile') || request()->is('payment/edit'))
            <div>
                <span class="row">
                    <h3 class="profile-head">Profile</h3>
                    <a href="{{route('profile.edit')}}" style="padding-left: 380px;">
                        <i class="material-icons">
                            edit
                        </i>
                    </a>
                </span>
                <div class="profile-contents">
                    <div class="row">
                        <p style="width:30%">Name : </p>
                        <p style="width:70%"> {{$user->name}} </p>
                    </div>
                    <div class="row">
                        <p style="width:30%">Email : </p>
                        <p style="width:70%">{{$user->email}} </p>
                    </div>
                    <div class="row">
                        <p style="width:30%">Phone Number :</p>
                        <p style="width:70%">{{$user->phone_no}}</p>
                    </div> 
                </div>
            </div> 
            @elseif(request()->is('profile/edit'))
            <div>
                <form action="{{route('profile.update')}}" method="POST">
                    @csrf
                    <span class="row">
                        <h3 class="profile-head">Edit Profile</h3>
                        <button style="all: unset;padding-left:320px; color:#2577FF;" type="submit">
                            <i class="material-icons">
                                check_circle
                            </i>
                        </button>
                    </span>  
                    <div class="profile-contents">
                        <div class="row">
                            <p style="width:30%">Name : </p>
                            <p style="width:70%"> <input type="text" value="{{$user->name}}" name="name" style="width: 90%"></p>
                        </div>
                        <div class="row">
                            <p style="width:30%">Email : </p>
                            <p style="width:70%"> <input type="text" name="email" id="" value="{{$user->email}}" style="width: 90%"> </p>
                        </div>
                        <div class="row">
                            <p style="width:30%"> Phone Number :</p>
                            <p style="width:70%">  <input type="text" name="phone_no" id="" value="{{$user->phone_no}}" style="width: 90%"></p>
                        </div> 
                    </div>
                </form>
            </div> 
            @endif
        </div>
        <div class="payment-div">
            @if (request()->is('profile'))
            <div>
                <span class="row">
                    <h3 class="profile-head">Payment Details</h3>
                    <a href="{{route('payment.edit')}}" style="padding-left: 420px;">
                        <i class="material-icons">
                            edit
                        </i>
                    </a>
                </span>
                <div class="profile-contents">
                    <div class="row">
                        <p style="width:30%">Card Type : </p>
                        <p style="width:70%"> {{$paymentDetails->card_type}} </p>
                    </div>
                    <div class="row">
                        <p style="width:30%">Card Number : </p>
                        <p style="width:70%">{{$paymentDetails->card_no}} </p>
                    </div>
                    <div class="row">
                        <p style="width:30%">Postal Code :</p>
                        <p style="width:70%">{{$paymentDetails->postal_code}}</p>
                    </div> 
                    <div class="row">
                        <p style="width:30%">Country :</p>
                        <p style="width:70%">{{$paymentDetails->country}}</p>
                    </div> 
                </div>
            </div> 
            @elseif(request()->is('payment/edit'))
            <div>
                <form action="{{route('payment.update')}}" method="POST">
                    @csrf
                    <span class="row">
                        <h3 class="profile-head">Edit Payment Details</h3>
                        <button style="all: unset;padding-left:360px; color:#2577FF;" type="submit">
                            <i class="material-icons">
                                check_circle
                            </i>
                        </button>
                    </span>  
                    <div class="profile-contents">
                        <div class="row">
                            <p style="width:30%">Card Type : </p>
                            <p style="width:70%"> <input type="text" value="{{$paymentDetails->card_type}} " name="card_type" style="width: 90%"></p>
                        </div>
                        <div class="row">
                            <p style="width:30%">Card Number : </p>
                            <p style="width:70%"> <input type="number" name="card_no" id="" value="{{$paymentDetails->card_no}}" style="width: 90%"> </p>
                        </div>
                        <div class="row">
                            <p style="width:30%">Postal Code :</p>
                            <p style="width:70%"> <input type="number" name="postal_code" id="" value="{{$paymentDetails->postal_code}}"  style="width: 90%"></p>
                        </div> 
                        <div class="row">
                            <p style="width:30%"> Country :</p>
                            <p style="width:70%">  <input type="text" name="country" id="" value="{{$paymentDetails->country}}" style="width: 90%"></p>
                        </div> 
                    </div>
                </form>
            </div> 
            @endif
        </div> 
    </div>
@endsection