@extends('storages.show')
@section('storages-right')
<div class="container"> 
    <h4>Create Folder</h4>
    <form action="{{route('folders.update',$folder->id)}}" method="POST" class="form-group">
        @csrf
        @method("PATCH")
        <div class="form-group row">
            <label for="name" class="col-sm-4">Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" name="name" value="{{$folder->name}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Privacy</label>
            <div class="col-sm-8">
                <select name="privacy" id="" class="form-control">
                    <option value="Private" {{$folder->privacy == "Private" ? 'selected' : ''}}>Private</option>
                    <option value="Public" {{$folder->privacy == "Public" ? 'selected' : ''}}>Public</option>
                </select> 
            </div>
        </div>
        <br>
        <input type="submit" name="submit" value="Update Folder" id="" class="btn btn-primary">
    </form>
</div>

@endsection