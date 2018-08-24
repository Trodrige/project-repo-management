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
                    <a href="/home#upload"><button type="button" class="btn btn-info">Upload project</button></a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Report.pdf</th>
                        <th>Implementation.zip</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myprojects as $myproject)
                        <?php
                            $filename_pdf = $myproject->filename_pdf;
                            $filename_pdf = str_replace("public/","storage/",$filename_pdf);
                            //echo $filename_pdf;
                            $zip_filename = $myproject->zip_filename;
                            $zip_filename = str_replace("public/","storage/", $zip_filename);
                            //echo $zip_filename;
                        ?>
                        <tr>
                            <td>{{ $myproject->id }}</td>
                            <td>{{ $myproject->title }}</td>
                            <td>{{ $myproject->type }}</td>
                            <td><a href="{{ route('getpdf', $filename_pdf) }}"><button type="button" class="btn btn-success">Open Pdf</button></a></td>
                            <td><a href="{{ route('getfile', $zip_filename) }}"><button type="button" class="btn btn-primary">Download zip</button></a></td>
                            <td>
                                <form action="{{ route('destroy', ['id' => $myproject ->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </div>
                                </form>
                            </td>
                    @endforeach
                            
                        </tr>
                </tbody>
            </table>
            {{ $myprojects->links() }}
        </div>
    </div>
</div>
@endsection
