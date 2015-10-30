<!--Main Menu-->
@if(Auth::check())

<div class="responsive-admin-menu">
  <div class="responsive-menu">HABITARIA
	<div class="menuicon"><i class="fa fa-angle-down"></i></div>
  </div>
  <ul id="menu">
	<li>
	<a class="submenu active" data-id="dash-sub" title="Interface"><i class="entypo-briefcase"></i><span>Panel</span></a> 
      <!-- Panel Sub-Menu -->
      <ul id="dash-sub" class="accordion">
	  
        <li>
			<a class="{{Route::currentRouteName() == ('home') ? 'active' : '' }}" href="{{URL::route('home')}}" ><i class="entypo-home"></i><span>Inicio</span></a>
		</li>
		

		<li>
			<a title="Colonias" class="{{Route::currentRouteName() == ('colonies.inactive') ? 'active' : '' }}" href="{{URL::route('colonies.inactive')}}" ><i class="entypo-traffic-cone"></i><span>En versión de prueba</span></a>
        </li>

		<li>
			<a title="Promos" class="{{Route::currentRouteName() == ('promos') ? 'active' : '' }}" href="{{URL::route('promos')}}" ><i class="entypo-tag"></i><span>Promos</span></a>
        </li>
		
		<li>
			<a title="Colonias con licencia" class="{{Route::currentRouteName() == ('colonies.active') ? 'active' : '' }}" href="{{URL::route('colonies.active')}}" ><i class="entypo-feather"></i><span style="font-size: 0.98em;">Colonias con licencia</span></a>
        </li>
		
		<li>
			<a title="Licencias" class="{{Route::currentRouteName() == ('license') ? 'active' : '' }}" href="{{URL::route('license')}}" ><i class="entypo-key"></i><span>Licencias</span></a>
        </li>
		
		<li>
			<a title="Logs" class="{{Route::currentRouteName() == ('logs') ? 'active' : '' }}" href="{{URL::route('logs')}}" ><i class="fa fa-bars"></i><span>Registros</span></a>
        </li>
		
		<li> 
			<a title="Sugerencias" class="{{ Route::currentRouteName() == ('suggestions') ? 'active' : '' }}
										  {{ Route::currentRouteName() == ('suggestions.sent') ? 'active' : '' }}
										  {{ Route::currentRouteName() == ('suggestions.trash') ? 'active' : '' }}
										  {{ Route::currentRouteName() == ('suggestions.view') ? 'active' : '' }}
										  {{ Route::currentRouteName() == ('suggestions.view.sent') ? 'active' : '' }}" href="{{URL::route('suggestions')}}" ><i class="fa fa-inbox"></i><span>Tickets de Soporte</span></a>
        </li>
      </ul>
    </li>
  </ul>
</div>
<!--/MainMenu-->
@endif