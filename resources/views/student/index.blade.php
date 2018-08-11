@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Students Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users') }}"> Create New Student</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if(count($data) <= 0)
    @section('message')
        <div class="alert  alert-info alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-info">Info</span> There are no students available in this category!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endsection
@else
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Status</th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($data as $key => $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td><label class="badge badge-success">{{ $user->role }}</label></td>
            @if($user->is_admin == 'invalid')
                <td><label class="badge badge-danger">{{ $user->is_admin }}</label></td>
            @else
                <td><label class="badge badge-warning">{{ $user->is_admin }}</label></td>
            @endif
            <td>
               <a class="btn btn-info" href="{{ route('users',$user->id) }}">Show</a>
               <!--<a class="btn btn-primary" href="{{ route('users',$user->id) }}">Edit</a> -->
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-admin">Edit</button>
               <a class="btn btn-danger" href="{{ route('users',$user->id) }}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
@endif

<div class="modal fade" id="edit-admin" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Medium Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    There are three species of zebras: the plains zebra, the mountain zebra and the Grévy's zebra. The plains zebra
                    and the mountain zebra belong to the subgenus Hippotigris, but Grévy's zebra is the sole species of subgenus
                    Dolichohippus. The latter resembles an ass, to which it is closely related, while the former two are more
                    horse-like. All three belong to the genus Equus, along with other living equids.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>

{!! $data->render() !!}
@endsection
