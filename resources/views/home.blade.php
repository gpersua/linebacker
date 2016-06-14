@extends('app')

@section('htmlheader_title')
    Home
@endsection


@section('main-content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"></div>

				<div class="panel-body">
                                    <div class="col-md-3">
                                        <a href="{{ asset('/users/account/create') }}"><img src="{{ asset('/assets/img/telefono-icon-grande.png') }}"><br /> Create an account extension</a>	
                                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
