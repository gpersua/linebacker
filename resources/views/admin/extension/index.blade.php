@extends('app')

@section('htmlheader_title')
    Extension
@endsection

@section('main-content')

    <h1>Extension <a href="{{ url('admin/extension/create') }}" class="btn btn-primary pull-right btn-sm">Add New Extension</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Did Extension</th><th>Extension</th><th>Server Url</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($extension as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/extension/show', $item->did_extension) }}">{{ $item->did_extension }}</a></td><td>{{ $item->extension }}</td><td>{{ $item->server_url }}</td>
                    <td>
                        <a href="{{ url('admin/extension/edit/' . $item->did_extension) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a> 
                        /
                        
                        <a href="{{ url('admin/extension/destroy/' . $item->did_extension ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $extension->render() !!} </div>
    </div>

@endsection
