<!--OffCanvas Menu -->
<aside class="user-menu"> 

<!-- Tabs -->
<div class="tabs-offcanvas">
  <ul class="nav nav-tabs nav-justified">
	<li class="active"><a href="#userbar-one" data-toggle="tab">Principal</a></li>
  </ul>
  <div class="tab-content"> 
	
	<!--User Primary Panel-->
	<div class="tab-pane active" id="userbar-one">
	  <div class="main-info">
		<div class="user-img"><img src="{{asset('uploads/users/default.png')}}" alt="User Picture" /></div>
		
	  </div>
		<div class="empthy"></div>
		<a href="{{{ URL::route('user.profile') }}}" class="list-group-item goaway"><i class="entypo-user"></i>Perfil</a>
		<a href="{{{ URL::to('users/logout') }}}" class="list-group-item goaway"><i class="fa fa-power-off"></i>Salir</a> </div>
	</div>
	
	<!--User Chat Panel-->

	<!--User Tasks Panel-->
	
<!-- /tabs --> 

</aside>
<!-- /Offcanvas user menu--> 
