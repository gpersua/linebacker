@extends('app')
@section('htmlheader_title')
    Filing a Case
@endsection
@section('main-content')
    <h1>Filing a Case <a href="{{ url('users/filing/create') }}" class="btn btn-primary pull-right btn-sm">Add New Filing a Case</a></h1>
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>S.No</th><th>case presented</th><th>Company name</th><th>Telemarketing service</th><th>Telemarketing phone number</th><th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td><a href="#"></a></td><td></td><td></td><td></td>
                        <td>
                            <a href="{{ url('users/filing/edit') }}">
                                <span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                            </a>/
                            <a title="Destroy" onclick="return confirmar('Are sure you want to delete the record?')" href="#">
                                <span class="fa fa-trash" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="pagination">  </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#"></a></td><td></td><td></td>
                        <td>
                            <a href="{{ url('users/filing/edit') }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                            </a> /
                            <a title="Destroy" onclick="return confirmar('Are sure you want to delete the record?')" href="#">
                                <span class="fa fa-trash" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
@endsection
<script language="JavaScript">
    function confirmar ( mensaje )
    {
        return confirm( mensaje );
    }
</script>