@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Students' Requests</h2>
        </div>
        <div class="pull-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-admin">Assign student</button>
        </div>
    </div>
</div>

@if(count($data) <= 0)
    @section('message')
        <div class="alert  alert-info alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-info">Info</span> There are no requests available in this category!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endsection
@else
    @section('message')
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-danger">Error</span> Correct the following errors and fill the form again.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" id="session-message" role="alert">
                <span class="badge badge-pill badge-success">Success!</span> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($message = Session::get('failure'))
            <div class="alert alert-danger alert-dismissible fade show" id="session-message" role="alert">
                <span class="badge badge-pill badge-danger">Success!</span> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endsection

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Student</th>
            <th>Project</th>
            <th>Description</th>
            <th>Status</th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($data as $studentrequest)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->find($studentrequest->student_id)->firstname }}</td>
            <td>{{ $project->find($studentrequest->project_id)->title }}</td>
            <td>{{ $project->find($studentrequest->project_id)->description }}</td>
            @if($studentrequest->status == 'pending')
                <td><label class="badge badge-danger">{{ $studentrequest->status }}</label></td>
            @else
                <td><label class="badge badge-warning">{{ $studentrequest->status }}</label></td>
            @endif
            <td>
                <form action="{{ route('grantrequest') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <input type="hidden" name="studentrequest" class="form-control" id="studentrequest" value="{{ $studentrequest->id }}">
                    <button type="submit" name="submit" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Grant</button>
                </form>&nbsp;
                <button id="deleteButton" type="button" style="margin-top: -65px; margin-left: 80px " class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-request" data-id ="{{ $studentrequest->id }}"><i class="fa fa-trash-o"></i> Reject</button>
            </td>
        </tr>
        @endforeach
    </table>
@endif

<!-- Delete project modal-->
        <div class="modal fade" id="delete-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete User</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="delete-request-form" action="" id="delete-request-form" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group"><input type="hidden" name="id" id="id"></div>
                            <div class="form-group">
                                <p>Are you sure you want to delete <strong><span id="title"></span> ?</strong></p>
                            </div>
                            <hr />
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /#delete-project -->

        {!! $data->render() !!}
@endsection
