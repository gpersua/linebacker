@extends('app')

@section('htmlheader_title')
    Roles
@endsection

@section('main-content')

    <h1>Roles <a href="{{ url('admin/roles/create') }}" class="btn btn-primary pull-right btn-sm">Add New Role</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Name</th><th>Slug</th><th>Description</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($roles as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/roles', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->slug }}</td><td>{{ $item->description }}</td>           
                    <td>
                        <a href="{{ url('admin/roles/edit/' . $item->id ) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a>
                        <a title="Destroy" href="{{ URL::to('admin/roles/destroy/' . $item->id ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $roles->render() !!} </div>
    </div>

@endsection
