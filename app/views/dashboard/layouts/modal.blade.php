<!--scripts--> 
<!--Summernote--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/summernote/summernote.min.js')}}"></script>
 
<!--Forms--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.min.js')}}"></script>

<!--Main App--> 
<!--/scripts--> 

<!--Email Dialog Modal-->
<div class="modal" id="modalEmailDialog">
  <div class="modal-dialog modal-sm" style="width: 70%;" >
    <div class="modal-content">
      <div class="modal-header">
        <h3>Nuevo Mensaje </h3>
         </div>
      <div class="modal-body ">
        
       

          {{ Form::open(['route'=>'suggestion.save','files'=>'true', 'id'=>'emails', 'role' => 'from','class'=>'orb-form']) }}
                       
                   
             <div class="row">
                <div class="col col-6">
                    <label  class="label">
                      Para: <strong> Administrador de la Colonia</strong>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col col-6">
                  <label class="label">Asunto:</label>
                    <label class="select">
                    
                        {{ Form::select('asunto',[ '' => 'Seleccione','Inquietud' => 'Inquietud', 'Sugerencia' => 'Sugerencia', 'Queja' => 'Queja'], '',['id' => 'asunto']) }}
                            <i></i>
                    </label>
                </div>              
             </div>
                                                 
                  <div class="inbox-new-message">
                      
                
                     <div class="inbox-new-message">
                      <div id="summernote"></div>
                      </div>
           
                {{ Form::close() }}
        </div>
         
              
        
      </div>
      <div class="callout" style="display: none;"></div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="sendSuggestion">Enviar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!--Promo Dialog Modal-->
<div class="modal" id="modalPromoDialog">
  <div class="modal-dialog modal-sm" style="width: 50%;" >
    <div class="modal-content">
      <div class="modal-header">
	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Versión de prueba</h4>
         </div>
      <div class="modal-body ">
          {{ Form::open(['route'=>'promo.store','class'=>'orb-form', 'id'=>'promo-form']) }}                                        
        		<center>
												
				<fieldset>
				 <label  class="input" id="label_promo">
                    <input type="text" name="code"  placeholder="Ingrese código de promo enviado a su correo" id="promo"> 
                 </label>
				{{ Form::hidden('colony_id',Session::get('colonia'),['id'=>'colonia']) }}
				</fieldset>	
				</center>   
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="activar_promo">Activar promo</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
	 {{ Form::close() }}
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!--License Dialog Modal-->
<div class="modal" id="modalLicenceDialog">
  <div class="modal-dialog modal-sm" style="width: 50%;" >
    <div class="modal-content">
      <div class="modal-header">
	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Licencia</h4>
         </div>
      <div class="modal-body ">
        {{ Form::open(['route'=>'license.store','class'=>'orb-form', 'id'=>'license-form']) }}  
        		<center>
				@if(Session::get('lic_fecha_expiration') != 0)
				<label  class="input">Su licencia expira el: {{ date('d/M/Y',strtotime(Session::get('lic_fecha_expiration')))}} </label>
				@endif 
				<br>
				@if(Session::get('days_expiration') && Session::get('days_expiration') <= 7)
					Quedan pocos días para que se termine la versión de prueba, puede contactarse con el 
					EQUIPO DE HABITARIA para obtener una licencia o extender su período de prueba.
				@endif 
				@if( Session::get('lic_expiration') && Session::get('lic_expiration') <= 7)
					Quedan pocos días para que se termine su licencia, puede contactarse con el 
					EQUIPO DE HABITARIA para obtener otra clave y extender su licencia.					
				@endif					
				<fieldset>
				<br>			
				<label  class="input" id="label_license">
                    <input type="text" name="code"  placeholder="Ingrese código de licencia enviado a su correo" id="licence"> 
                 </label>
					{{ Form::hidden('colony_id',Session::get('colonia')) }}
				</fieldset>	
				</center>  
				
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="activar">Activar Licencia</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
	 {{ Form::close() }}
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!--Sign Out Dialog Modal-->
<div class="modal" id="signout">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">Está seguro que desea salir?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="yes" data-href="{{URL::to('users/logout')}}">Si</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 


