@extends('app')
@section('htmlheader_title')
    Filing a Case
@endsection
@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Filing a Case</h3>
            <hr/>
            {!! Form::open(['url' => 'users/filing/store', 'class' => 'form-horizontal']) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group {{ $errors->has('street') ? 'has-error' : ''}}">
                {!! Form::label('street', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('street', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('street', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('street') ? 'has-error' : ''}}">
                {!! Form::label('street', 'Registered phone number: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('street', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('street', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('street') ? 'has-error' : ''}}">
                {!! Form::label('street', 'Street: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('street', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('street', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_city') ? 'has-error' : ''}}">
                {!! Form::label('id_city', '(Zip Code)City: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('id_city', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('id_city', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
                {!! Form::label('state', 'State: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('state', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                {!! Form::label('company_name', 'Company Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('company_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <input type="hidden" name="id" id="id" value="{{ Auth::User()->id }}" />


            <div class="form-group {{ $errors->has('telemakerting_service') ? 'has-error' : ''}}">
                {!! Form::label('telemakerting_service', 'Telemakerting service: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telemakerting_service', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('telemakerting_service', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('telemakerting_phone_number') ? 'has-error' : ''}}">
                {!! Form::label('telemakerting_phone_number', 'Telemakerting Phone Number: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telemakerting_phone_number', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('telemakerting_phone_number', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('telemakerting_agent_supervisor') ? 'has-error' : ''}}">
                {!! Form::label('telemakerting_agent_supervisor', 'Telemakerting agent/supervisor: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telemakerting_agent_supervisor', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('telemakerting_agent_supervisor', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('date_of_call') ? 'has-error' : ''}}">
                {!! Form::label('date_of_call', 'Date of Call/Time of call: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('date_of_call', null, ['id' => 'birthday', 'placeholder' => 'mm/dd/yyyy', 'class' => 'form-control datepicker', 'required' => 'required','data-provide' => 'datepicker']) !!}
                    {!! $errors->first('date_of_call', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('linebacker_code') ? 'has-error' : ''}}">
                {!! Form::label('linebacker_code', 'Linebacker code: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('linebacker_code', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('linebacker_code', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('recorded_content_of_call') ? 'has-error' : ''}}">
                {!! Form::label('recorded_content_of_call', 'Recorded content of call: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('recorded_content_of_call', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('recorded_content_of_call', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('comments_adicional_info') ? 'has-error' : ''}}">
                {!! Form::label('comments_adicional_info', 'Comments/adicional info: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('comments_adicional_info', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('comments_adicional_info', '<p class="help-block">:message</p>') !!}
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


        </div>
    </div>



@endsection
<script type="text/javascript" src="{{ asset('/js/handlebars-v4.0.5.js') }}" ></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="/js/search.js"></script>

<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script>

    $('#birthday').datepicker({
        format: "yyyy/mm/dd",
        showWeek: true,
        todayHighlight: true,
        showButtonPanel: true
    });
</script>