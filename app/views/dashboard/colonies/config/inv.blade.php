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
				<li class="active">Invitar Vecinos</li>
				<li class="active" style="float:right">Bienvenido {{	$usuario	}} </li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
          <h1>Invitar<small>Vecinos</small></h1>
        </div>
        
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
            <div class="powerwidget green" id="form-wizard" data-widget-editbutton="false">
              <header>
                <strong>&nbsp;</strong>
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
				{{ Form::open(['route'=>'config.colony.send.inv','files'=>'true','class'=>'orb-form', 'id'=>'emails-wizard']) }}
                {{ Form::hidden('urbanism_id',$urbanism_id) }} 
				{{ Form::hidden('admin_colonia',$admin) }} 
				  <div>
                    <fieldset>
                      <div class="row">
                        <section class="col col-6">
							<br><br>
							<label class="textarea"> 
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									{{ Form::textarea('correos','',['placeholder'=>'Ingrese E-mails de vecinos', 'id'=>'email_field','class'=>'form-control', 'size'=>'5x5']) }}
									<b class="tooltip tooltip-top-left">Ingrese máximo 10 correos electrónicos separados por renglon</b>
									<span class="input-group-addon">
										<button class="btn btn-success" type="button" onClick="addMail2()" id="add_mail">Agregar</button>
									</span>
								</div><!-- /input-group -->								
							</label>
							<div class="note" id="email_invalidos" style="color:#F78181"></div>
							<div class="note" id="email_inv" style="color:#F78181"></div>
							<label>
                            <input type="hidden" name="email" id="email2" required>
                            <i></i>
							</label>
                        </section>
                        <section class="col col-6">
							<div id="mail_area"></div>
                        </section>
                      </div>
                    </fieldset>
                     <footer>
                    		<button style="float:right;" type="submit" class="btn btn-success">Enviar</button>
                	 </footer>
                  </div>
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
<!--<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/select2-bootstrap.css')}}"></script>--> 
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

var correos = new Array();
							
	correos = <?php echo json_encode($invitations); ?>;

	expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 
var nume = 0; 

addMail2 = function () {
	
	var emails 			= document.getElementById("email_field").value;
	var emailArray		= emails.split("\n",10);	
	var invalidos = "";
	
	document.getElementById("email_field").value ='';
	
    var uniq = emailArray.reduce(function(a,b){
		if (a.indexOf(b) < 0 ) a.push(b);
		return a;
	},[]);

	var mail 		= "";
	
	uniq.forEach( function (mail)
	{	
			

				if ( expr.test(mail) ){

					document.getElementById("email2").value = 1;
					document.getElementById("email_invalidos").innerHTML='';
					
					document.getElementById("mail_area").style.display='block';
					
					var input  	= document.createElement("input");
					var button  = document.createElement("BUTTON");
					var t 		= document.createTextNode(mail);
					
					input.type	= 'hidden';
					input.name	= 'mails[]';
					input.value	= (mail); 
					input.id 	= 'mail' + (++nume);
					
					button.name		= 'invitation[]';
					button.className= 'btn btn-warning btn-xs';
					button.type		= 'button';
					button.style.paddingRight="25px";
					button.id 		= input.id;
					
					i 				= document.createElement('i');
					i.name			= button.id;
					i.style.cursor		= 'pointer';
					i.style.marginLeft	= '-3%';
					i.style.marginRight	= '1.5%';
					i.style.marginBottom= '2%';
					i.style.color	= '#FFFFFF';
					i.className		= 'fa fa-times-circle';
					i.onclick		= deleteMail;
					i.id			= button.id;

					button.appendChild(t);
					
					container = document.getElementById("mail_area");
					container.appendChild(button);
					container.appendChild(i);
					container.appendChild(input);
				
				}else{
					invalidos=invalidos+mail+"\n";
					document.getElementById("email_invalidos").innerHTML="Formato inválido";
				}
					
			
			if(invalidos){

				document.getElementById("email_field").value = invalidos.slice(0,-1);
			}
			 		   
	});
	
}

</script>



@stop
