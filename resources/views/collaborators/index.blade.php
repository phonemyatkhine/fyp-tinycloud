@extends('storages.show')

@section('storages-right-css')
    
@endsection

@section('storages-right')
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @elseif(session()->has('success'))
        <div class="alert alert-primary">
            {{ session()->get('success') }}
        </div>
    @elseif(session()->has('warning'))
        <div class="alert alert-warning">
            {{ session()->get('warning') }}
        </div>
    @endif
    @php
        $storage = session('storage');
        $chart_data = session('chart_data');
    @endphp
    @if (count($collaborators)==0)
        There are no collaborators for your folder. <br>
        <a href="{{route('folders.show.collaborators.create',$folder->id)}}">
            <button class="btn btn-primary">Add Collaborator</button>
        </a>
    @else
    
    <table class="table">
        <h5 style="color: #2172FF">Collaborators</h5>
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Verification</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($collaborators as $key => $collaborator)
            <tr>
                <td>{{$key+1}}</td>
                <td scope="row">
                    {{$collaborator->user->name}}
                </td>
                <td>{{$collaborator->user->email}}</td>
                <td> {{$collaborator->verified ? 'Collaboration Accepted' : 'Verification in Process' }}</td>
                <td>
                    <form action="{{route('collaborators.destroy',$collaborator->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Remove" id="" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            <div>
                
               
            </div>
        @endforeach
        </tbody>
      </table>
      <a href="{{route('folders.show.collaborators.create',$folder->id)}}">
        <button class="btn btn-primary">Add Collaborator</button>
    </a>
    @endif
@endsection