@extends('app')

@section('htmlheader_title')
    Dids
@endsection

@section('main-content')

    <h1>Did</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Did</th><th>Is Available</th><th>Extension</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $did->id }}</td> <td> {{ $did->did }} </td><td> {{ $did->is_available }} </td><td> {{ $did->extension }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection