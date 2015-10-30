<?php setlocale(LC_TIME, 'es_ES.UTF-8');   ?>
@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Inicio 
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
			@include('dashboard.layouts.offcanvas_menu_admin')
			
		<!--Main Menu-->
			@include('dashboard.layouts.main_super_admin')
					
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
                <h2 id="titleSuggestion">Papelera</h2>
            </header>

              <div class="inner-spacer">
                                 
                <div class="mailinbox">
                  <div class="row">
                    <div class="col-md-1">
                      <div class="left-content">
                        <div class="list-group"> <a href='{{ URL::route("suggestions") }}' class="list-group-item"><i class="entypo-inbox"></i><b>Recibidos</b><span class="badge">{{ $count }}</span></a> <a href='{{ URL::route("suggestions.sent") }}' class="list-group-item "><i class="entypo-paper-plane"></i><b>Enviados</b></a> <a href='{{ URL::route("suggestions.trash") }}' class="list-group-item active"><i class="entypo-trash"></i><b>Papelera</b></a> </div>
                      </div>
                    </div>
                    <div class="col-md-11">
                      <div class="right-content clearfix">
                        <div class="big-icons-buttons clearfix margin-bottom"> <a class="btn btn-sm btn-default"><i class="fa fa-envelope"></i>Nuevo Mensaje</a>
                          <div class="btn-group btn-group-sm pull-right"> <a class="btn btn-default mark_read" id="read" ><i class="fa fa-check-circle-o"></i>Leído</a> <a class="btn btn-default mark_unread" id="unread" ><i class="fa fa-circle-o"></i>No Leído</a> <a class="btn btn-default delete" id="deleteSuggestion"><i class="fa fa-times-circle"></i> Eliminar</a> <a class="btn btn-default refresh" id="updateSuggestion"><i class="fa fa-refresh"></i> Actualizar</a> </div>
                        </div>
                        <div class="input-group margin-bottom">
                          <input type="text" class="form-control" id="text" placeholder="Buscar">
                          <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="buscar" >Buscar</button>
                          </span> </div>
                        <!-- /input-group -->
                        
                        <div class="table-relative table-responsive">
                          <table class="table table-condensed table-striped margin-0px panel-group" id="accordion">
                            <thead>
                              <tr>
                                <th><input id="all" type="checkbox" class="checkall" />
                                  <label for="all"></label></th>
                                <th colspan="2">Autor</th>
                                <th>Mensaje</th>
                                <th>status</th>
                                <th>Fecha</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if($suggestions->getTotal() == 0)
                              <tr>
                                <td colspan="6">No Hay registros</td>
                              </tr>
                              @endif
                              @foreach($suggestions as $suggestion)
                                  <?php
                                      $user= User::with('Data_users')->find($suggestion->user_id); 
                                      $contador++; 

                                   ?>
                                  <tr class="{{$suggestion->mark}}">
                                    <td><div class="user-image"><img alt="User" src="http://placehold.it/150x150"/>
                                        <input id="{{ $suggestion->id }}" type="checkbox" class="checkbox" name="check-row" />
                                        <label for="{{ $suggestion->id }}"></label>
                                      </div>
                                    </td>
                                    <td class="star"><a class="fa fa-flag flagged-grey"></a></td>
                                    <td><a href="#">{{  ucfirst($user->Data_users->name) }} {{  ucfirst($user->Data_users->last_name)}}</a></td>
                                    <td width="40%"><a href="#">{{ $suggestion->asunto }}</a></td>
                                    <td>{{ $suggestion->status }}</td>
                                    <td>{{strftime("%d/%b/%Y",strtotime($suggestion->created_at)) }}  {{strftime("%l:%m %p",strtotime($suggestion->created_at)) }} </td>
                                  </tr>
                              @endforeach
                            </tbody>
                          </table>
                          
                         
                        </div>
                        <div class="margin-top">
                        <div class="padding-15px pull-left"><small>Mostrando:  {{ $suggestions->getFrom()}} de {{ $suggestions->getTo()}}</small></div>
                          @if($suggestions->getTotal() > 10)
                              
                              <ul class="pagination pagination-sm pull-right margin-0px">
                                {{ $suggestions->links()}}
                              </ul>
                           @else
                              <ul class="pagination pagination-sm pull-right margin-0px">
                                  <li><a href="#">&laquo;</a></li>
                                  <li class="active"><a href="#">1</a></li>
                                 
                                  <li><a href="#">&raquo;</a></li>
                              </ul>
                          @endif 
                        
                        
                        
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
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery.uitablefilter/jquery.uitablefilter.js')}}"></script>

<!--/Scripts-->	
<script type="text/javascript">
    $(document).ready(function() {
        theTable = $("#accordion");

          $("#text").keyup(function() {
              
              if (this.value == '')
               {
                var a = $.uiTableFilter(theTable, '');
               };
                

            });
            $("#buscar").click(function() {
              
                var a = $.uiTableFilter(theTable, $("#text").val());

            });
       $("#titleSuggestion").html('Papelera');
    });

</script>
@stop
