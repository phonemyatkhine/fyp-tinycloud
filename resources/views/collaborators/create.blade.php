@extends('storages.show')

@section('storages-right-css')
    
@endsection

@section('storages-right')
    <form action="{{route('collaborators.store')}}" class="form" method="POST">
        @csrf
        <input type="hidden" name="folder_id" id="" value="{{$folder->id}}">
        <div class="form-group row">
            <label for="user_email" class="col-sm-4 col-form-label">Email of Collaborator</label>
            <div class="col-sm-6">
              <input class="form-control" id="user_email" placeholder="example@email.com" name="user_email">
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Add Collaborator">
    </form>
@endsection