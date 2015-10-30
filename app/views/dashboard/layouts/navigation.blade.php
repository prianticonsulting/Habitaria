<!--Navigation-->
<nav class="main-header clearfix" role="navigation">

	<a class="navbar-brand">
		<img src="{{asset('assets/index/images/templatemo_logo.png')}}" alt="logo" class="logo">
	</a>

<!--Navigation Itself-->

<div class="navbar-content">

  <!--Sidebar Toggler-->
  <a href="#" class="btn btn-default left-toggler" title="Panel"><i class="fa fa-bars"></i></a>
  <div class="btn-group" >
    <a href="#" class="btn btn-default " title="Sugerencias" id="modalEmail"><i class="entypo-mail"></i><!--<span class="new"></span>--></a>
  </div>
  <?php
  $user_id = Auth::user()->id;
  $suggestions= Suggestion::where('id_receptor','=',$user_id)->where('tray','<>',0)->where('mark','<>','read')->orderBy('created_at', 'desc')->get();
  $count= Suggestion::where('id_receptor','=',$user_id)->where('tray','<>',0)->where('mark','<>','read')->count();
  $expiration_license = LicenseExpiration::where('colony_id','=',Session::get("colonia"))->first();
  ?>
    <div class="btn-group">
        <button type="button" title="Notificaciones" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <i class="entypo-megaphone"></i>@if($count > 0)<span class="new"></span>@endif</button>
        <div id="notification-dropdown" class="dropdown-menu">
          <div class="dropdown-header">Notificaciones <span class="badge pull-right">{{ $count }}</span></div>
          <div class="dropdown-container">
            <div class="nano">
              <div class="nano-content">
                <ul class="notification-dropdown">
                  @foreach($suggestions as $suggestion)
                      <li class="bg-info"><a href="{{ URL::route('config.colony.suggestions.view',$suggestion->id_mensaje) }}"> <span class="notification-icon"><i class="fa fa-bolt"></i></span>
                        <h4>{{ $suggestion->asunto }}</h4>
                        <p>{{ $suggestion->contenido }}</p>
                        <span class="label label-default"></span> </a>

                      </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          <div class="dropdown-footer"><a class="btn btn-dark" href="{{URL::route('config.colony.suggestion')}}">Ver Todo</a></div>
        </div>
    </div>

	@if(Session::get('rol_usuario') == 2)
	  <div class="btn-group" style="display:none;">
	   <a href="#" class="btn btn-default" id="modalLicence" title="Licencia"><span class="entypo-key"></i>@if(Session::get('days_expiration') && Session::get('days_expiration') <= 7)<span class="new"></span>@endif @if( Session::get('lic_expiration') && Session::get('lic_expiration') <= 7)<span class="new"></span>@endif</a>
	  </div>
	@endif

  <!--Right Userbar Toggler-->
  <a href="#" class="btn btn-user right-toggler pull-right" title="Mi Perfil"><i class="entypo-vcard"></i>
	<span class="logged-as hidden-xs">Logueado como</span>
	<span class="logged-as-name hidden-xs"></span>
  </a>
  <!--Fullscreen Trigger-->

  <button type="button" class="btn btn-default hidden-xs pull-right" id="toggle-fullscreen"> <i class=" entypo-popup" title="Pantalla Completa"></i> </button>

  <a href="https://www.youtube.com/channel/UCeQqfoEfHCqNnpIrZ9cR2Ag" target="_blank" title="Youtube"   class="btn btn-default hidden-xs pull-right"><img src="{{asset('assets/index/images/youtubeglass.png')}}"  alt="youtube" height="20" width="20"></a>
  <a href="https://www.facebook.com/pages/Habitaria/921256204584180" target="_blank" title="Facebook"   class="btn btn-default hidden-xs pull-right"><img src="{{asset('assets/index/images/facebook.png')}}"  alt="facebook" height="20" width="20"></a>

  <!--Lock Screen-->

  @if( Session::get('days_expiration') && Session::get('days_expiration') > 0)
 	<a href="#" @if(Session::get('rol_usuario') == 2) id="modalPromo" @endif class="btn btn-default hidden-xs pull-right">
	<span class="pull-right text-dark-red" style="font-size:14px" title="Periodo de Evaluación">{{Session::get('days_expiration')}} días de prueba</span>
	</a>

 @endif

</div>
</nav>

<!--/Navigation-->
