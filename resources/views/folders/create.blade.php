@extends('storages.show')
@section('storages-right')
<div class="container"> 
    <h4>Create Folder</h4>
    <form action="{{route('folders.store')}}" method="POST" class="form-group">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-4">Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" placeholder="Folder Name" name="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Privacy</label>
            <div class="col-sm-8">
                <select name="privacy" id="" class="form-control">
                    <option value="Private">Private</option>
                    <option value="Public">Public</option>
                </select> 
            </div>
        </div>
        <br>
        <input type="submit" name="submit" value="Create Folder" id="" class="btn btn-primary">
    </form>
</div>

@endsection