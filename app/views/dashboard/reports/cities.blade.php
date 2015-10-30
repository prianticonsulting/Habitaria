@extends ('dashboard.layouts.default')

@section ('titlePage')
  HABITARIA - PANEL | Reportes de ciudades-estados
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
        <li class="active">Reportes</li>
        <li class="active" style="float:right">Bienvenido {{$breadcrumbs_data}}</li>
        </ul>
      </div>
    <!--/Breadcrumb-->
    
    <div class="page-header">
       <h1>Reportes <small> ciudades estados</small></h1>      
    </div>
    

            <!-- /New widget --> 
        
    <!-- New widget -->
            <!-- Widget Row Start grid -->
        
            <!-- /New widget --> 

   <div class="row" id="powerwidgets">
          <div class="col-md-12  bootstrap-grid">
            <div class="powerwidget green"  data-widget-editbutton="false">
              <header></header>
               
              <div class="inner-spacer">
                  {{ Form::open(array('action' => 'ReportCitiesController@GeneraReporte')) }}
                  {{Form::select('estados', $estados);}}
                  {{ Form::submit('Generar', array('class' => 'btn btn-success'))}}
                  {{ Form::close() }}  
              </div>
            </div>
          </div>

          <!-- /Inner Row Col-md-12 --> 
    </div>        
            <!-- /New widget --> 
      <!-- New widget -->
           
            <!-- /New widget --> 

      <!-- New widget -->
            
            
            <!-- /New widget --> 

      <!-- New widget -->
            
            <!-- /New widget --> 
      
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

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/index/js/main.js')}}"></script>

<!--/Scripts--> 

@stop