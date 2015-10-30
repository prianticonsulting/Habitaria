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
                <h2>Sugerencias</h2>
            </header>

              <div class="inner-spacer">
                                 
                <div class="mailinbox">
                  <div class="row">
                    <div class="col-md-1">
                      <div class="left-content">
                        <div class="list-group"> <a href='{{ URL::route("suggestions") }}' class="list-group-item active"><i class="entypo-inbox"></i><b>Recibidos</b><span class="badge">{{ $count }}</span></a> <a href='{{ URL::route("suggestions.sent") }}' class="list-group-item"><i class="entypo-paper-plane"></i><b>Enviados</b></a> <a href='{{ URL::route("suggestions.trash") }}' class="list-group-item"><i class="entypo-trash"></i><b>Papelera</b></a> </div>
                      </div>
                    </div>
                    <div class="col-md-11">
                      <div class="right-content clearfix">
                        <div class="big-icons-buttons clearfix margin-bottom"> <a id="modalEmails" class="btn btn-sm btn-default"><i class="fa fa-envelope"></i>Nuevo Mensaje</a>
                          <div class="btn-group btn-group-sm pull-right"> <a class="btn btn-default mark_read" id="read"><i class="fa fa-check-circle-o"></i>Leído</a> <a class="btn btn-default mark_unread" id="unread"><i class="fa fa-circle-o"></i>No Leído</a> <a class="btn btn-default delete"><i class="fa fa-times-circle"></i> Eliminar</a> <a class="btn btn-default refresh"><i class="fa fa-refresh"></i> Actualizar</a> </div>
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
                              @if(!$suggestions)
                                <tr>
                                  <td colspan="6">No Hay registros</td>
                                </tr>
                              @endif
                              @foreach($suggestions as $suggestion)
                                  <?php
                                      $neighbors= DB::connection('habitaria_dev')->table("neighbors")
                                                                            ->join('neighbors_properties', 'neighbors.id', '=', 'neighbors_properties.neighbors_id')
                                                                            ->join('urbanisms', 'neighbors_properties.urbanism_id', '=', 'urbanisms.id')
                                                                            ->select('neighbors.name as name', 'neighbors.last_name', 'urbanisms.name as urbanisms')
                                                                            ->where('user_id','=',$suggestion->user_id)->first();   
                                      $contador++;      
                                   ?>
                                  <tr class="{{$suggestion->mark}}">
                                    <td><div class="user-image"><img alt="User" src="http://placehold.it/150x150"/>
                                        <input id="{{ $suggestion->id }}" type="checkbox" class="checkbox" name="check-row" />
                                        <label for="{{ $suggestion->id }}"></label>
                                      </div>
                                    </td>
                                    <td class="star"><a class="fa fa-flag flagged-grey"></a></td>
                                    <td><a href="{{ URL::route('suggestions.view',$suggestion->id_mensaje) }}">{{ $neighbors->name }} {{ $neighbors->last_name}}</a> <small><a href="{{ URL::route('suggestions.view',$suggestion->id_mensaje) }}">{{ $neighbors->urbanisms }}</a></small></td>
                                    <td width="40%"><a href="{{ URL::route('suggestions.view',$suggestion->id_mensaje) }}">{{ $suggestion->asunto }}</a></td>
                                    <td>{{ $suggestion->status }} </td>
                                    <td>{{strftime("%d/%b/%Y",strtotime($suggestion->created_at)) }}  {{strftime("%l:%m %p",strtotime($suggestion->created_at)) }} </td>
                                  </tr>
                              @endforeach
                            </tbody>
                          </table>
                          
                        </div>
                        <div class="margin-top">
                      <ul class="pagination pagination-sm pull-right margin-0px">
                                {{ $suggestions->links()}}
                          </ul>
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

<!--/Scripts--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery.uitablefilter/jquery.uitablefilter.js')}}"></script>

<script type="text/javascript">
  
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

</script>

@stop
