@extends('app')

@section('htmlheader_title')
    Account
@endsection

@section('main-content')

    <h1>Account <a href="{{ url('users/account/create') }}" class="btn btn-primary pull-right btn-sm">Add New Account</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Id Membership</th><th>User Acc</th><th>Id City</th><th>First Name</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @role('admin')
            {{-- */$x=0;/* --}}
            @foreach($account as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('users/account/show/'. $item->userAcc) }}">{{ $item->id_membership }}</a></td><td>{{ $item->userAcc }}</td><td>{{ $item->id_city }}</td><td>{{ $item->first_name }}</td>
                    <td>
                        <a href="{{ url('users/account/edit/' . $item->userAcc) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a> /
                        
                        <a title="Destroy" href="{{ URL::to('users/account/destroy/' . $item->userAcc ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>
                        
                        
                    </td>
                </tr>
            @endforeach
            @endrole
            </tbody>
        </table>
        <div class="pagination">  @role('admin') {!! $account->render() !!} @enrole </div>
    </div>

@endsection
