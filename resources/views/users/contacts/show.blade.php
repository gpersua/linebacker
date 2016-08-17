@extends('app')

@section('htmlheader_title')
    Contacts
@endsection

@section('main-content')

    <h1>Contact</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>User Account:</th><th>First Name</th><th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $contact->id }}</td> <td> {{ $contact->userAcc }} </td><td> {{ $contact->first_name }} </td><td> {{ $contact->last_name }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection