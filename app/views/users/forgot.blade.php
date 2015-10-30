@extends ('dashboard.layouts.users')

@section ('titlePage')
	HABITARIA | Restablecimiento de Contraseña
@stop

{{-- Content --}}
@section ('pageContent')

<div class="colorful-page-wrapper">
  <div class="center-block">
    <div class="login-block">
		
		
		@if ( Session::get('error') )
				
			@endif

			@if ( Session::get('notice') )
				<div class="alert alert-info">{{ Session::get('notice') }}</div>
			@endif
		<!--LOGIN -->
		<form method="POST" action="{{ URL::to('/users/forgot') }}" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="forgotbox">
				
				<center>
				<br><br><br><br><br>
					<h4><span class="lead">Encuentra tu cuenta</span></h4>
					<hr>
					<small>Ingrese su e-mail para recibir instrucciones</small>
				
				
				<label>
				  <input type="email" name="email" id="email"  class="forgot_input" autocomplete="on" value="{{ Input::old('email') }}">
				</label>
				<br>
				<!-- Messages-->	
					@if ( Session::get('error') )
						<div class="callout callout-danger">
							<h4>{{ Session::get('error') }}</h4>
						</div>
					@endif

					@if ( Session::has('notice') )
						<div class="callout callout-info">
							<h4>{{ Session::get('notice') }}</h4>
						</div>
					@endif
				<!-- /Messages-->
				<br>
					<small>
						<a class="return text-warning" href="{{URL::route('login')}}"><i class="icon fa fa-arrow-left"></i> Regresar al login &nbsp;</a>
					</small>
					<button type="submit" class="btn btn-success btn-xs send_forgot">Buscar</button>
					
				</center>
			</div>
			<br>
			<br>
		</form>
    </div>
</div>

@stop
