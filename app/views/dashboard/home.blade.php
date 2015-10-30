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
        <li class="active" style="float:right">Bienvenido {{$Nombre}}</li>
			  </ul>
			</div>

		 <div class="page-header">
			 <h1>Habitaria<small> </small></h1>

		 </div>



		 <!-- Widget Row Start grid -->
			 <div class="powerwidget green" id="flotchart-widget-5" data-widget-editbutton="false">

 		  			  <header>
 		                  <strong>Vecinos | Status</strong>
 		                </header>
 		  			  <div></div>
 		          <div class="row">

 		  			<div class="col-md-6 col-sm-7 bootstrap-grid">
 		  			  <!-- New widget -->
 		  				<div class="powerwidget powerwidget-as-portlet powerwidget-as-portlet-blue" id="widget4" data-widget-editbutton="false">
 		  				  <header> </header>
 		  				  <div class="inner-spacer nopadding">
 		  					<div class="portlet-big-icon">
								<i class="fa fa-male"></i><i class="fa fa-female"></i>
							</div>

							<h4 class="text-center"><strong>{{$Total}}</strong></h4>

 		  						<ul class="portlet-bottom-block">
 		  						  <li class="col-md-12 col-sm-12 col-xs-12"><strong>Vecinos Registrados</strong></li>
 		  						</ul>
 		  				  </div>
 		  				</div>
 		              <!-- /New widget -->
 		  			</div>

 		  			<div class="col-md-6 col-sm-7 bootstrap-grid">
 		  			  <!-- New widget -->
 		  			   <div class="powerwidget powerwidget-as-portlet powerwidget-as-portlet-blue" id="widget2" data-widget-editbutton="false">
 		  				  <header> </header>
 		  				  <div class="inner-spacer nopadding">
 		  					<div class="portlet-big-icon">
								<i class="fa fa-money"></i>
							</div>

							<h4 class="text-center"><strong>${{number_format($monthly_fee,2,'.',',')}}</strong></h4>

 		  						<ul class="portlet-bottom-block">
 		  						  <li class="col-md-12 col-sm-12 col-xs-12"><strong>Cuota Vigente</strong></li>
 		  						</ul>
 		  				  </div>
 		  			   </div>
 		              <!-- /New widget -->
 		  			</div>

					<div class="col-md-6 col-sm-7 bootstrap-grid">
					<!-- New widget -->
					 <div class="powerwidget powerwidget-as-portlet powerwidget-as-portlet-blue" id="widget2" data-widget-editbutton="false">
						<header> </header>
						<div class="inner-spacer nopadding">
							<?php
								$porcentajeVecino = ($pagoMensual/$Total)*100;
								$porcentajeVecino = number_format($porcentajeVecino);
							?>

						  <div class="portlet-big-icon">
							  <i class="fa fa-child"></i>
							  <i class="fa fa-child"></i>
							  <i class="fa fa-child"></i>
							  <i class="fa fa-child"></i>
							  <i class="fa fa-child"></i>
							  <i class="fa fa-child"></i>
						  </div>

						<h4 class="text-center"><strong>{{$porcentajeVecino}}% ({{$pagoMensual}} de {{$Total}} vecinos)</strong></h4>

							  <ul class="portlet-bottom-block">
								<li class="col-md-12 col-sm-12 col-xs-12">
									<strong>Porcentaje de pago mensual</strong></li>
							  </ul>
						</div>
					 </div>
					<!-- /New widget -->
					</div>

					<div class="col-md-6 col-sm-7 bootstrap-grid">
					<!-- New widget -->
					 <div class="powerwidget powerwidget-as-portlet powerwidget-as-portlet-blue" id="widget2" data-widget-editbutton="false">
						<header> </header>
						<div class="inner-spacer nopadding">

							<?php

								 $montoMensual = $pagoMensual * $monthly_fee;
								 $MontoTotal 	 = $Total * $monthly_fee;


								 $datos = [
									 'monto_mensual' => $montoMensual,
									 'monto_total' => $MontoTotal,
								 ];

								 $porcentaje  = ($datos['monto_mensual']*100)/$datos['monto_total'];
								 $porcentaje = number_format($porcentaje);
							?>

						  <div class="portlet-big-icon">
							  <i class="fa entypo-chart-area"></i>
						  </div>

						  <h4 class="text-center"><strong>{{$porcentaje}}% (${{number_format($montoMensual,2,'.',',')}} de ${{number_format($MontoTotal,2,'.',',')}})</strong></h4>


							  <ul class="portlet-bottom-block">
								<li class="col-md-12 col-sm-12 col-xs-12">
									<strong>Porcentaje de pago $ mensual</strong>
								</li>
							  </ul>
						</div>
					 </div>
					<!-- /New widget -->
					</div>


 		  	 </div>

 		    </div>



        <div class="row" id="powerwidgets">
          <div class="col-md-6 bootstrap-grid">

            <!-- New widget -->
            <div class="powerwidget green" id="flotchart-widget1" data-widget-editbutton="false">

			  <header>
               <strong>Ingresos | Cobranzas </strong>
              </header>

			  <div class="inner-spacer">
                <div class="flotchart-container">
                  <div id="placeholder2" class="flotchart-placeholder"></div>
                </div>
              </div>
            </div>
            <!-- End Widget -->


          </div>

          <!-- /Inner Row Col-md-6 -->

          <div class="col-md-6 bootstrap-grid">



            <!-- New widget -->
            <div class="powerwidget green" id="flotchart-widget2" data-widget-editbutton="false">
              <header>
                <strong>Egresos | Gastos </strong>
              </header>
              <div class="inner-spacer">
				<!-- Messages-->
					@if ( Session::get('error') )
						<div class="callout callout-danger">
							<h4>{{ Session::get('error') }}</h4>
						</div>
					@endif

					@if ( Session::has('notice') )
						<div class="callout callout-info">
							<h4>{{ Session::get('notice') }}</h4>
						</div>
					@endif
				<!-- /Messages-->
                <div class="flotchart-container">
                  <div id="placeholder3" class="flotchart-placeholder"></div>
                </div>
              </div>
            </div>
            <!-- End Widget -->

          </div>



	<!-- Widget Row Start grid -->

          <div class="col-md-6 bootstrap-grid">



            <!-- New widget -->
            <div class="powerwidget green" id="flotchart-widget-3" data-widget-editbutton="false">
              <header>
                <strong>Ingresos | Cobranzas </strong>
              </header>
              <div class="inner-spacer">
                <div class="flotchart-container">
                  <div id="placeholder5" class="flotchart-placeholder"></div>
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
                <strong>Egresos | Gastos</strong>
              </header>
              <div class="inner-spacer">
                <div class="flotchart-container">
                  <div id="placeholder6" class="flotchart-placeholder"></div>
                </div>
              </div>
            </div>
            <!-- End Widget -->

          </div>
		</div>



			<!-- End Widget -->

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
	var Egre = [
            @foreach ($Egresos as $row)
                {{ '{ label: "'.$row->description.'", data: "'.$row->amount.'"},'}}
             @endforeach
        ];

	var Ingre = [
            @foreach ($Ingresos as $row)
                {{ '{ label: "'.$row->description.'", data: "'.$row->amount.'"},'}}
             @endforeach
        ];

	//Para Cuando no hay valores que mostrar en las graficas de torta
	if (Ingre.length == 0)
	{
		Ingre[0] = {label: "No hay Ingresos", data:0};
	}

	if (Egre.length == 0)
	{
		Egre[0] = {label: "No hay Egresos", data:0};
	}

	//Formando arreglos de mes y monto para las graficas de barras
	var $EgresosMensual = [
            @foreach ($EgresosMensual as $row)
                [{{'"'.$row->mes.'"'}},
             	{{$row->amount}}],
            @endforeach
        ];

	var $IngresosMensual = [
            @foreach ($IngresosMensual as $row)
                [{{'"'.$row->mes.'"'}},
             	{{$row->amount}}],
            @endforeach
        ];

	//Funcion para las graficas de Barras
    function DatosGraficas($arreglo) {
	  var meses = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];

	  var datos = [
                ["01", 0],
                ["02", 0],
                ["03", 0],
                ["04", 0],
                ["05", 0],
                ["06", 0],
                ["07", 0],
                ["08", 0],
                ["09", 0],
                ["10", 0],
                ["11", 0],
                ["12", 0]
            ];

		if ($arreglo.length == 0)
		{
			for (i = 0; i < datos.length; i++) {
				datos[i][0]= meses[i];
				}
		}


			for (i = 0; i < $arreglo.length; i++) {
				for (j = 0; j < datos.length; j++) {
         			if ($arreglo[i][0] == datos[j][0])
		 				{datos[j][1]=$arreglo[i][1];}
							datos[j][0]= meses[j];
		 		}
      		}

			return datos;
	  }

	DatosEgresos=DatosGraficas($EgresosMensual);
	DatosIngresos=DatosGraficas($IngresosMensual);


  $("#emailModal").click(function (e) {
            e.preventDefault();
            $('#modalEmail').modal();

        });

</script>

<!--Main App-->
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!--/Scripts-->

@stop
