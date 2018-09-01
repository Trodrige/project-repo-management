@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
            <div class="row">
                <div class="col-md-10">
                    <a name="allProjects"><h2>All projects</h2></a>
                </div>
                <div class="col-md-2">
                    <a href="#upload"><button type="button" class="btn btn-info">Upload project</button><a>
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
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="card">
    @csrf
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><a name="upload"><strong>Upload your Project</strong><a><small> Form</small></div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label for="Upload your Project" class=" form-control-label">Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter the title of your project" class="form-control">
                </div>
                <div class="form-group">
                    <label for="vat" class=" form-control-label">Description</label>
                    <input type="text" id="description" name="description" placeholder="Provide a brief description of your project" class="form-control">
                </div>
                <div class="form-group">
                    <label for="street" class=" form-control-label">Type</label>
                    <!--<input type="text" id="type" name="type" placeholder="Provide the type of your project, example Final year project or Internship project" class="form-control">-->
                    <select name="type" id="type">
                        <option value="finalyear">Final Year</option>
                        <option value="internship">Internship</option>
                        <option value="courseproject">Course</option>
                    </select>
                </div>
                <div class="row form-group">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="postal-code" class=" form-control-label">Project report<small> pdf ONLY</small></label>
                            <input type="file" id="filename_pdf" name="filename_pdf" class="form-control">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="postal-code" class=" form-control-label">Project Implementation<small> zip ONLY</small></label>
                            <input type="file" id="zip_filename" name="zip_filename" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
                </div>
                <!--
                <div class="form-group">
                    <input type="hidden" name="admin_id " id="admin_id " value="{{ Auth::id() }}">
                </div>
                -->
                <!--
                <div class="form-group">
                    <input type="hidden" name="date_validated" id="date_validated">
                </div>
                -->
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@endsection
