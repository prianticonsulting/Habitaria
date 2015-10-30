<?php setlocale(LC_TIME, 'es_MX.UTF-8'); ?>
@extends ('dashboard.layouts.default')
@section ('titlePage')
	HABITARIA - PANEL | Perfil del Vecino
@stop
@section ('cssPage')
	{{ HTML::style('assets/css/styles.css'); }}
@stop

@section ('pageContent')
<!--Smooth Scroll-->
	<div class="smooth-overflow">
		@include('dashboard.layouts.navigation')
	
	<!--MainWrapper-->
		<div class="main-wrap"> 
		<!--OffCanvas Menu -->
			@include('dashboard.layouts.offcanvas_menu')
		<!--Main Menu-->
			@include('dashboard.layouts.main_menu')
			
			<div class="content-wrapper"> 
        <!--Content Wrapper-->
			<!--Horisontal Dropdown-->
			@include('dashboard.layouts.horizontal_dropdown')
		<!--Breadcrumb-->
			<div class="breadcrumb clearfix">
			  <ul>
				<li><a href="{{URL::route('home')}}"><i class="fa fa-home"></i></a></li>
				<li class="active">Perfil del Vecino</li>
				<li class="active" style="float:right">Bienvenido {{$neighbor->name}} {{$neighbor->last_name}} [	{{$urbanism}}	]</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
          <h1>Perfil<small>Vecino</small></h1>
        </div>
        
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
            
            <div class="powerwidget green" id="profile" data-widget-editbutton="false">
              <header></header>
              <div class="inner-spacer"> 
                
                <!--Profile-->
                <div class="user-profile">
                  <div class="main-info">
                  <!--comentado por ahora  -->
                   <!--  <div class="user-img" >
                             {{ Form::open(array('url' => 'foto.perfil', 'files' => true, 'class' => 'formulario')) }}
                                    <label style="display:none;"> {{ Form::file('photo',['id' => 'botonFile']) }}</label>
                                    <img  id="foto_user" src="@if($photo_user){{asset('uploads/users/avatars/'.$photo_user)}}@else{{'http://placehold.it/150x150'}} @endif" alt="User Picture" />
                            {{ Form::close() }} 
                    </div> -->
                    <h1>{{$neighbor->name}} {{$neighbor->last_name}}</h1>
                     <!--comentado por ahora  -->
						<strong>Colonia | </strong> {{$colonia_nombre}} </div>
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item item1 active"> </div>
                      <div class="item item2"></div>
                      <div class="item item3"></div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a> </div>
                  <div class="user-profile-info">
                    <div class="tabs-white">
                      <ul id="myTab" class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#home" data-toggle="tab">Datos</a></li>
                        <li><a href="#properties" data-toggle="tab">Propiedades</a></li>
                        <li><a href="#edit" data-toggle="tab">Cambiar contraseña</a></li>
                        <li><a href="#licencia" data-toggle="tab">Licencia</a></li>
                      </ul>
                      
                      <div id="myTabContent" class="tab-content">
                        <div class="tab-pane in active" id="home">
                          <div class="profile-header">Datos</div>
                         
                          <table class="table">
                            <tr>
                              <td><strong>Email:</strong></td>
                              <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                              <td><strong>Teléfono:</strong></td>
                              <td>{{$neighbor->phone}}</td>
                            </tr>
                            <tr>
                               <td><strong>Rol:</strong></td>
                              <td>{{$role}}</td>
                            </tr>
                            
                          </table>
                        </div>
                        <div class="tab-pane" id="properties">
                          <div class="profile-header">Mis propiedades</div>
                          <ul class="tmtimeline">
							@foreach($neighbor->NeighborProperty as $neighbor_row)			
								<li>
								  <time class="tmtime">
									  <span>Miembro desde:</span>
									<span>{{strftime("%d/%b/%Y",strtotime($neighbor_row->created_at))}}</span>
								  </time>
								  <div class="tmicon bg-cold-grey fa-{{($neighbor_row->Urbanism->urbanism_type_id == 3)? 'building':'home'}}"></div>
								  <div class="tmlabel">
									<h2>{{$neighbor_row->Urbanism->Colony->name;}}</h2>									
									<p><strong>Desarrollo: </strong><!-- {{$neighbor_row->Urbanism->name}} --></p>
									<p><strong>Tipo de Desarrollo: </strong>{{$neighbor_row->Urbanism->UrbanismType->type}}</p>
									<p><strong>{{($neighbor_row->Urbanism->urbanism_type_id == 3)? 'Piso':'Calle'}}: </strong>{{($neighbor_row->num_street_id == NULL)? $neighbor_row->Building->description : $neighbor_row->Street->name;}}</p>
									<p><strong>{{($neighbor_row->Urbanism->urbanism_type_id == 3)? 'Apartamento No.':'Casa No.'}}: </strong>{{$neighbor_row->num_house_or_apartment}}</p>
									<p><strong>Ubicación: </strong> {{$neighbor_row->Urbanism->Colony->City->name;	}}</p>				
								  </div>
								</li>
							@endforeach
                          </ul>
                        </div>
                        <div class="tab-pane in " id="edit">
                          <div class="profile-header">Cambiar contraseña</div>
							
							{{ Form::open(['action'=>'UsersController@change_password','files'=>'true', 'id'=>'registrationLogin-form', 'class'=>'orb-form']) }}

									<fieldset>			
									  <section>
                    <div class="row">
                      <label class="label col col-3">Contraseña Actual</label>
                      <div class="col col-4">
                      <label class="input"> <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password1" placeholder="Contraseña Actual" id="password1">
                      </label>
                      </div>
                    </div>
                    </section>
                    <section>
										<div class="row">
										  <label class="label col col-3">Nueva Contraseña</label>
										  <div class="col col-4">
											<label class="input"> <i class="icon-append fa fa-lock"></i>
											  <input type="password" name="password2" placeholder="Nueva Contraseña" id="password2">
											</label>
										  </div>
										</div>
									  </section>
									  <section>
										<div class="row">
										  <label class="label col col-3">Confirmar Nueva Contraseña</label>
										  <div class="col col-4">
											<label class="input"> <i class="icon-append fa fa-lock"></i>
											  <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirmar Nueva Contraseña">
											</label>
										  </div>
										</div>
									  </section>
									</fieldset>
									<footer>
									  <button type="submit" class="btn btn-default pull-right">Cambiar contraseña</button>
									</footer>
								  {{ Form::close() }}

                        </div>



                       <div class="tab-pane in" id="licencia">
                          <div class="profile-header">Datos de Licencia</div>
                         
                          <table class="table">
                            @if($licencia)
                                <tr>
                                  <td><strong>Estado:</strong></td><td>Activa</td>
                                </tr>
                                <tr>
                                  <td><strong>Fecha Activación:</strong></td><td>{{strftime("%d/%b/%Y",strtotime($licencia->created_at))}}</td>
                                </tr>
                                <tr>
                                  <td><strong>Fecha Expiración:</strong></td><td>{{strftime("%d/%b/%Y",strtotime($expiration_license->expiration))}}</td>
                                </tr>
                            @else
                                <tr>
                                  <td><strong>Estado:</strong></td><td>Inactiva</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Debe Activar una Licencia</td>
                                  </tr>
                            @endif
                           
                            
                          </table>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/Profile--> 
            </div>
          </div>
          <!-- End .powerwidget --> 
          
        </div>
        <!-- /Inner Row Col-md-12 --> 
      </div>
      <!-- /Widgets Row End Grid--> 
    </div>
    <!-- / Content Wrapper --> 
  </div>
  <!--/MainWrapper--> 
