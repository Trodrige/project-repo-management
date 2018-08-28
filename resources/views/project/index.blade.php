@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Projects Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="/home#upload"> Create New Project</a>
        </div>
        <div class="pull-right" style="margin-right:15px !important">
            <a class="btn btn-info" href="{{ route('projects') }}"> My projects</a>
        </div>
    </div>
</div>

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
    @section('message')
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
            @if($project->date_validated == '0000-00-00')
                <td><label class="badge badge-danger">pending</label></td>
            @else
                <td>Validated on: <label class="badge badge-warning">{{ $project->date_validated }}</label></td>
            @endif
                <td>{{ $user->find($project->owner_id)->firstname }}&nbsp;<label class="badge badge-success">S</label></td>

                <td>{{ $user->find($project->admin_id)->firstname }}&nbsp;<label class="badge badge-info">A</label></td>

            <td>
               <a class="btn btn-info" href="{{ route('projects',$project->id) }}"><i class="fa fa-eye"></i> See</a>
               <!--<a class="btn btn-primary" href="{{ route('users',$project->id) }}">Edit</a> -->
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-project" data-id="{{ $project->id }}" data-title="{{ $project->title }}" data-description="{{ $project->description }}" data-type="{{ $project->type }}" data-date_validated="{{ $project->date_validated }}"><i class="fa fa-pencil"></i> Edit</button>
                <button id="deleteButton" type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-project" data-id ="{{ $project->id }}" data-title="{{ $project->title }}"><i class="fa fa-trash-o"></i> Delete</button>
                @if(Auth::user()->role == 'student')
                <form action="{{ route('addrequest') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <input type="hidden" name="project" class="form-control" id="project" value="{{ $project->id }}">
                    <button type="submit" name="submit" class="btn btn-success btn-xs">Request</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endif

<!-- Edit project modal -->
<div class="modal fade" id="edit-project" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Edit this project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="edit-project-form" action="" id="edit-project-form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group"><input type="hidden" name="id" id="id"></div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vat" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  for="type" class="col-sm-2 col-form-label">{{ __('Type') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="type" name="type">
                              <option value="final_year_project">Final year</option>
                              <option value="internship">Internship</option>
                              <option value="course">Course</option>
                              <option value="research">Research</option>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-info">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit-project -->


                <!-- Delete project modal-->
                        <div class="modal fade" id="delete-project" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete User</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="delete-project-form" action="" id="delete-project-form" method="post">
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
