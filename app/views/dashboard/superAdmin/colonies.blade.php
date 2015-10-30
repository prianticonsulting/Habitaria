@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Inicio 
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
						<li><a href=""><i class="fa fa-home"></i></a></li>
						<li class="active">Inicio</li>
				<li class="active" style="float:right">Bienvenido {{ $nombre }}</li>
					  </ul>
					</div>
				 
				 <div class="page-header">
					 <h1>Colonias<small>inactivas</small></h1>
					 
				 </div>
				
				
		<!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-6 bootstrap-grid"> 
            <!-- New widget -->
            
            <div class="powerwidget cold-grey" id="table1" data-widget-editbutton="false">
              <header>
                <h2>Colonias<small>Lista de Inactivas</small></h2>
              </header>
              <div class="inner-spacer">
                <table class="table table-striped table-hover margin-0px">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Administrador</th>
                      <th>Creación</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Los alpes</td>
                      <td>Pedro Fermin</td>
                      <td>10/07/2015</td>
                      <td><button type="button" class="btn btn-success btn-xs" onclick="location.href='{{URL::route('admin.promo')}}?colony=1'">Generar promoción</button></td>
                    </tr>
                    <tr>
                      <td>Brisas</td>
                      <td>Luisa Mendez</td>
                      <td>11/07/2015</td>
                      <td><button type="button" class="btn btn-success btn-xs" onclick="location.href='{{URL::route('admin.promo')}}?colony=2'">Generar promoción</button></td>
                    </tr>                  
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End .powerwidget --> 

				
				
				
				
			</div>
			<!--/Content--> 	  
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

<!--Datatables--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/jquery.dataTables-bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/dataTables.colVis.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/colvis.extras.js')}}"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>


<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!--/Scripts-->	

@stop
