@extends('app')

@section('htmlheader_title')
    Membership
@endsection

@section('main-content')
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Membership</h3>
            </div>
            <!-- /.box-header -->
  <div class="box-body">
    {!! Form::model(Request::all(), array('url' => 'admin/membership', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'id' => 'search')) !!}
		   <div class="input-group">
		       {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Search...', 'id' => 'description', 'data-provide' => 'typeahead', 'autocomplete' => 'off']) !!}
		       <div class="input-group-btn">
			   <button class="btn btn-primary">
			   	<span class="glyphicon glyphicon-search"></span>
			   </button>
		       </div>
		   </div>
		{!! Form::close() !!}
    <p><a class="btn btn-small btn-info" href="{{ url('admin/membership/create') }}" role="button"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> 
		Add  Membership
		</a></p>
    
                
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Description</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($membership as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/membership/show/' . $item->idlb_membership) }}">{{ $item->description }}</a></td>
                    <td>
                        <a href="{{ url('admin/membership/edit/' . $item->idlb_membership ) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                            
                        </a> /
                        <a title="Destroy" href="{{ URL::to('admin/membership/destroy/' . $item->idlb_membership ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $membership->render() !!} </div>
    </div>
  </div>
</div>
@endsection
