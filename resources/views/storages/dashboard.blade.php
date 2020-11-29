@extends('storages.show')

@section('storages-right-css')
    <style>
        .dashboard-contents{
            padding: 20px;
        }
        .dashboard-contents-title {
            font-size: 15px;
            width: 30%;
        }
        .dashboard-contents-value {
            font-size: 15px;
            color: #2172FF;
        }
    </style>
@endsection

@section('storages-right')
<div class="dashboard-contents">
    <div class="row">
        <p class="dashboard-contents-title">Total Folders</p>
        <p class="dashboard-contents-value">{{count($storage->folders)}}</p>
    </div>
    <div class="row">
        <p class="dashboard-contents-title">Total Item</p>
        <p class="dashboard-contents-value">{{count($storage->getStoredData())}}</p>
    </div> 
    <div class="row">
        <p class="dashboard-contents-title">Shared Folders</p>
        <p class="dashboard-contents-value">{{count(Auth::user()->collaborators)}}</p>

    </div> 
    <div class="row">
        <p class="dashboard-contents-title">Teams</p>
        <p class="dashboard-contents-value"> A</p>
    </div>
</div>
@endsection