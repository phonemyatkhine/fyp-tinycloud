@extends('storages.show')
@section('storages-right-css')
    <style>
       .folder-card{
        float: left;
        border: 0.5px solid #E0E0E0;
        border-radius: 10px;
        padding: 10px;
        margin: 0px 20px 10px -10px;
        width: 200px;
       }
       .folder-card-header {
        background: #F5F5F5;
        width: 200px;
        margin: -10px -11px -11px -11px;
        padding: 10px;
        border: 0.5px solid #E0E0E0;
        border-top: 0px;
        color: #707070;
        border-top-right-radius: 10px; 
        border-top-left-radius: 10px;
       }
       h5>.material-icons {
        color: #2172FF;
       }
       .folder-card-content {
        margin: 20px 20px 0px 20px;
        color: #707070;
       }
       .top-button {
        border: 0.5px solid #F5F5F5;
        border-radius: 50%;
        height:40px;
        width:40px;
        margin:10px 0px 10px 10px; 
        padding: 5px 5px 5px 8px;
        float: right;
       }
       .button-div {
           /* background-color: black; */
           height: 10%;
           display: block;
           margin-right:25px;
       }
       .card-parent{
           padding-left: 10px;
           overflow-y:scroll;
           height: 80%;
           width: 100%;
           /* background-color: #2172FF; */
           /* display: block; */

       }
    </style>
@endsection
@section('storages-right')
    <div class="button-div">
        <a href="{{route('folders.create')}}" >
            <button class="top-button material-icons">
                create_new_folder
            </button>
        </a>
        <a href="">
            <button  class="top-button">
                <i class="material-icons">info</i>
            </button>
        </a>
        @if(!empty($pending_collabs))
        <button  class="top-button btn-danger"  data-toggle="modal" data-target="#infoModal">
            <i class="material-icons">notification_important</i>
        </button>
        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pending Folder Invites</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Folder Name</th>
                            <th scope="col">Folder Owner</th>
                            <th colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($pending_collabs as $key => $collab)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td scope="row">
                                    {{$collab->folder->name}}
                                </td>
                                <td>{{$collab->folder->user->email}}</td>
                                <td>
                                    <form action="{{route('collaborators.accept',$collab->id)}}" method="POST">
                                        @csrf
                                        <input type="submit" value="Accept" id="" class="btn btn-primary">
                                    </form>
                                </td>
                            </tr>
                            <div> 
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>  
                </div>
              </div>
            </div>
        </div>
        @endif
    </div>
    <div class="card-parent">
        @if (isset($folders))
            @foreach ($folders as $folder)
            <a href="{{route('folders.show',$folder->id)}}">
                <div class="folder-card card">
                    <h5 class="folder-card-header">
                        <i class="material-icons">folder</i>  {{$folder->name}}
                    </h5>
                    <div class="folder-card-content">
                        Items : {{count($folder->stored_data)}} <br>
                        Privacy : {{$folder->privacy}}
                    </div>   
                </div>
            </a>
            @endforeach
        @elseif(isset($shared_folders))
            @foreach ($shared_folders as $folder)
            <a href="{{route('folders.show',$folder->id)}}">
                <div class="folder-card card">
                    <h5 class="folder-card-header">
                        <i class="material-icons">folder</i>  {{$folder->name}}
                    </h5>
                    <div class="folder-card-content">
                        Items : {{count($folder->stored_data)}} <br>
                        Privacy : {{$folder->privacy}}
                    </div>   
                </div>
            </a>
            @endforeach
        @endif
        
    </div>
{{--    
    <button><a href="{{route('folders.create',$storage->id)}}">Create Folder</a></button>
    <button><a href="{{route('recover.index',$storage->id)}}">Recover Files</a></button> --}}
@endsection