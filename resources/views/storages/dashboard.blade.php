@extends('storages.show')

@section('storages-right-css')
    <style>
        .dashboard-contents{
            padding: 20px;
        }
        .dashboard-contents-title {
            font-size: 15px;
            width: 35%;
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
        <p class="dashboard-contents-title">Total Items</p>
        <p class="dashboard-contents-value">{{count($storage->getStoredData())}}</p>
    </div> 
    <div class="row">
        <p class="dashboard-contents-title">Accepted Shared Folders</p>
        <p class="dashboard-contents-value">{{count(Auth::user()->getSharedFolders())}}</p>
    </div> 
    <div class="row">
        <p class="dashboard-contents-title">Pending Shared Folders</p>
        <p class="dashboard-contents-value">{{count(Auth::user()->pendingSharedFolders())}}</p>
    </div>
</div>
@endsection