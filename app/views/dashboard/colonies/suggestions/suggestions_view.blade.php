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
						<li><a href=""><i class="fa fa-home"></i></a></li>
						<li class="active">Inicio</li>
				<li class="active" style="float:right">Bienvenido {{ $nombre }}</li>
					  </ul>
					</div>
				 
				 <div class="page-header">
					 <h1>Sugerencias<small>habitaria</small></h1>
						
				 </div>
				 
				 
				
				
		<!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            <!-- New widget -->
            
            <div class="powerwidget green" id="mailinbox" data-widget-editbutton="false">
			<header>
                <h2>Sugerencias</h2>
            </header>

              <div class="inner-spacer">
                                 
                <div class="mailinbox">
                  <div class="row">
                    <div class="col-md-1">
                      <div class="left-content">
                        <div class="list-group"> <a href="{{URL::route('config.colony.suggestion')}}" class="list-group-item active"><i class="entypo-inbox"></i><b>Recibidos</b><span class="badge">{{ $count }}</span></a> <a href="{{URL::route('config.colony.suggestions.sent')}}" class="list-group-item"><i class="entypo-paper-plane"></i><b>Enviados</b></a> <a href="{{URL::route('config.colony.suggestions.trash')}}" class="list-group-item"><i class="entypo-trash"></i><b>Papelera</b></a> </div>
                      </div>
                    </div>
                    <div class="col-md-11">
                      <div class="right-content clearfix">
                        
                          <table class="table table-striped  margin-0px">
                                <thead>
                                        <tr>
                                          <th>De: Administrador del Sistema <br>   </th>
                                          <th>Asunto: <br> {{ $suggestions->asunto }}</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                          <td colspan="2">{{ $suggestions->contenido }}</td>
                                        </tr>
                 
                  
                                </tbody>
                          </table>
                        <br><br>
                          <table class="table table-striped  margin-0px">
                                <thead>
                                        <tr>
                                          <th>Responder</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                          <td>
                                                {{ Form::open(['files'=>'true', 'id'=>'emails', 'role' => 'from','class'=>'orb-form']) }}
                       
                   
                                                           <div >
                                                              <div >
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
                                                     
                                                          
                                                           </div>
                                                           <div class="page-header"></div><br>
                                                           <div class="callout" style="display: none;"></div>
                                                           <br>
                                                {{ Form::close() }}
                                                           <button style="float:right;" type="" class="btn btn-success" id="sendSuggestions">Enviar</button>
                                                
                                           </td>
                                        </tr>
                 
                  
                                </tbody>
                          </table>
                        

                        
                      </div>
                           

                    </div>


                  </div>
                  
  
                  </div>
                </div>
               
              </div>
            </div>
            <!-- End .powerwidget -->

				
				
				
				
			</div>
			<!--/Content--> 	  
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

<!--Summernote--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/summernote/summernote.min.js')}}"></script> 

<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!--/Scripts-->	
<script type="text/javascript" charset="utf-8" async defer>
  
$("#sendSuggestions").click(function(e) {
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
                id_receptor : {{ $suggestions->user_id }}  
                
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

</script>

@stop