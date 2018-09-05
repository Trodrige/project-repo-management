@extends('layouts.adminApp')

@section('content')
<h2>All Valid Projects</h2>
<table class="table table-striped">
                <thead>
                    <tr>
                        <th><Id</th>
                        <th>Type</th>
                        <th>Report.pdf</th>
                        <th>Implementation.zip</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <?php
                            $filename_pdf = $project->filename_pdf;
                            $filename_pdf = str_replace("public/","storage/",$filename_pdf);
                            //echo $filename_pdf;
                            $zip_filename = $project->zip_filename;
                            $zip_filename = str_replace("public/","storage/", $zip_filename);
                            //echo $zip_filename;
                        ?>
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->type }}</td>
                            <td><a href="{{ route('getpdf', $filename_pdf) }}"><button type="button" class="btn btn-success">Open Pdf</button></a></td>
                            <td><a href="{{ route('getfile', $zip_filename) }}"><button type="button" class="btn btn-primary">Download zip</button></a></td>
                            <td>
                                <form action="{{ route('destroy', ['id' => $project ->id]) }}" method="post">
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

</div>
@endsection