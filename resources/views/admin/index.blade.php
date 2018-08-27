@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Admins Management</h2>
        </div>
        <div class="pull-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-admin">Create New Admin</button>
        </div>
    </div>
</div>

@if(count($data) <= 0)
    @section('message')
        <div class="alert  alert-info alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-info">Info</span> There are no admins available in this category!!!
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
               <a class="btn btn-info" href="{{ route('users',$user->id) }}"><i class="fa fa-eye"></i>Show</a>
               <!--<a class="btn btn-primary" href="{{ route('users',$user->id) }}">Edit</a> -->
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-admin" data-id="{{ $user->id }}" data-firstname="{{ $user->firstname }}" data-lastname="{{ $user->lastname }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}" data-is_admin="{{ $user->is_admin }}"><i class="fa fa-pencil"></i> Edit</button>
                <button id="deleteButton" type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-admin" data-id ="{{ $user->id }}" data-firstname="{{ $user->firstname }}"><i class="fa fa-trash-o"></i> Delete</button>
            </td>
        </tr>
        @endforeach
    </table>
@endif

<!-- Add admin modal -->
<div class="modal fade" id="add-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>New Admin</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="add-admin-form" action="{{ route('createadmin') }}" id="add-admin-form" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group row">
                                <label for="firstname" class="col-sm-2 col-form-label">{{ __('Firstname') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter firstname">
                                    @if ($errors->has('firstname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-sm-2 col-form-label">{{ __('Lastname') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter lastname">
                                    @if ($errors->has('lastname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                                <div class="col-sm-10">
                                    <select id="role" class="form-control" name="role" disabled>
                                    <option value="admin">{{ __('Admin') }}</option>
                                        <option value="student">{{ __('Student') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                                <div class="col-sm-10">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>
                                <div class="col-sm-10">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="is_admin" class="col-sm-2 col-form-label">{{ __('Status') }}</label>
                                <div class="col-sm-10">
                                    <select id="is_admin" class="form-control" name="is_admin" disabled>
                                        <option value="valid">{{ __('Valid') }}</option>
                                        <option value="invalid">{{ __('Invalid') }}</option>
                                        <option value="is_student">{{ __('Student') }}</option>s
                                    </select>
                                </div>
                            </div>
                            <hr />
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-info">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- /#add-admin -->


<!-- Edit admin modal -->
<div class="modal fade" id="edit-admin" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Edit this user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="edit-admin-form" action="" id="edit-admin-form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group"><input type="hidden" name="id" id="id"></div>
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-2 col-form-label">{{ __('Firstname') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="firstname" class="form-control" id="firstname">
                            @if ($errors->has('firstname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-2 col-form-label">{{ __('Lastname') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="lastname" class="form-control" id="lastname">
                            @if ($errors->has('lastname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                        <div class="col-sm-10">
                            <select id="role" class="form-control" name="role">
                                <option value="admin">{{ __('Admin') }}</option>
                                <option value="student">{{ __('Student') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_admin" class="col-sm-2 col-form-label">{{ __('Status') }}</label>
                        <div class="col-sm-10">
                            <select id="is_admin" class="form-control" name="is_admin">
                                <option value="valid">{{ __('Valid') }}</option>
                                <option value="invalid">{{ __('Invalid') }}</option>
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
<!-- edit-admin -->

<!-- Delete admin modal-->
        <div class="modal fade" id="delete-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete User</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="delete-admin-form" action="" id="delete-admin-form" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group"><input type="hidden" name="id" id="id"></div>
                            <div class="form-group">
                                <p>Are you sure you want to delete <strong><span id="firstname"></span> ?</strong></p>
                            </div>
                            <hr />
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /#delete-admin -->

{!! $data->render() !!}
@endsection
