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
                {{ count($account) }}

@endsection
