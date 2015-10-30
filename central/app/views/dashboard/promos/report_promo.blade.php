@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Promos 
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
					 <h1>Promos<small>Colonia {{$colony_name}}</small></h1>
					 
				 </div>
				
				
		<!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-8 bootstrap-grid"> 
            <!-- New widget -->

            <div class="powerwidget cold-grey" id="table1" data-widget-editbutton="false">
              <header>
                <h2>Promos de la colonia<small> {{$colony_name}} </small></h2>
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
				
                <table class="display table table-striped table-hover" id="table-2">
                  <thead>
                    <tr>
                      <th>#</th>
					  <th>Creación</th>
                      <th>Status</th>
					  <th>Cupón</th>
                    </tr>
                  </thead>
                  <tbody>
				  
				 @foreach($promos as $row)
                    <tr>
					  <td>{{$num++}}</td>
                      <td>{{date('d-M-Y', strtotime( $row->created_at ))}}</td>                           
					  <td>
						@if($row->status == 0)
							No activada
						@else
							Activada
						@endif
					  </td>
                      <td><a href="#" onclick="verCupon({{$row->id}})"><img src="{{asset('assets/images/cupon.jpg')}}" alt="Cupon" /></a></td>
                    </tr>
					@endforeach				
                  </tbody>
				  <tfoot>
						<tr>
						  <th><input type="hidden"></th> 
						  <th><input type="text" name="filter_created" 		placeholder="Filtrar por Creación" 			class="search_init" /></th>
						  <th><input type="text" name="filter_status" 		placeholder="Filtrar por status" 		class="search_init" /></th>
						  <th><input type="hidden"></th>
						</tr>
					  </tfoot>
                </table>
              </div>
            </div>
            <!-- End .powerwidget --> 

				
				
				
				
			</div>
			<!--/Content--> 	  
		</div>
		<!--/MainWrapper--> 
	</div>
	<!--/Smooth Scroll--> 

<!--Promo Cupon Dialog Modal-->
<div class="modal" id="CuponDialog">
  <div class="modal-dialog modal-sm" style="width: 40%;" >
    <div class="modal-content">
      <div class="modal-header">
	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Cupón</h4>
         </div>
      <div id="cupon-body">                                      

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->



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


<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!--/Scripts-->	
<script type="text/javascript">

function verCupon(cupon){
	
	$( "#cupon-body" ).load( "{{ url('dashboard/promo/cupon')}}/"+cupon );
	$('#CuponDialog').modal();
}				

</script>
@stop
