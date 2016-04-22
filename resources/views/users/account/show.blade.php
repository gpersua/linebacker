@extends('app')

@section('htmlheader_title')
    Account
@endsection

@section('main-content')

    <h1>Account</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>user Account</th><th>Id City</th><th>First Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $account->id }}</td> <td> {{ $account->userAcc }} </td><td> {{ $account->id_city }} </td><td> {{ $account->first_name }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection