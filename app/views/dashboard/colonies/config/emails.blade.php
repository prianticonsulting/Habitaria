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
				<li class="active">Enviar Emails a Vecinos</li>
				<li class="active" style="float:right">Bienvenido {{$usuario}} </li>
			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
          <h1>Enviar<small>Email</small></h1>
        </div>

        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">

            <!-- New widget -->
            <div class="powerwidget green" id="from-emails" data-widget-editbutton="false">
              <header>
                <strong>&nbsp;</strong>
              </header>
              <div class="inner-spacer">

					 <div style="display:none;"  class="callout callout-warning" id="alert"></div>

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
				{{ Form::open(['route'=>'config.colony.send.email','files'=>'true', 'id'=>'emails', 'role' => 'from','class'=>'orb-form']) }}
                {{ Form::hidden('urbanism_id',$urbanism) }}
				{{ Form::hidden('admin_colonia',$admin) }}


                       <div class="row">

		                      <div class="col col-4">
								<label class="label">Para:</label>
									<label class="select">
										 {{ Form::select('email', $correos,'Todos',['id' => 'country', 'class' => 'form-control', 'id' => 'email']) }}
										<i></i>
									</label>
							  </div>
					   </div><br>
					   <div class="row">
							  <div class="col col-11">
							  	<label class="label">Asunto:</label>
							  		<label class="input">
							  		{{Form::text('asunto', '', ['id' => 'asunto', 'placeholder' => 'Asunto'])}}


                      		  		</label>
                      		  </div>
                       </div>






                     <div class="inbox-new-message">
                      <div id="summernote2"></div>
                      </div>
						<br>
							<div class="page-header"></div><br>
                    		<br>
                    		<button style="float:right;" type="submit" class="btn btn-success" id="sendEmail">Enviar</button>


                {{ Form::close() }}


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



<script type="text/javascript">


</script>

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

<!--Summernote-->
<script type="text/javascript" src="{{asset('assets/js/vendors/summernote/summernote.min.js')}}"></script>

<!--Bootstrap-->
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat-->
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App-->
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!-- SCRIPT -->
<script  type="text/javascript" >

	$(document).ready(function () {

		$("#sendEmail").click(function(e) {
			e.preventDefault();
		$('.note-codable').attr('name','correo');
		$('.note-codable').val($('.note-editable').html());
		var $option = $('option:selected', $('#email')); // get selected option
  		var optGroup = $option.closest('optgroup').attr('label'); // get which optgroup

			if($('#asunto').val()){
				$.post('sendemails',
					{
						contenido  : $('.note-editable').html(),
						email      : $('#email').val(),
						asunto     : $('#asunto').val(),
						optGroup   : optGroup
					},
				  function(data) {
								$('.note-editable').html('');
								$(".callout").html("<h4>Email Enviado</h4>");
								$(".callout").addClass("callout-info");
								$("#alert").css({"display":"block"});
								$('#asunto').val('');
								$('#email > option[value="Todos"]').attr('selected', 'selected');

								setTimeout(function() {
								$("#alert").fadeOut(1600);
								},3000);
					});
				}else{
					$(".callout").html("<h4>Debe especificar un asunto</h4>");
					$(".callout").addClass("callout-warning");
					$("#alert").css({"display":"block"});

					setTimeout(function() {
						$("#alert").fadeOut(1600);
					},3000);
				}

			});

		$('#summernote2').summernote({
                height: 100,
                focus: false
            });

	});
</script>
@stop
