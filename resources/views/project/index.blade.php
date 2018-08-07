@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Projects Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('projects') }}"> Create New Project</a>
        </div>
        <div class="pull-right" style="margin-right:15px !important">
            <a class="btn btn-info" href="{{ route('projects') }}"> My projects</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p><label class="badge badge-success"></label> {{ $message }}</p>
    </div>
@endif

@if(count($data) <= 0)
    @section('message')
        <div class="alert  alert-info alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-info">Info</span> There are no projects available in this category!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endsection
@else
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Student</th>
            <th>Admin</th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($data as $key => $project)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $project->title }}</td>
            <td><label class="badge badge-success">{{ $project->type }}</label></td>
            @if($project->date_validated == '')
                <td><label class="badge badge-danger">pending</label></td>
            @else
                <td>Validated on: <label class="badge badge-warning">{{ $project->date_validated }}</label></td>
            @endif
            <td>{{ $user->find($project->owner_id)->firstname }}&nbsp;<label class="badge badge-success">S</label></td>
            <td>{{ $user->find($project->admin_id)->firstname }}&nbsp;<label class="badge badge-info">A</label></td>
            <td>
               <a class="btn btn-info" href="{{ route('projects',$project->id) }}">Show</a>
               <!--<a class="btn btn-primary" href="{{ route('users',$project->id) }}">Edit</a> -->
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-admin">Edit</button>
               <a class="btn btn-danger" href="{{ route('projects',$project->id) }}">Delete</a>
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
