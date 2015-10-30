@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Ingresos
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
				<li class="active">Ingresos</li>
				<li class="active" style="float:right">Bienvenido {{ $breadcrumbs_data }}</li>

			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
			 <h1>Ingresos<small>Cobrar</small></h1>

		</div>
	<!-- Widget Row Start grid -->
		<div class="row" id="powerwidgets">
          <div class="col-md-12  bootstrap-grid">
            <div class="powerwidget green" id="most-form-elements" data-widget-editbutton="false">
              <header>

              </header>
			  <div id="cPanel">
			  <div class="panel panel-success">


				<div class="inner-spacer">
					<!--
						Messages
					-->
						<div style="display:none;" class="callout callout-warning" id="msj"></div>

						@if(Session::has('msg'))
							<div class="callout callout-{{ Session::get('class') }}">
								<h4>{{ Session::get('msg')}}</h4>
							</div>
						@endif
						@foreach($errors->all() as $error)
							<div class="callout callout-danger">
								<h4>{{$error}}</h4>
							</div>
						@endforeach
					<!--

					-->

                {{ Form::open(['route'=>'income.charge.store','files'=>'true','class'=>'orb-form', 'id' => 'colonia-wizard', 'autocomplete' => 'off', 'onsubmit'=>' return validarData()']) }}
				  {{ Form::hidden('sub_account_id',$account,['id'=>'sub_account_id'])}}


                <fieldset>

                    <section class="col col-2">
						<label class="label">Monto</label>
						<label class="input"> <i class="icon-prepend fa fa-money"></i>
						  {{ Form::text('amount',Input::old('amount',$monthly_fee),['id'=>'ammount']) }}
						</label>
						<div class="note">Cuota Vigente: ${{$monthly_fee}}</div>
					</section>

					<section class="col col-6">
						<label class="label">Residente</label>
						<label class="label">
							<label class="input">
								<input type="text" placeholder="Escriba el nombre o seleccione el residente" id="neighbor_property_id" list="list" required>
									<datalist id="list">
										@foreach($neighbors as $neighbor)

										<?Php $tipoUrb = $neighbor->Urbanism->UrbanismType->id; ?>

										@if($tipoUrb == 3)
										    <option data-value="{{$neighbor->id}}" value="{{$neighbor->Neighbors->name}} {{$neighbor->Neighbors->last_name}} | {{ $neighbor->Building->description.' - Apartamento '. $neighbor->num_house_or_apartment }}">
										@else
											<option data-value="{{$neighbor->id}}" value="{{$neighbor->Neighbors->name}} {{$neighbor->Neighbors->last_name}} | {{ ' Calle '. $neighbor->Street->name .' - Casa '. $neighbor->num_house_or_apartment }}">
										@endif
										</option>

										@endforeach
									</datalist>
									<input type="hidden" name="valorid" id="valorid">
							</label>
						</label>
                    </section>

                    <section class="col col-4">
						  <label class="label">Comentarios</label>
						   <label class="textarea"> <i class="icon-prepend fa fa-comments"></i>
							{{ Form::textarea('coments','', ['size'=>'2x2', 'id'=>'coments']) }}

						  </label>
                     </section>


                </fieldset>

                <footer>


					 <a href="{{URL::route('config.colony.reg')}}"><button style="float:left;" type="button" class="btn btn-success">Registrar vecino</button></a>
					 <button style="float:right;" type="submit" class="btn btn-success">Recibir pago</button>
                </footer>


                {{ Form::close() }}
				<!-- /New widget -->
            <div id="pay_status">
    <!-- New widget -->
              </div>
            </div>
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
</div>
</div>

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
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.lang_es.js')}}"></script>


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
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/index/js/main.js')}}"></script>

<script type="text/javascript">


$(document).ready(function(){

	$("#neighbor_property_id").on("input",function(){

	var data = {};
	$("#list option").each(function(i,el) {
	   data[$(el).data("value")] = $(el).val();
	});
	// `data` : object of `data-value` : `value`
	console.log(data, $("#list option").val());

	 var value = $('#neighbor_property_id').val();
	 var datavalue = $('#list [value="' + value + '"]').data('value');

	 document.getElementById('valorid').value = datavalue;

	 var text = document.getElementById("neighbor_property_id"),
     element = document.getElementById("list");

		$("#pay_status").html("");
		if(element.querySelector("option[value='"+text.value+"']"))
		{
		   	$.ajax({
				url: "charge/MostrarEstadoCuenta",
				type:"POST",
				data:{
					id: $("#valorid").val(),
				},
				success: function(data) {
					$("#pay_status").html(data);
				}
			});
		}
	});

});

</script>

<!--/Scripts-->


@stop
