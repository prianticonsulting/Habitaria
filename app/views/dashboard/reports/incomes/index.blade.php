@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - DASHBOARD | Pagos
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
				<li class="active">Reportes</li>
				<li class="active" style="float:right">Bienvenido {{ $breadcrumbs_data }}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		<div class="page-header">
			 <h1>Reportes<small>Ingresos</small></h1>

		</div>
	<div class="row" id="powerwidgets">
	 <div class="col-md-12  bootstrap-grid">
	   <div class="powerwidget green"  data-widget-editbutton="false">
		 <header></header>

		 <div class="inner-spacer">
		 <div style="display:none;" class="callout callout-warning" id="msj"></div>
		   {{ Form::open(['url' => 'dashboard/reports/generate-pdf-incomes', 'class' => 'orb-form','id' => 'data-pickers']) }}

				 <label for="">Generar Reporte</label>
				 <fieldset>
							<?php

                              $firstDayUTS = mktime(0, 0, 0, date("m"), 1, date("Y"));
                              $lastDayUTS  = mktime(0, 0, 0, date("m"), date('t'), date("Y"));

                              $firstDay = date("d-m-Y", $firstDayUTS);
                              $lastDay  = date("d-m-Y", $lastDayUTS);

                          	?>
						 <div class="row">
						   <section class="col col-4">
						   <label class="label">Desde</label>
							 <label class="input"> <i class="icon-append fa fa-calendar"></i>
							   <input type="text" name="desde" id="desde" autocomplete="off" placeholder="Desde" value="{{$firstDay}}">
							 </label>
						   </section>
						   <section class="col col-4">
							 <label class="label">Hasta</label>
							 <label class="input"> <i class="icon-append fa fa-calendar"></i>
							   <input type="text" name="hasta" id="hasta" autocomplete="off" placeholder="Hasta" value="{{$lastDay}}">
							 </label>
						   </section>
						   <section class="col col-4" >
						   	 <label class="label">Residente</label>
						   	 <label class="label" >
						   	 	<label id="residente" class="input">
						   	 		<input type="text" autofocus="on" placeholder="Escriba el nombre o seleccione el residente" id="property_id" list="list" autocomplete="off" required>
						   	 		<datalist  id="list">

										 <option data-value="Todos" value="TODOS"> </option>


										@foreach($neighbors as $neighbor)

										<?Php $tipoUrb = $neighbor->Urbanism->UrbanismType->id; ?>

												@if($tipoUrb == 3)
												    <option data-value="{{$neighbor->id}}" value="{{$neighbor->Neighbors->name}} {{$neighbor->Neighbors->last_name}} | {{ $neighbor->Building->description.' - Apartamento '. $neighbor->num_house_or_apartment }}"></option>
												@else
													<option data-value="{{$neighbor->id}}" value="{{$neighbor->Neighbors->name}} {{$neighbor->Neighbors->last_name}} | {{ ' Calle '. $neighbor->Street->name .' - Casa '. $neighbor->num_house_or_apartment }}"></option>
												@endif


										@endforeach

									</datalist>
									{{ Form::hidden('neighbor_property_id','', ['id' => 'neighbor_property_id']) }}
						   	 	</label>
						   	 </label>
						   </section>
						 </div>
						 <div class="row">
						   <section class="col col-2">
							 <label  class="input">
								<button type="submit" id="btnReport" class="btn btn-default">Generar Reporte</button>
							 </label>
						   </section>

						 </div>
				 </fieldset>
		   </form>
		   <br><br>

		   <div id="tablaReporte" class="col-md-12 table-responsive"></div>

		</div>
	   </div>
	 </div>




	 <!-- /Inner Row Col-md-12 -->
</div>
<!-- /Widgets Row End Grid-->

<!-- New widget -->

	   <!-- /New widget -->
 <!-- New widget -->

	   <!-- /New widget -->

 <!-- New widget -->


	   <!-- /New widget -->

 <!-- New widget -->

	   <!-- /New widget -->

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
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.lang_es.js')}}"></script>
<!--Main App-->
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>

<!--/Scripts-->

<script>

// Date range
        if ($('#desde').length) {
            $('#desde').datepicker({
                dateFormat: 'dd-mm-yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#hasta').datepicker('option', 'minDate', selectedDate);
                },
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá']
            });
        }
        if ($('#hasta').length) {
            $('#hasta').datepicker({
                dateFormat: 'dd-mm-yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#desde').datepicker('option', 'maxDate', selectedDate);
                },
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá']
            });
        }



$(document).ready(function(){

	$("#property_id").on("input",function(){
		var data = {};
		$("#list option").each(function(i,el) {
	   		data[$(el).data("value")] = $(el).val();
		});
		//console.log(data);
		// `data` : object of `data-value` : `value`

		var value = $('#property_id').val();
	 	var datavalue = $('#list [value="' + value + '"]').data('value');

	 	$('#neighbor_property_id').val(datavalue);
	});


	$("#btnReport").click(function(e) {
      e.preventDefault();

      var len = $("#property_id").val();
      if (len == '') {
      					$("#msj").addClass("callout-warning");
						$("#msj").html("<h4>Debe seleccionar un Residente de la lista</h4>");
						$("#msj").css({"display":"block"})
						setTimeout(function() {
						$("#msj").fadeOut(2000);
						},3000);
						$("#property_id").focus();
      					return false;
      				 };
      $.post('{{URL::route("ajax-generate-incomes")}}',
        {
          desde : $("#desde").val(),
          hasta : $("#hasta").val(),
          neighbor_property_id : $("#neighbor_property_id").val()
        },
        function(data) {
            $("#tablaReporte").html(data);
        });

    });
});
</script>

@stop
