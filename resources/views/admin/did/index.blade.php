@extends('app')

@section('htmlheader_title')
    Dids
@endsection

@section('main-content')

    <h1>Did <a href="{{ url('admin/did/create') }}" class="btn btn-primary pull-right btn-sm">Add New Did</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Did</th><th>Is Available</th><th>Extension</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($did as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/did/show/', $item->did) }}">{{ $item->did }}</a></td><td>{{ $item->is_available }}</td><td>{{ $item->extension }}</td>
                    <td>
                        <a href="{{ url('admin/did/edit/' . $item->did ) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                            
                        </a> /
                        <a title="Destroy" href="{{ URL::to('admin/did/destroy/'. $item->did ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $did->render() !!} </div>
    </div>

@endsection
