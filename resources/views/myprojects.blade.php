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
                    <h2>My projects</h2>
                    <!-- <p>List of all projects in the system</p> -->
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
                    @foreach($myprojects as $myproject)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $myproject->title }}</td>
                            <td>{{ $myproject->description }}</td>
                            <td>{{ $myproject->type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $myprojects->links() }}
        </div>
    </div>
</div>
@endsection
