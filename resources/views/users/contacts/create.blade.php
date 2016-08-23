@extends('app')
@section('htmlheader_title')
    Contacts
@endsection
@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Contact</h3>
            <hr/>
            {!! Form::open(['url' => 'users/contacts/store', 'class' => 'form-horizontal']) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!--<div class="form-group {{ $errors->has('userAcc') ? 'has-error' : ''}}">
                {!! Form::label('userAcc', 'Useracc: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('userAcc', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('userAcc', '<p class="help-block">:message</p>') !!}
                </div>
            </div>-->
            @if(Session::has('userAcc'))
                <input type="hidden" name="userAcc" id="userAcc" value="{{ Session::get('userAcc') }}" />
            @endif
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                {!! Form::label('first_name', 'First Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                {!! Form::label('last_name', 'Last Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                {!! Form::label('address', 'Address: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('primary_phone') ? 'has-error' : ''}}">
                {!! Form::label('primary_phone', 'Primary Phone: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('primary_phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('primary_phone', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('second_phone') ? 'has-error' : ''}}">
                {!! Form::label('second_phone', 'Second Phone: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('second_phone', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('second_phone', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('third_phone') ? 'has-error' : ''}}">
                {!! Form::label('third_phone', 'Third Phone: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('third_phone', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('third_phone', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}

                    <a class="btn btn-danger" href="{{ URL::to('users/filingacase') }}">Cancel</a>

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