@extends('app')

@section('htmlheader_title')
    Dids
@endsection

@section('main-content')
<div class="container">
    <h1>Direct Inward Dialing - Upload File</h1>
      
<div class="table">
       
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading"></div>
            <div class="panel-body">
              <form method="POST" action="{{ url('admin/did/save') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label class="col-md-4 control-label">New File</label>
                  <div class="col-md-6">
                      <input class="form-control" type="file" name="file" >
                  </div>
                </div>
                <br /><br />
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
