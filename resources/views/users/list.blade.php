@extends('app')

@section('htmlheader_title')
    Users
@endsection

@section('main-content')
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
		@if (session()->has('msg'))
		<div class="alert alert-success alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<i class="icon fa fa-check"></i> {{ session('msg') }}
		</div>
		@endif
		@if (session()->has('done'))
		<div class="alert alert-danger alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<i class="icon fa fa-ban"></i> {{ session('done') }}
		</div>
		@endif
		{!! Form::model(Request::all(), array('url' => 'users', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'id' => 'search')) !!}
		   <div class="input-group">
		       {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Search...', 'id' => 'name', 'data-provide' => 'typeahead', 'autocomplete' => 'off']) !!}
		       <div class="input-group-btn">
			   <button class="btn btn-primary">
			   	<span class="glyphicon glyphicon-search"></span>
			   </button>
		       </div>
		   </div>
		{!! Form::close() !!}
		<p><a class="btn btn-small btn-info" href="{{ URL::to('users/create') }}" role="button"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> 
		Add User
		</a></p>
              <table id="users-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>E-Mail</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
		@foreach($user as $key => $value)
		<tr>
			<td> {{ $value->name }} </td> 
			<td> {{ $value->email }} </td> 
			<td> {{ $value->created_at }} </td>
			<td> @if ($value->in_active == 1) Active @else Inactive @endif </td>
			<!-- we will also add show, edit, and delete buttons -->
			<td>
			<a title="Edit" href="{{ URL::to('users/edit/' . $value->id ) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a> 
			<a title="Destroy" href="{{ URL::to('users/destroy/' . $value->id ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>
			</td>
		</tr>
		@endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
		{!! $user->appends(Request::only(['name']))->render() !!}
            </div>
</div>
<!-- /.box -->

@endsection
