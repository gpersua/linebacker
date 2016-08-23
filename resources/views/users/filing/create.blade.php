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
            <div class="form-group">
                <label class="col-sm-3 control-label" for="query">Name:</label>

                <div class="col-sm-6">
                    {!! Form::text('id_city', null, ['class' => 'typeahead', 'placeholder' => 'Search...', 'id' => 'id_city', 'data-provide' => 'typeahead', 'autocomplete' => 'off']) !!}

                    {!! $errors->first('id_city', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="query">Registered phone number</label>

                <div class="col-sm-6">
                    {!! Form::text('id_city', null, ['class' => 'typeahead', 'placeholder' => 'Search...', 'id' => 'id_city', 'data-provide' => 'typeahead', 'autocomplete' => 'off']) !!}

                    {!! $errors->first('id_city', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="query">Street</label>
                <div class="col-sm-6">
                    {!! Form::text('id_city', null, ['class' => 'typeahead', 'placeholder' => 'Search...', 'id' => 'id_city', 'data-provide' => 'typeahead', 'autocomplete' => 'off']) !!}

                    {!! $errors->first('id_city', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="query">(Zip Code)City:</label>


                <div class="col-sm-6">
                    {!! Form::text('id_city', null, ['class' => 'typeahead', 'placeholder' => 'Search...', 'id' => 'id_city', 'data-provide' => 'typeahead', 'autocomplete' => 'off']) !!}

                    {!! $errors->first('id_city', '<p class="help-block">:message</p>') !!}
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="query">State</label>


                <div class="col-sm-6">
                    {!! Form::text('id_city', null, ['class' => 'typeahead', 'placeholder' => 'Search...', 'id' => 'id_city', 'data-provide' => 'typeahead', 'autocomplete' => 'off']) !!}

                    {!! $errors->first('id_city', '<p class="help-block">:message</p>') !!}
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="query">Company name</label>


                <div class="col-sm-6">
                    {!! Form::text('id_city', null, ['class' => 'typeahead', 'placeholder' => 'Search...', 'id' => 'id_city', 'data-provide' => 'typeahead', 'autocomplete' => 'off']) !!}

                    {!! $errors->first('id_city', '<p class="help-block">:message</p>') !!}
                </div>

            </div>

            <input type="hidden" name="id" id="id" value="{{ Auth::User()->id }}" />


            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                {!! Form::label('first_name', 'Telemakerting service: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                {!! Form::label('last_name', 'Telemakerting Phone Number: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                {!! Form::label('address', 'Telemakerting agent/supervisor: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('birthday') ? 'has-error' : ''}}">
                {!! Form::label('birthday', 'Date of Call/Time of call: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('birthday', null, ['id' => 'birthday', 'placeholder' => 'mm/dd/yyyy', 'class' => 'form-control datepicker', 'required' => 'required','data-provide' => 'datepicker']) !!}
                    {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                {!! Form::label('phone_number', 'Linebacker code: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('phone_number', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('second_phone') ? 'has-error' : ''}}">
                {!! Form::label('second_phone', 'Recorded content of call: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('second_phone', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('second_phone', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('second_phone') ? 'has-error' : ''}}">
                {!! Form::label('second_phone', 'Comments/adicional info: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('second_phone', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('second_phone', '<p class="help-block">:message</p>') !!}
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
<script type="text/javascript" src="{{ asset('/assets/js/handlebars-v4.0.5.js') }}" ></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="/assets/js/search.js"></script>

<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>

    $('#birthday').datepicker({
        format: "yyyy/mm/dd",
        showWeek: true,
        todayHighlight: true,
        showButtonPanel: true
    });
</script>