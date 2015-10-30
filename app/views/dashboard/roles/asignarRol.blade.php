@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Asignar rol
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
				<li class="active">Inicio</li>
        <li class="active" style="float:right">Bienvenido {{$breadcrumbs_data}}</li>
			  </ul>
			</div>
		 
		 <div class="page-header">
			 <h1>Seguridad<small>Asignar</small></h1>
			 
		 </div>


  <div class="row" id="powerwidgets">
          <div class="col-md-12  bootstrap-grid">
            <div class="powerwidget green"  data-widget-editbutton="false">
              <header><strong>Agregar Nuevo Rol</strong></header>
               
              <div class="inner-spacer">
                      @if(count($users) > 0)
                        <table class="table table-bordered">
                                          <tr>
                                            <th>Usuario </th>
                                            <th>Rol</th>
                                          </tr>
                                          @foreach($users as $user)
                                          @if($user['role_id'] != 1)
                                          <tr>
                                               <td>{{$user['email']}}</td>
                                               <td>
                                                  <select name="" class="asignarRol">
                                                    <option value="{{$user['role_id'].'.'.$user['user_id'].'.'.$user['urbanism_id']}}" >{{$user['name']}}</option>
                                                    @foreach($roles as $rol) 
                                                      @if($rol['name'] != $user['name'])
                                                        <option value="{{$rol['id'].'.'.$user['user_id'].'.'.$user['urbanism_id']}}">{{$rol['name']}}</option>
                                                      @endif
                                                    @endforeach
                                                  </select>
                                               </td>
                                             </tr>
                                             @endif
                                             @endforeach
                                        </table>
                            @else
                                            <div style="display:none;" class="callout callout-warning" id="msj"></div>
                                              No hay usuarios registrados 
                                            </div>
                           @endif
                                        <div class="page-header"></div>
                                        <div style="display:none;" class="callout callout-warning" id="msj"></div>
                                        <button style="float:right;" id="botonAsignarRol" class="btn btn-success">Guardar cambios</button>
              </div>
            </div>
          </div>

          <!-- /Inner Row Col-md-12 --> 
    </div>
    <!-- /Widgets Row End Grid--> 

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

<!--Datatables--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/jquery.dataTables-bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/dataTables.colVis.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/colvis.extras.js')}}"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>

<!--FlotChart--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.stack.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.categories.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.time.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.resize.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.axislabels.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot-tooltip.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.pie.min.js')}}"></script>

<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/index/js/main.js')}}"></script>
<!--/Scripts-->	

@stop
