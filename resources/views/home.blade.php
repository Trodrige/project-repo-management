@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <!-- <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </div>
        </div> -->

        @section('message')
            @if (session('failure'))
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-danger">Failure</span> {{ session('failure') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        @endsection

        <div class="row">
            <div class="col-sm-12 mb-4">
                <div class="card-group">
                    <div class="card col-lg-2 col-md-6 no-padding bg-flat-color-1">
                        <a href="{{ route('users') }}">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-users text-light"></i>
                                </div>

                                <div class="h4 mb-0 text-light">
                                    <span class="count">{{ $num_of_users }}</span>
                                </div>
                                <small class="text-uppercase font-weight-bold text-light">Users</small>
                                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                        <a href="{{ route('students') }}">
                            <div class="card-body bg-flat-color-2">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-male text-light"></i>
                                </div>
                                <div class="h4 mb-0 text-light">
                                    <span class="count">{{ $num_of_students }}</span>
                                </div>
                                <small class="text-uppercase font-weight-bold text-light">Students</small>
                                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                        <a href="{{ route('admins') }}">
                            <div class="card-body bg-flat-color-3">
                                <div class="h1 text-right mb-4">
                                    <i class="fa fa-adn text-light"></i>
                                </div>
                                <div class="h4 mb-0 text-light">
                                    <span class="count">{{ $num_of_admins }}</span>
                                </div>
                                <small class="text-light text-uppercase font-weight-bold">Admins</small>
                                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                        <a href="{{ route('projects') }}">
                            <div class="card-body bg-flat-color-5">
                                <div class="h1 text-right text-light mb-4">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="h4 mb-0 text-light">
                                    <span class="count">{{ $num_of_projects }}</span>
                                </div>
                                <small class="text-uppercase font-weight-bold text-light">Projects</small>
                                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                        <a href="#">
                            <div class="card-body bg-flat-color-4">
                                <div class="h1 text-light text-right mb-4">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="h4 mb-0 text-light">{{ $permissions }}</div>
                                <small class="text-light text-uppercase font-weight-bold">Permissions</small>
                                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                        <a href="#">
                            <div class="card-body bg-flat-color-1">
                                <div class="h1 text-light text-right mb-4">
                                    <i class="fa fa-comments-o"></i>
                                </div>
                                <div class="h4 mb-0 text-light">
                                    <span class="count">{{ $comments }}</span>
                                </div>
                                <small class="text-light text-uppercase font-weight-bold">COMMENTS</small>
                                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div> <!-- /. row -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card-group">
                    <div class="col-md-6 col-lg-3 mt-1">
                        <div class="card bg-flat-color-1 text-light">
                            <a href="{{ route('students') }}" style="color:black">
                                <div class="card-body">
                                    <div class="h4 m-0">{{ $num_of_students }}</div>
                                    <div>Registered students</div>
                                    <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    <small class="text-light">Get info about all students registered.</small>
                                </div>
                            </a>
                        </div>
                    </div><!--/.col-->

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="#">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-face-smile text-primary border-primary"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>Add new student</strong></div>
                                            <div class="stat-digit">{{ $num_of_students }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="#">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-check text-danger border-danger"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>Give student permission to download project</strong></div>
                                            <div class="stat-digit"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('projects') }}">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-time text-success border-success"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>Recent Projects</strong></div>
                                            <div class="stat-digit">{{ $num_of_pending_projects }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-group">
                    <div class="col-md-6 col-lg-3 mt-1">
                        <div class="card bg-flat-color-3 text-light">
                            <a href="{{ route('admins') }}" style="color:black">
                                <div class="card-body">
                                    <div class="h4 m-0">{{ $num_of_admins }}</div>
                                    <div>Registered admins</div>
                                    <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    <small class="text-light">Get info about all admins registered.</small>
                                </div>
                            </a>
                        </div>
                    </div><!--/.col-->

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="#">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="fa fa-user-plus text-primary border-primary"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>Add new admin</strong></div>
                                            <div class="stat-digit">{{ $num_of_admins }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('validadmins') }}">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-user text-warning border-warning"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>Valid Admins</strong></div>
                                            <div class="stat-digit">{{ $num_of_valid_admins }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('pendingadmins') }}">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-close text-danger border-danger"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>Invalid Admins</strong></div>
                                            <div class="stat-digit">{{ $num_of_invalid_admins }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-group">
                    <div class="col-md-6 col-lg-3 mt-1">
                        <div class="card bg-flat-color-5 text-light">
                            <a href="{{ route('projects') }}" style="color:black">
                                <div class="card-body">
                                    <div class="h4 m-0">{{ $num_of_projects }}</div>
                                    <div>All projects</div>
                                    <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    <small class="text-light">Get info about all projects registered.</small>
                                </div>
                            </a>
                        </div>
                    </div><!--/.col-->

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="#">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-plus text-primary border-primary"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>Add new project</strong></div>
                                            <div class="stat-digit">{{ $num_of_projects }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('validatedprojects') }}">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-thumb-up text-danger border-danger"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>All validated projects</strong></div>
                                            <div class="stat-digit">{{ $num_of_validated_projects }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('wipprojects') }}">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-book text-success border-success"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text"><strong>Active Projects</strong></div>
                                            <div class="stat-digit">{{ $num_of_pending_projects }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <h2>All projects</h2>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-info">Upload project</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $project)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
@endsection
