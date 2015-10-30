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
				<li class="active">Ubicación de la Colonia</li>
				<li class="active" style="float:right">Bienvenido {{	$usuario	}}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
          <h1>Calles<small>Colonia</small></h1>
        </div>
        
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
            <div class="powerwidget green" id="form-wizard" data-widget-editbutton="false">
              <header>
                <strong></strong>
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

				{{ Form::open(['route'=>'config.colony.editubic','files'=>'true','class'=>'orb-form', 'id'=>'calles-wizard']) }}
                  <div>  
				  <h1></h1>								
                    <fieldset class="step-1">
						<div class="row">
						<section class="col col-6">
							<header>Agregar {{ $piso_calle }} a la colonia</header><br>
							<label class="input"> 
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
									{{ Form::text('location','',['placeholder'=>'Ubicación (nombre calle o piso)', 'id'=>'street_field','class'=>'form-control']) }}
									<span class="input-group-btn">
										<button class="btn btn-success" type="button" onClick="addStreet2()">Agregar</button>
									</span>
								</div><!-- /input-group -->
							</label>
							<label>
                            <input type="hidden" name="location2" id="location2" required>
                            <i></i>
							</label>
                        </section> 
						
						<!-- /Street Section --> 
						<section class="col col-6">
											<div class="powerwidget" id="table2" data-widget-editbutton="false" style="display:none;">
											  <div class="inner-spacer" id="street_table2">
												<table class="table table-condensed table-bordered margin-0px">
												  <thead>
													<tr>
													  <th>{{ $piso_calle }} para añadir a la Colonia</th>
													</tr>
												  </thead>
												  <tbody id="streets">												  
												  </tbody>
												</table>
											  </div>
											</div>
							<!-- /Street Section --> 
                        </section> 
					  </div> 
					<footer>
                    <button style="float:right;" type="submit" class="btn btn-success">Guardar</button>
					</footer>						
                      
                    </fieldset>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
            <!-- End .powerwidget --> 
            
          </div>
		
		</div> 
		
	   <!-- New widget -->
         @if($catalog) 
			
		<div class="row" id="powerwidgets">
          <div class="col-md-6 bootstrap-grid"> 
            <!-- New widget -->
            
            <div class="powerwidget green" data-widget-editbutton="false">
				<header>
                <h2>{{ $piso_calle }} de la colonia<small></small></h2>
				</header>
		
						<div class="inner-spacer">							 

							<table class="table table-condensed table-bordered margin-0px" id="calles">
							  <thead>
								<tr>
								
								  <th>{{ $piso_calle }}</th> 
								  
								</tr>
							  </thead>
							  <tbody>
								 <?php 
								 $edit_route="edit/catalog_building"; 
								 $name="description";
 
								 if($piso_calle == "Calles") {
									$edit_route="edit/catalog_streets";  
									$name="name";
									}
									?>
									
							  @foreach($catalog as $cata)
								<tr> 
								 <td>
								 <span id="nedit{{ $cata->id }}">{{ $cata->$name }}</span>
								  <span id="edit{{ $cata->id }}" style="display:none">
								  <a href="#" class="xedit" data-pk="{{ $cata->id }}" data-placement="right" data-placeholder="Nombre de calle o piso">{{ $cata->$name }}</a> 
								  </span>
								  <i class="icon fa fa-edit" style="float:right; cursor:pointer" onclick="editar({{ $cata->id }})"></i>
								  </td>					
								</tr>
								@endforeach									
								</tbody>
							</table>
						
						</div>
				</div>
			 </section> 		
			</div>
			</div> 
			@endif	
			
	</div>
			 	  

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

 <script type="text/javascript">
  $(document).ready(function () {
	
	var nume = 0;
	var n = 0;
	
  addStreet2 = function () { 
	
	var street = document.getElementById("street_field").value;
	
	if(isNaN(street)) {
		document.getElementById("table2").style.display='inline';
		document.getElementById("location2").value= ++n;
		document.getElementById("street_field").value = " ";

		var input  	= document.createElement("input");
		var tr  	= document.createElement("TR");
		var td  	= document.createElement("TD");
		var t 		= document.createTextNode(street);
		
		
		input.type	= 'hidden';
		input.name	= 'streets[]';
		input.value	= (street);
		input.id 	= 'street' + (++nume);
		
		
		td.style.fontWeight = "600";
		td.name		= 'names[]';
		
		tr.className= 'text-info';
		tr.id 		= input.id;
		
		a 			= document.createElement('i');
		a.name		= tr.id;
		a.style.float	= 'right';
		a.style.cursor	= 'pointer';
		a.className		= 'icon fa fa-trash-o';
		a.onclick		= deleteStreet2;
		
		tr.appendChild(td);
		td.appendChild(t);
		td.appendChild(a);


	   container = document.getElementById('streets');
	   container.appendChild(tr);
	   container.appendChild(input);
		
	}

}

deleteStreet2= function (evt){
   
   evt = evento(evt);
   
   td = rObj(evt);
   td_field = document.getElementById(td.name);
   td_field.parentNode.removeChild(td_field); 
   
   input = rObj(evt);
   input_field = document.getElementById(input.name);
   input_field.parentNode.removeChild(input_field); 
   
   document.getElementById("location2").value= --n;
	
	if(n == 0) {
	  document.getElementById("location2").value= " ";
	  document.getElementById("table2").style.display='none';
	}
}
  
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
        url:'{{ url($edit_route)}}',  
        title: 'Calle o piso',
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
</script>

@stop
