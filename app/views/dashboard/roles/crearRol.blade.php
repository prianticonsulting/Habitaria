@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Crear rol
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
				<li class="active">Roles</li>
        <li class="active" style="float:right">Bienvenido {{$breadcrumbs_data}}</li>
			  </ul>
			</div>

		 <div class="page-header">
			 <h1>Seguridad<small>Roles</small></h1>

		 </div>


     <!-- Widget Row Start grid -->
    <div class="row" id="powerwidgets">
          <div class="col-md-12  bootstrap-grid">
            <div class="powerwidget green" id="most-form-elements" data-widget-editbutton="false">
              <header><strong>Agregar Nuevo Rol</strong></header>

              <div class="inner-spacer">
                      <form action="" class="form-inline">
                        <input type="text" id="rol" data-toggle="popover" class="form-control" placeholder="Nombre del nuevo rol" data-placement="bottom">
                        <input type="button" class="btn btn-success" value="Crear" id="crear">
                      </form>
              </div>
            </div>
          </div>

          <!-- /Inner Row Col-md-12 -->

    <!-- /Widgets Row End Grid-->

    <!-- Alert -->
    <div style="display:none;" class="alert alert-warning alert-dismissible" role="alert">

  </div>
  <!-- end Alert -->







     <!-- Widget Row Start grid -->
    <div id="cargarTabla">

          <div class="col-md-12  bootstrap-grid">
            <div class="powerwidget green"  data-widget-editbutton="false">
              <header><strong>Agregar Nuevo Rol</strong></header>

              <div class="inner-spacer">
                       @if(count($roles) > 0)
                              <table class="table table-bordered table-hover" >
                                    <tr>
                                      <th width="30%">Rol</th>
                                      <th>Opción</th>
                                    </tr>
                                    @foreach($roles as $rol)
                                    @if($rol['id'] != 1)
                                    <tr>
                                         <td>{{$rol['name']}}</td>
                                         <td>
										 @if( in_array($rol['id'], array(2,3,4,5,6)) )
                                            <button  class="eliminar btn btn-danger btn-sm" id="boton" disabled><i class="glyphicon glyphicon-remove"></i></button>
                                         @else
										  <button  class="eliminar btn btn-danger btn-sm" id="boton" name="{{$rol['id']}}"><i class="glyphicon glyphicon-remove"></i></button>
										@endif
										 </td>
                                       </tr>
                                    @endif
                                    @endforeach
                                  </table>
                      @else
                                      <div style="display:block;" class="alert alert-warning alert-dismissible" role="alert">
                                        No sé a creado ningún rol aun
                                      </div>
                      @endif
              </div>
            </div>
          </div>

          <!-- /Inner Row Col-md-12 -->
    </div>
    <!-- /Widgets Row End Grid-->
    </div>

<!-- scroll top -->
<div class="scroll-top-wrapper hidden-xs">
    <i class="fa fa-angle-up"></i>
</div>
<!-- /scroll top -->



<!--Modals-->

<!--Power Widgets Modal-->
<div class="modal" id="delete-widget">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">
        <p>Are you sure to delete this widget?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="trigger-deletewidget-reset">Cancel</button>
        <button type="button" class="btn btn-primary" id="trigger-deletewidget">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!--Lock Screen Dialog Modal-->
<div class="modal" id="lockscreen">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">Are You Sure Want To Lock Screen?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="yesilock">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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

<!--FlotChart-->
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.stack.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.categories.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.time.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.resize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.axislabels.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot-tooltip.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.pie.min.js')}}"></script>

<!--Bootstrap-->
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat-->
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App-->
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/index/js/main.js')}}"></script>
<!--/Scripts-->

@stop