<!--Power Widgets Modal-->
<div class="modal" id="delete-widget">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">
        <p>Esta seguro que desea eliminar el registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="trigger-deletewidget-reset">Cancelar</button>
        <button type="button" class="btn btn-primary" id="trigger-deletewidget">Eliminar</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

						
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

<script type="text/javascript">
 
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

	   // ========================================================================
        //  Email Modal
        // ======================================================================== 
        $("#modalEmail,#modalEmails").click(function (e) {
            e.preventDefault();
            $('#modalEmailDialog').modal();
            
        });
		
		    // ========================================================================
            //	Sign Out Modal
            // ========================================================================            

            $("#salir").click(function (e) {
                e.preventDefault();
                $('#signout').modal();
                $('#yes').click(function () {
                     window.location.href = $(this).data('href');
                    $('#signout').modal('hide');
                });

            });
		
		// ========================================================================
        //  Promo Modal
        // ======================================================================== 
        $("#modalPromo").click(function (e) {
            e.preventDefault();
            $('#modalPromoDialog').modal();
            
        });
		
	// ========================================================================
        //  Licence Modal
        // ======================================================================== 
        $("#modalLicence").click(function (e) {			
            e.preventDefault();
            $('#modalLicenceDialog').modal();
            
        });	

		 $("#modalLicence2").click(function (e) {			
            e.preventDefault();
            $('#modalLicenceDialog').modal();       
        });	
		
$(document).ready(function(){
	
			$('.modal').on('hidden.bs.modal', function(){
				$(this).find('form')[0].reset();
				var validator = $('#promo-form').validate();
				validator.resetForm();
				$('#label_promo').removeClass("state-success"); 
				$('#label_promo').removeClass("state-error"); 
				
				var validator2 = $('#license-form').validate();
				validator2.resetForm();
				$('#label_license').removeClass("state-success"); 
				$('#label_license').removeClass("state-error"); 
			});

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

		if ($('#license-form').length) {
            $("#license-form").validate({
                // Rules for form validation
                rules: {
                    code: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    code: {
                        required: 'Introduzca el código de la licencia suministrada'
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });

        }

    $("#sendSuggestion").click(function(e) {
          e.preventDefault();
          $('.note-codable').attr('name','correo');
          $('.note-codable').val($('.note-editable').html());
          
          if($('#asunto').val()){

            $.post('{{URL::route("suggestion.save")}}',
              { 

                bd_inbox    : 1,
                asunto      : $('#asunto').val(),
                contenido   : $('.note-editable').html(),
                tray        : 2,
                status      : 'No Leído',
                id_receptor : 0  
                
              },
              function(data) {
                    
                    $('.note-editable').html('');
                    $(".callout").removeClass("callout-warning");
                    if (data == 1) {
                       
                        $(".callout").addClass("callout-info"); 
                        $(".callout").html("<h4>Se ha enviado la sugerencia.</h4>");
                    }
                    if (data == 0) {
                        $(".callout").addClass("callout-warning");
                        $(".callout").html("<h4>¡Algo salió mal! Contacte con el administrador.</h4>");
                    };
                    
                    
                    
                    
                    $(".callout").css({"display":"block"});
                    $('#asunto').val('');
                                        
                    setTimeout(function() {
                    $(".callout").fadeOut(1600);
                    },3000);
                    
              });
            }else{

                    $(".callout").html("<h4>Debe especificar un asunto</h4>");
                    $(".callout").removeClass("callout-info");
                    $(".callout").addClass("callout-warning"); 
                    $(".callout").css({"display":"block"});
                    
                    setTimeout(function() {
                      $(".callout").fadeOut(1600);
                    },3000);
                    
            }
        
      });
});		
</script>