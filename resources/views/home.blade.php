@extends('app')

@section('htmlheader_title')
    Home
@endsection


@section('main-content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
                                    <a href="{{ asset('/users/account/create') }}"><img src="{{ asset('/assets/img/telefono-icon-grande.png') }}"></a>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
