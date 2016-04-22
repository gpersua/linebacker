@extends('app')

@section('htmlheader_title')
    Extension
@endsection

@section('main-content')

    <h1>Edit Extension</h1>
    <hr/>

    {!! Form::model($extension, [
        'method' => 'GET',
        'url' => ['admin/extension/update', $extension->did_extension],
        'class' => 'form-horizontal'
    ]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group {{ $errors->has('did_extension') ? 'has-error' : ''}}">
                {!! Form::label('did_extension', 'Did Extension: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('did_extension', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('did_extension', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('extension') ? 'has-error' : ''}}">
                {!! Form::label('extension', 'Extension: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('extension', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('extension', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('server_url') ? 'has-error' : ''}}">
                {!! Form::label('server_url', 'Server Url: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('server_url', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('server_url', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('userAcc') ? 'has-error' : ''}}">
                {!! Form::label('userAcc', 'Useracc: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('userAcc', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('userAcc', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection