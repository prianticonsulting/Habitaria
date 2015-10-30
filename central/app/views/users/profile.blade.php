@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Perfil del Usuario
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
			@include('dashboard.layouts.offcanvas_menu_admin')
		<!--Main Menu-->
			@include('dashboard.layouts.main_super_admin')
			
			<div class="content-wrapper"> 
        <!--Content Wrapper-->
			<!--Horisontal Dropdown-->
			@include('dashboard.layouts.horizontal_dropdown')
		<!--Breadcrumb-->
			<div class="breadcrumb clearfix">
			  <ul>
				<li><a href="{{URL::route('home')}}"><i class="fa fa-home"></i></a></li>
				<li class="active">Perfil del Usuario</li>
				<li class="active" style="float:right">Bienvenido {{$user->name}} {{$user->last_name}} </li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
          <h1>Perfil<small>Usuario</small></h1>
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
                    <div class="user-img">
                        {{ Form::open(array('url' => 'foto.perfil', 'files' => true, 'class' => 'formulario')) }}
                                    <label style="display:none;"> {{ Form::file('photo',['id' => 'botonFile']) }}</label>
                                    <img  id="foto_user" src="@if(!file_exists('uploads/users/avatars/'.Auth::user()->email) ){{'http://placehold.it/150x150'}}@else{{asset('uploads/users/avatars/'.Auth::user()->email)}} @endif" alt="User Picture" />
                        {{ Form::close() }} 
                    </div>
                    <h1>{{$user->name}} {{$user->last_name}}</h1>
					 </div>
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
                        <li><a href="#edit" data-toggle="tab">Actualizar</a></li>
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
                               <td><strong>Rol:</strong></td>
                              <td>{{$role}}</td>
                            </tr>
                            
                          </table>
                        </div>
                    
                        <div class="tab-pane in " id="edit">
                          <div class="profile-header">Actualizar datos</div>
							
							  <table class="table">
								{{ Form::open(['action'=>['UsersController@profile_update', $user->id],'files'=>'true']) }}
								<tr>
								  <td><strong>Email:</strong></td>
								  <td>{{ Form::email('email',Input::old('email',Auth::user()->email)) }}</td>
								</tr>
								<tr>
								   <td><strong>Rol:</strong></td>
								    <td>{{$role}}</td>
								</tr>
								{{ Form::close() }}
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

<!--Forms--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.maskedinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery-steps/jquery.steps.min.js')}}"></script>

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
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>

<!--Page Specific-->
<script type="text/javascript" src="{{asset('assets/js/script.custom.wizard.js')}}"></script>
<!--/Scripts-->	


<script>
  $(document).ready(function() {
      
      

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
                    }
                    reader.readAsDataURL(e.target.files[0]);
           

        
      });

});
 });
</script> 
@stop
