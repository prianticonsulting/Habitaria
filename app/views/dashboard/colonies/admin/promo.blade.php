@extends ('dashboard.layouts.users')

@section ('titlePage')
	HABITARIA | Promo
@stop

{{-- Content --}}
@section ('pageContent')

<div class="colorful-page-wrapper">

  <div class="center-block">
    <div class="login-block" >
	 <div class="powerwidget-ctrls"> <a href="{{URL::route('logout')}}" class="button-icon powerwidget-delete-btn"><h2><small><i class="icon fa entypo-cancel"></i></small></h2></a></div>
		{{ Form::open(['route'=>'promo.store','class'=>'orb-form', 'id'=>'promo-form']) }}
			<center>
			        <header>
          <div class="image-block"><img src="{{asset('assets/index/images/ui-sam.png')}}" alt="User" /></div>
          Colonia {{Colony::where('id','=',Session::get('colonia'))->pluck('name')}}<small class="text-success"  style="font-weight:bold; font-size:14px;">Su periodo de prueba ha culminado</small>
		</header>
				<fieldset>
				<section>
				<center>
						Para obtener mas días de prueba			
					</center>				
				</section>
				<label class="input">
					{{ Form::text('code','',['placeholder'=>'Ingrese código de promo']) }}
					{{ Form::hidden('colony_id',Session::get('colonia')) }}
                 </label>
				</fieldset>	
				</center>
				
				<fieldset>
                    <a href="{{URL::route('active.license')}}"><button type="button" class="btn btn-default pull-left">Licencia</button></a>
					<button type="submit" class="btn btn-default send_forgot">Activar Promo</button>
                </fieldset>

			</div>
			</center>
		 {{ Form::close() }}
    </div>
</div>
</div>

<div class="modal" id="modal_msg">
  <div class="modal-dialog modal-sm" style="width: 50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <span class="text-dark-blue"> Leer por favor </span>
      <div class="modal-body text-center">
				<div class="callout callout-info">
							<h4>{{ Session::get('notice_modal')}}</h4>
						</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
</div>
	 
<div class="modal" id="modal_error">
  <div class="modal-dialog modal-sm" style="width: 50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <span class="text-dark-red"> Leer por favor </span>
      <div class="modal-body text-center">
				<div class="callout callout-danger">
							<h4>{{ Session::get('error_modal')}}</h4>
						</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>	
</div>	


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


<!--ToDo--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Knob--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/knob/jquery.knob.js')}}"></script>

<!--Page Specific-->
<script type="text/javascript" src="{{asset('assets/js/script.custom.wizard.js')}}"></script>

<!--/Scripts-->		
<script type="text/javascript" >

@if(Session::has('notice_modal'))		
	window.onload = function() {
	$('#modal_msg').modal();
	};
	@endif
	
	@if(Session::has('error_modal'))		
		window.onload = function() {
		$('#modal_error').modal();
		};
	@endif	   
	
        if ($('#promo-form').length) {
            $("#promo-form").validate({
                // Rules for form validation
                rules: {
                    code: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    code: {
                        required: 'Introduzca el código de la promo'
                    }
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });

        }
</script>
		
@stop