</div>
<!--/Smooth Scroll--> 


<!-- scroll top -->
<div class="scroll-top-wrapper hidden-xs">
    <i class="fa fa-angle-up"></i>
</div>
<!-- /scroll top -->


<!--Scripts-->
<!--JQuery--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery-ui.min.js')}}"></script>

<!--Fullscreen--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/fullscreen/screenfull.min.js')}}"></script>

<!--NanoScroller--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js')}}"></script>

<!--Sparkline--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/sparkline/jquery.sparkline.min.js')}}"></script>

<!--Horizontal Dropdown--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/classie/classie.js')}}"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>

<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>


<!--X-Editable--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/demo.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/demo-mock.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/address.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/jquery.mockjax.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/select2-bootstrap.css')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/typeahead.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/typeaheadjs.js')}}"></script>


<!--ToDo--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Knob--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/knob/jquery.knob.js')}}"></script>


<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!--Page Specific-->
<script type="text/javascript" src="{{asset('assets/js/script.custom.wizard.js')}}"></script>


<!--/Scripts-->	
<script>
  $(document).ready(function() {
     
     //
     //se comento por los momentos script para subir la foto
     //
     

      $("#foto_user").click(function(el) {
        el.preventDefault();
        $('#botonFile').click();
        $('#botonFile').change(function(e) {
                    
                    var formData = new FormData($(".formulario")[0]);
                  
                   
                    var reader = new FileReader();
                    reader.onload = function (event) {

                        $.ajax({
                          url : '{{URL::route("foto.perfil")}}',
                          type : 'POST',
                          data: formData,
                          cache: false,
                          contentType: false,
                          processData: false,
                         
                          success: function(data){
                              console.log(data);
                              
                          }
                        });
                        $('#foto_user').attr('src',event.target.result);
                        $('#foto_panel').attr('src',event.target.result);
                    }
                    reader.readAsDataURL(e.target.files[0]);
      });

});
 });
</script> 

@stop