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
			<a class="{{Route::currentRouteName() == ('admin.home') ? 'active' : '' }}" href="{{URL::route('admin.home')}}" ><i class="entypo-home"></i><span>Inicio</span></a>
		</li>
		

		<li><a title="Colonias" class="{{Route::currentRouteName() == ('admin.colonies') ? 'active' : '' }}" href="{{URL::route('admin.colonies')}}" ><i class="entypo-tag"></i><span>Colonias Inactivas</span></a>
        </li>

	

      </ul>
    </li>
  </ul>
</div>
<!--/MainMenu-->
@endif