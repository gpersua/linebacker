@extends('app')

@section('htmlheader_title')
    Contacts 
@endsection

@section('main-content')


    <h1>Contacts @if(Session::has('userAcc'))
    {{ Session::get('userAcc') }}
@endif <a href="{{ url('users/contacts/create') }}" class="btn btn-primary pull-right btn-sm">Add New Contact</a></h1>
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
                    <td><a href="{{ url('users/contacts', $item->id) }}">{{ $item->userAcc }}</a></td><td>{{ $item->first_name }}</td><td>{{ $item->last_name }}</td>
                    <td>
                        <a href="{{ url('users/contacts/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['users/contacts', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $contacts->render() !!} </div>
    </div>

@endsection
