@extends('dashboard.layouts.users')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.forgot_password') }}} ::
@parent
@stop

@section ('titlePage')
	HABITARIA | Olvido de Contraseña
@stop

@section ('cssPage')
	{{ HTML::style('assets/css/styles.css'); }}
@stop


{{-- Content --}}
@section('pageContent')

<div class="colorful-page-wrapper">

  <div class="center-block">
    <div class="login-block" >
			<div class="registerbox-neighbor">
			<center>
					<br><br><br><br><br>
					<hr>				
					<span class="lead">Establecer nueva Contraseña</span><br>
				</center>
					<br>				
						{{ Confide::makeResetPasswordForm($token)->render() }}
			</div>
		</div>
	</div>
 
 </div>



@stop
