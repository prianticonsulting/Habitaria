@extends ('dashboard.layouts.users')

@section ('titlePage')
	SYSTEM | Registro de Usuario
@stop

{{-- Content --}}
@section ('pageContent')

<div class="colorful-page-wrapper">
  <div class="center-block">
    <div class="login-block">
	  <form method="POST" action="{{{ (Auth::check()) ?: URL::to('users/store')  }}}" accept-charset="UTF-8" id="login-form" class="orb-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <header>
          <div class="image-block"><img src="{{asset('assets/images/logo.png')}}" alt="User" /></div>
          Nuevo registro de Usuario 
			<small><a href="{{URL::route('login')}}"><i class="icon fa fa-arrow-left"></i>&nbsp; Regresar al login</a></small>
		</header>
        <fieldset>
			
			 @if ( Session::get('error') )
				<div class="alert alert-error alert-danger">
					@if ( is_array(Session::get('error')) )
						{{ head(Session::get('error')) }}
					@endif
				</div>
			@endif

			@if ( Session::get('notice') )
				<div class="alert">{{ Session::get('notice') }}</div>
			@endif		
          <br>
          <section>
            <div class="row">
              <label class="label col col-3"><small>E-mail</small></label>
              <div class="col col-9">
                <label class="input"> <i class="icon-append fa fa-user"></i>
                 <input type="email" name="email" id="email" value="{{{ Input::old('email') }}}" />
                </label>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
              <label class="label col col-3"><small>Contraseña</small></label>
              <div class="col col-9">
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                   <input type="password" name="password" id="password"/>
                </label>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
              <label class="label col col-3"></label>
              <div class="col col-9">
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                   <input type="password" placeholder="Confirmar contraseña" name="password_confirmation" id="password_confirmation"/>
                </label>
              </div>
            </div>
          </section>
          
        </fieldset>
        <footer>
          <button type="reset"  class="btn btn-default" style="float:left"><i class="icon fa fa-refresh"></i> Reset</button>
          <button type="submit" class="btn btn-default">Registrarme</button>
        </footer>
      </form>
    </div>
</div>

@stop
