@extends('app')

@section('htmlheader_title')
    My Contacts 
@endsection

@section('main-content')


    <h1>My Contacts <a href="{{ url('users/contacts/create') }}" class="btn btn-primary pull-right btn-sm">Add New Contact</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>UserAcc</th><th>First Name</th><th>Last Name</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($contacts as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('users/contacts/show', $item->id) }}">{{ $item->userAcc }}</a></td><td>{{ $item->first_name }}</td><td>{{ $item->last_name }}</td>
                    <td>
                        
                        <a href="{{ url('users/contacts/edit/' . $item->id ) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a> /
                        
                        <a title="Destroy" href="{{ URL::to('users/contacts/destroy/' . $item->id ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $contacts->render() !!} </div>
    </div>

@endsection
