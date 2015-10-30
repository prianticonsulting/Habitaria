@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Configuración de Colonia
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
				<li class="active">Categoria Egresos</li>
				<li class="active" style="float:right">Bienvenido {{$usuario}} </li>
			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
          <h1>Categoria<small>Egresos</small></h1>
        </div>

        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">

            <!-- New widget -->
					<div class="powerwidget green" id="form-wizard" data-widget-editbutton="false">
					  <header>
						<strong>Crear Categoria </strong>
					  </header>
					  <div class="inner-spacer">
						<!--Messages-->
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
						<!--/Messages-->
						{{ Form::open(['route'=>'expenses.catalog.store','files'=>'true','class'=>'orb-form', 'id'=>'form_categoria', 'onsubmit'=>'return checkSubmit()']) }}
						  <div>
							<fieldset class="step-1">
							  <div class="row">
								<section class="col col-6">
									<header>Definir Nueva Categoria de Egresos</header><br>
								</section>
								</div>
								<div class="row">
								<section class="col col-4">
								  <label class="input">
										<i class="icon-append fa fa-asterisk"></i>
											{{ Form::text('categoria','',['placeholder'=>'Ingrese Categoria','class'=>'form-control']) }}
											{{ Form::hidden('urbanism',$urbanism_id) }}
								  </label>
								</section>
							  </div>
							</fieldset>
							<footer>
							<button style="float:right;" type="submit" class="btn btn-success" id="boton_submit">Guardar</button>
						   </footer>
						  </div>

						{{ Form::close() }}
						 </div>


					</div><!-- End .powerwidget -->

		   </div><!-- /Inner Row Col-md-12 -->

	   <!-- New widget -->

		  <div class="col-md-6 bootstrap-grid">

            <!-- New widget -->
            <div class="powerwidget green" id="nestable-intro" data-widget-editbutton="false">
              <header>
                <strong>Categorias Egresos</strong>
              </header>
              <div class="inner-spacer">

				<div class="row">
						 <div class="inner-spacer">
							 <div class="table-responsive">
								 <table class="table table-striped table-hover margin-0px">
 									<thead>
 										<tr>
 											<th>Categoria</th>
 											<th width="25">Opciones</th>
 										</tr>
 									</thead>
 									<tbody>
 									@foreach($catalog as $cata)
 									<tr>
 									 <td>
 									 <span id="nedit{{ $cata->id }}">{{ $cata->description }}</span>
 									  <span id="edit{{ $cata->id }}" style="display:none">
 									  <a href="#" class="xedit" data-pk="{{ $cata->id }}" data-placement="right" data-placeholder="Nombre de la categoria">{{ $cata->description }}</a>
 									  </span>
 									  </td>
 									  <td>
 									  <center>
 										<div class="control-buttons info">

 										<a onclick="editar({{ $cata->id }})" title="Editar"><i class="icon fa fa-edit"></i></a>

 										<a href="{{URL::action('IncomesController@delete_catalog',$cata->id)}}" title="Eliminar">
 											<i class="icon fa fa-trash-o"></i>
 										</a>

 										</div>
 										</center>
 									  </td>
 									</tr>
 									@endforeach
 									</tbody>
 								</table>
							 </div>


					</div>
				</div>
              </div>
            </div>

			  </div>
            </div>
            <!-- /New widget -->

          </div>


		</div><!-- /powerwidgets -->

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


<script type="text/javascript">
  $(document).ready(function () {
 	$.fn.editableform.buttons =
		'<button type="submit" class="btn btn-success  btn-sm"><i class="icon fa fa-check"></i></button>' +
		'<button type="button" class="btn editable-cancel  btn-sm"><i class="icon fa entypo-cancel"></i></button>';

	 $.fn.editable.defaults.mode = 'popup';

        $('.xedit').editable({
            validate: function(value) {
                if($.trim(value) == '')
                    return 'Se requiere un valor';
        },
        type: 'text',
        url:'{{ url("expenses/catalog/edit")}}',
        title: 'Nombre de la categoria',
        placement: 'top',
        send:'always',
        ajaxOptions: {
        dataType: 'json'
        },
		success: function(response, newValue) {
			$("#nedit"+response.id).html(newValue);
			$("#nedit"+response.id).show();
			$("#edit"+response.id).hide();
		}
     })

 })

 function editar(id){
	  $("#nedit"+id).hide();
	  $("#edit"+id).show();
 }

function checkSubmit() {
    document.getElementById("boton_submit").value = "Enviando...";
    document.getElementById("boton_submit").disabled = true;
    return true;
}
</script>

@stop
