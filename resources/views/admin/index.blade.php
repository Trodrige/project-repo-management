@extends('layouts.adminApp')

@section('content')
<h2>CheckBox to Validate Project</>
<p><small>Click save changes to confirm validation</small></p>
<style>
/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
<div class="container">


<table class="table table-striped">
                <thead>
                    <tr>
                        <th>CheckBox</th>
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
                            <td>
                                <form action="{{ url('/validate') }}" method="POST" enctype="multipart/form-data" class="card">
                                    @csrf
                                    <div class="col-lg-12">
                                        <label class="container">{{$project->title}}
                                            <input type="checkbox" value="{{$project->id}}" name="checked[]">
                                            <span class="checkmark"></span>
                                        </label>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-magic"></i>&nbsp; Save Changes</button>
                                    </div>
                                </form>
                            </td>
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