@extends('storages.show')
@section('storages-right-css')
    <style>
        .top-button {
            border: 0.5px solid #F5F5F5;
            border-radius: 50%;
            height:40px;
            width:40px;
            margin:10px 0px 10px 10px; 
            padding: 7px 5px 5px 7px;
            float: right;
        }
        .top-button-div {
            width: 100%;
            height: 10%;
            /* background-color: red; */
            display: block;
        } 
        .folder-contents {
            padding-top : 20px;
            /* background-color: black; */
        }
        .folder{
            padding-top: 20px;
            /* display: block; */
            overflow-y: scroll;
            height: inherit;
            width: 100%;
        }
        .modal-button {
            border: 0.5px solid #F5F5F5;
            border-radius: 50%;
            height:40px;
            width:40px;
            margin:10px 20px 10px 10px; 
            float: left;
            background-color: #F6F6F6;
        }
        .items{
            padding: 20px;
        }
    </style>
    <script>
        function copy() {

        var shareable_link = document.getElementById("shareable_link");
        var privacy = document.getElementById("folder-privacy").value;

            if(privacy == "Private") {
                alert("Change your folder to public to share!");
            } else {
                shareable_link.setAttribute('type','text');
            shareable_link.select();
            // shareable_link.setSelectionRange(0, 99999); /*For mobile devices*/
            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            shareable_link.setAttribute('type','hidden');
            alert("Copied sharable link!");
            }
            
        }
    </script>
@endsection
@section('storages-right')
<div>
    @if (Auth::user()->can('view',$folder))   
        <div class="top-button-div">
            <button  class="top-button material-icons"  data-toggle="modal" data-target="#infoModal">
                info
            </button>
            <button type="button" class="top-button material-icons" data-toggle="modal" data-target="#deleteModal">
                delete_forever
            </button>
            <a href="{{route('folders.edit',$folder->id)}}" >
                <button class="top-button material-icons">
                    edit
                </button>
            </a> 
            <a  href="{{route('folders.show.collaborators.create',$folder->id)}}">
                <button  class="top-button material-icons">
                    person_add
                </button>
            </a>
            <a href="{{route('folders.show.collaborators.index',$folder->id)}}">
                <button  class="top-button material-icons">
                    group
                </button>
            </a>
            @php
                $path = explode('/', $folder->path);
            @endphp
            <button  class="top-button material-icons" onclick="copy()">
                <input type="hidden" value="{{route('folders.share',[$path[0],$path[1]])}}" id="shareable_link" >
                share
            </button>
            </a>
        </div>
    @endif
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Folder?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure do you want to delete this folder? The folder and all its contents will be deleted forever.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <form action="{{route('folders.destroy',$folder->id)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    {{-- <input type="hidden" name="folder_id" value="{{$folder->id}}" id=""> --}}
                    <input type="submit" value="Confirm" class="btn btn-danger" id="">
                </form>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Info</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div>
                    <button class="material-icons modal-button" disabled>
                        group
                    </button>
                    <p style="width:80%;">This button enables you to check collaborators from your folder.</p>
                </div>
                <div>
                    <button class="material-icons modal-button" disabled>
                        person_add
                    </button>
                    <p style="width:80%;">This button enables you to add collaborators to your folder.</p>
                </div>
                <div>
                    <button class="material-icons modal-button" disabled>
                        edit
                    </button>
                    <p style="width:80%;">This button enables you edit your folder.</p>
                </div>
                <div>
                    <button class="material-icons modal-button" disabled>
                        delete
                    </button>
                    <p style="width:80%;">This button will permanently delete your folder.</p>
                </div>
                <div>
                    <button class="material-icons modal-button" disabled>
                        share
                    </button>
                    <p style="width:80%;">This button enables you to get public shareable link to your folder.</p>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>  
            </div>
          </div>
        </div>
    </div>
    @php
        static $size;
        foreach($folder->stored_data as $data){
            $size = $data->size + $size;
        }
        $size = round($size/1048576,2);
    @endphp

    <div class="folder">
        <h5 style="color: #2172FF;">Folder Name : {{$folder->name}} </h5>
        <div class="folder-contents">
            <p>Items : {{count($folder->stored_data)}}</p>
            <input type="hidden" name="" id="folder-privacy" value="{{$folder->privacy}}">
            <p>Privacy : {{$folder->privacy}}</p>
            <p>Folder size : {{$size}} MB</p>
            <p>Owner : {{$folder->user->name}}</p>
            <p>Owner Email : {{$folder->user->email}}</p>
            Items :
            <div class="items">
                @foreach ($folder->stored_data as $key => $data)
                <div class="row item">
                    <p style="width: 70%">
                        <a href="{{route('download',$data->id)}}">{{$data->name}}</a>
                    </p>
                    <p style="width : 20%;background-color:white;">
                        {{round($data->size/1048576,2)}} MB
                    </p>
                    <div  style="width : 10%;background-color:white;">
                        <form action="{{route('data.destroy',$data->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                                <input type="submit" name="delete" value="Delete" id="">
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div> 
        <p>Upload Data:</p>
        <form action="{{route('data.store')}}" method="post" enctype="multipart/form-data" style="padding-bottom: 50px;">
            @csrf
            <div class="form-group row">
                <input type="file" name="uploaded_file" class="col-sm-6 form-control-file" required>
                <input type="hidden" name="folder_id" value="{{$folder->id}}">
            </div>
            <input type="submit" name="" value="Upload" class="btn btn-primary">
        </form>
    </div>
</div>

@endsection