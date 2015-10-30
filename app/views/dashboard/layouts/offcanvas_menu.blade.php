<?php
		$colonia    = Session::get('colonia');
		$photo_user = UserPhoto::where('user_id','=',Auth::user()->id)->where('colony_id','=',$colonia)->pluck('filename');
  ?>
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
	 <!--  <div class="main-info">
		<div class="user-img"><img id="foto_panel" src="@if($photo_user){{asset('uploads/users/avatars/'.$photo_user)}}@else{{asset('uploads/users/default.png')}} @endif" alt="User Picture" /></div>
		
	  </div> -->
		<div class="empthy"></div>
		<a href="{{{ URL::route('neighbor.profile') }}}" class="list-group-item"><i class="entypo-user"></i>Perfil</a>
		<a href="{{{ URL::route('config.colony.sc') }}}" class="list-group-item"><i class="entypo-leaf"></i>Colonia</a>
		<a href="{{{ URL::to('users/logout') }}}" class="list-group-item goaway" id="salir"><i class="fa fa-power-off"></i>Salir</a> </div>
	</div>
	
	<!--User Chat Panel-->

	<!--User Tasks Panel-->
	
<!-- /tabs --> 

</aside>
<!-- /Offcanvas user menu--> 
