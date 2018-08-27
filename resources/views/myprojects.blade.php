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
                        <!--<th>Description</th>-->
                        <th>Type</th>
                        <th>Report.pdf</th>
                         <th>Code.zip</th>
                         <th>Action</th>
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
                            <td>{{ ++$i }}</td>
                            <td>{{ $myproject->title }}</td>
                            <!--<td>{{ $myproject->description }}</td>-->
                            <td>{{ $myproject->type }}</td>
                            <td><a href="{{ route('getpdf', $filename_pdf) }}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Open Pdf</button></a></td>
                             <td><a href="{{ route('getfile', $zip_filename) }}"><button type="button" class="btn btn-warning"><i class="fa fa-download"></i> Download zip</button></a></td>
                             <td><button type="button" class="btn btn-primary" data-id="{{ $myproject->id }}"><i class="fa fa-check"></i> Validate</button></td>
                             <td>
                                 <form action="{{ route('destroy', ['id' => $myproject ->id]) }}" method="post">
                                     {{ csrf_field() }}
                                     {{ method_field('DELETE') }}
                                     <div class="form-group">
                                         <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
                                     </div>
                                 </form>
                             </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $myprojects->links() }}
        </div>
@endsection
