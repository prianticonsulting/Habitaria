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
				 
	  <!--Jumbotron-->
      <div class="jumbotron jumbotron6">
        <h1>Bienvenido <strong>Central Habitaria</strong></h1>
        <p class="lead">Administración &#8212; Sitio creado para gestionar todo lo relacionado con Habitaria, interactuar con los usuarios de las diferentes
		colonias, llevar el control de promociones y licencias, además de visualizar alcances a nivel financiero. </p>
        <small>Sólo tendrán acceso los usuarios con rol SuperAdministrador</small>
        <p><a href="http://habitaria.mx/dev/public/" class="btn margin-top btn-warning"><i class="fa fa-leaf"></i> Ir a Habitaria</a></p>
      </div>
      <!--/Jumbotron--> 
			
	<div class="row" id="powerwidgets">
	<!-- Widget Row Start grid -->

          <div class="col-md-6 bootstrap-grid"> 
            
            <!-- New widget -->
            <div class="powerwidget green" id="flotchart-widget-3" data-widget-editbutton="false">
              <header>
                <strong>Tipos | Tickets de Soporte </strong>
              </header>
              <div class="inner-spacer">
                <div class="flotchart-container">
                  <div id="place1" class="flotchart-placeholder"></div>
                </div>
              </div>
            </div>
            <!-- End Widget --> 
            
          </div>
          
          <!-- /Inner Row Col-md-6 -->
          
          <div class="col-md-6 bootstrap-grid"> 
            
            <!-- New widget -->
            <div class="powerwidget green" id="flotchart-widget-4" data-widget-editbutton="false">
              <header>
                <strong>Status | Tickets de Soporte</strong>
              </header>
              <div class="inner-spacer">
                <div class="flotchart-container">
                  <div id="place2" class="flotchart-placeholder"></div>
                </div>
              </div>
            </div>
            <!-- End Widget --> 
            
          </div>
		</div>
		</div>		
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

<!--Graficas-->
<script type="text/javascript">
	//Formando arreglos para graficas de torta con label y data
	var Status = [
            @foreach ($Status as $row)
                {{ '{ label: "'.$row->status.' '.$row->cantidad.'", data: "'.$row->cantidad.'"},'}}
             @endforeach
        ];
		
	var Asunto = [
            @foreach ($Asunto as $row)
                {{ '{ label: "'.$row->asunto.' '.$row->cantidad.'", data: "'.$row->cantidad.'"},'}}
             @endforeach
        ]; 

		
	//Para Cuando no hay valores que mostrar en las graficas de torta
	if (Status.length == 0)
	{
		Status[0] = {label: "Aún no hay tickets de soporte", data:0};
	}
	
	if (Asunto.length == 0)
	{
		Asunto[0] = {label: "Aún no hay tickets de soporte", data:0};
	}

</script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>

<!--/Scripts-->	

@stop
