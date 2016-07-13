@extends('app')

@section('htmlheader_title')
    My Contacts {{ Session::get('userAcc') }}
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
            @if(is_null($contacts) === false)
            {{-- */$x=0;/* --}}
            @foreach($contacts as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('users/contacts/show', $item->id) }}">{{ $item->userAcc }}</a></td><td>{{ $item->first_name }}</td><td>{{ $item->last_name }}</td>
                    <td>
                        
                        <a href="{{ url('users/contacts/edit/' . $item->id ) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a> /
                        
                        <a title="Destroy" onclick="return confirmar('Are sure you want to delete the record?')" href="{{ URL::to('users/contacts/destroy/' . $item->id ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>

                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">
                    <div class="pagination"> {!! $contacts->render() !!} </div>
                </td>
            </tr>   
            @endif
            @if(is_null($contacts1) === false)
            @foreach($contacts1 as $contact)
        <tr>
            <td></td>
                    <td><a href="{{ url('users/contacts/show', $contact['id']) }}">{{ $contact['userAcc'] }}</a></td><td>{{ $contact['first_name'] }}</td><td>{{ $contact['last_name'] }}</td>
                    <td>
                        
                        <a href="{{ url('users/contacts/edit/' . $contact['id'] ) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a> /
                        
                        <a title="Destroy" onclick="return confirmar('Are sure you want to delete the record?')"  href="{{ URL::to('users/contacts/destroy/' . $contact['id'] ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>

                    </td>
                </tr>
                 @endforeach
            @endif
            </tbody>
        </table>
  
    </div>

@endsection
<script language="JavaScript">
function confirmar ( mensaje ) {
  return confirm( mensaje );
} 
</script>