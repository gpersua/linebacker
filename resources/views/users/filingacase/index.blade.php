@extends('app')
@section('htmlheader_title')
    Filing A Case
@endsection
@section('main-content')
    <h1>Filing a Case <a href="{{ url('users/filingacase/create') }}" class="btn btn-primary pull-right btn-sm">Add New Filing a Case</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th><th>case presented</th><th>Company Name</th><th>Telemarketing service</th><th>Date of call / Time of call</th><th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if(is_null($account) === false)
                {{-- */$x=0;/* --}}
                @foreach($account as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td>{{ $x }}</td>
                        <td><a href="{{ url('users/filingacase/show/'. $item->userAcc) }}">{{ $item->id_membership }}</a></td><td>{{ $item->userAcc }}</td><td>{{ $item->id_city }}</td><td>{{ $item->first_name }}</td>
                        <td>
                            <a href="{{ url('users/filingacase/edit/' . $item->userAcc) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a> /
                            <a title="Destroy" onclick="return confirmar('Are sure you want to delete the record?')" href="{{ URL::to('users/account/destroy/' . $item->userAcc ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5">
                        <div class="pagination"> {!! $account->render() !!} </div>
                    </td>
                </tr>
            @endif
            @if(is_null($account1) === false)
                <tr>
                    <td></td>
                    <td>{{ $account1['id_membership'] }}</td>
                    <td><a href="{{ url('users/filingacase/show/'. $account1['userAcc']) }}">{{ $account1['userAcc'] }}</a></td><td>{{ $account1['id_city'] }}</td><td>{{ $account1['first_name'] }}</td>
                    <td>
                        <a href="{{ url('users/filingacase/edit/' . $account1['userAcc']) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a> /
                        <a title="Destroy" onclick="return confirmar('Are sure you want to delete the record?')" href="{{ URL::to('users/account/destroy/' . $account1['userAcc'] ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>
                    </td>
                </tr>
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