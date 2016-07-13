@extends('app')

@section('htmlheader_title')
    Dids
@endsection

@section('main-content')
  <div class="container">
    <h1>Direct Inward Dialing </h1>
      
    <div class="table">
       
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <th><a href="{{ url('admin/did/upload') }}" class="btn btn-primary pull-left btn-sm">Upload File</a> </th>
            <th></th>
            <th></th>
            <th></th>
       <th><a href="{{ url('admin/did/create') }}" class="btn btn-primary pull-right btn-sm">Add New Did</a></th>
                <tr>
                    <th>#</th><th>Did</th><th>Is Available</th><th>Extension</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($did as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/did/show/', $item->did) }}">{{ $item->did }}</a></td><td>{{ $item->is_available }}</td><td>{{ $item->extension }}</td>
                    <td>
                        <a href="{{ url('admin/did/edit/' . $item->did ) }}"><span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                            
                        </a> /
                        <a title="Destroy" onclick="return confirmar('Are sure you want to delete the record?')" href="{{ URL::to('admin/did/destroy/'. $item->did ) }}"><span class="fa fa-trash" aria-hidden="true"></span></a>
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $did->render() !!} </div>
    </div>
   </div>

@endsection
<script language="JavaScript">
function confirmar ( mensaje ) {
  return confirm( mensaje );
} 
</script>