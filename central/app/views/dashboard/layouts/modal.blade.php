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
        <h3>Nuevo Mensaje</h3>
         </div>
      <div class="modal-body ">
        
       

          {{ Form::open(['route'=>'suggestion.save','files'=>'true', 'id'=>'emails', 'role' => 'from','class'=>'orb-form']) }}
                       
                   
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


<script type="text/javascript">
 
    

	   // ========================================================================
        //  Email Modal
        // ======================================================================== 
        $("#modalEmail,#modalEmails").click(function (e) {
            e.preventDefault();
            $('#modalEmailDialog').modal();
            
        });
		
		  

		
$(document).ready(function(){
	


    $("#sendSuggestion").click(function(e) {
          e.preventDefault();
          $('.note-codable').attr('name','correo');
          $('.note-codable').val($('.note-editable').html());
          
          if($('#asunto').val()){

            $.post('{{URL::route("suggestion.save")}}',
              { 

                bd_inbox    : 2,
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