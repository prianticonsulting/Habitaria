<!--Navigation-->
<nav class="main-header clearfix" role="navigation"> 

	<a class="navbar-brand">
		<img src="{{asset('assets/index/images/templatemo_logo.png')}}" alt="logo" class="logo">
	</a> 

<!--Navigation Itself-->

<div class="navbar-content"> 
  
  <!--Sidebar Toggler--> 
  <a href="#" class="btn btn-default left-toggler"><i class="fa fa-bars"></i></a> 
  
  <?php
 
  $suggestions= DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->orderBy('created_at', 'desc')->get();
  $count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
  
  ?>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <i class="entypo-megaphone"></i>  @if($count > 0)<span class="new"></span>@endif</button>
        <div id="notification-dropdown" class="dropdown-menu">
          <div class="dropdown-header">Notificaciones <span class="badge pull-right"></span></div>
          <div class="dropdown-container">
            <div class="nano">
              <div class="nano-content">
                <ul class="notification-dropdown">
                
                   @foreach($suggestions as $suggestion)
                      <li class="bg-info"><a href="{{ URL::route('suggestions.view',$suggestion->id_mensaje) }}"> <span class="notification-icon"><i class="fa fa-bolt"></i></span>
                        <h4>{{ $suggestion->asunto }}</h4>
                        <p>{{ $suggestion->contenido }}</p>
                        <span class="label label-default"></span> </a>

                      </li>
                  @endforeach
                    
                </ul>
              </div>
            </div>
          </div>
          <div class="dropdown-footer"><a class="btn btn-dark" href="{{URL::route('suggestions')}}">Ver Todo</a></div>
        </div>
    </div>
  
  <!--Right Userbar Toggler-->
  <a href="#" class="btn btn-user right-toggler pull-right"><i class="entypo-vcard"></i> 
	<span class="logged-as hidden-xs">Logueado como</span>
	<span class="logged-as-name hidden-xs"></span>
  </a>  
  <!--Fullscreen Trigger-->
 
  <button type="button" class="btn btn-default hidden-xs pull-right" id="toggle-fullscreen"> <i class=" entypo-popup"></i> </button>
  


</div>
</nav>

<!--/Navigation--> 

