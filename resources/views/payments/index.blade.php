@extends('layouts.app')

@section('css')
<style>
    .payments-div{
        width: 100%;
        height: 100%;
        /* background-color: aquamarine; */
        padding: 30px 80px 30px 100px;
    }
</style>

@endsection

@section('content')
    <div class="payments-div">
        <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Package Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Paid Date</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($payment_records as $key => $record)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$record->package->name}}</td>
                <td>{{$record->amount}} $</td>
                <td>{{$record->paid_date}}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
    </div>
@endsection