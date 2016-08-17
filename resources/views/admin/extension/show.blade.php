@extends('app')

@section('htmlheader_title')
    Extension
@endsection

@section('main-content')

    <h1>Extension</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Did Extension</th><th>Extension</th><th>Server Url</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $extension->id }}</td> <td> {{ $extension->did_extension }} </td><td> {{ $extension->extension }} </td><td> {{ $extension->server_url }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection