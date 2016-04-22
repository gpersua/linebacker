@extends('app')

@section('htmlheader_title')
    Dids
@endsection

@section('main-content')

    <h1>Create New Did</h1>
    <hr/>

    {!! Form::open(['url' => 'admin/did/store', 'class' => 'form-horizontal']) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group {{ $errors->has('did') ? 'has-error' : ''}}">
                {!! Form::label('did', 'Did: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('did', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('did', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('is_available') ? 'has-error' : ''}}">
                {!! Form::label('is_available', 'Is Available: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('is_available', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('is_available', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('is_available', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('extension') ? 'has-error' : ''}}">
                {!! Form::label('extension', 'Extension: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('extension', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('extension', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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