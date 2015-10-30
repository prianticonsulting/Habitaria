@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Usuarios
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
				<li><a href="{{URL::route('users')}}">Usuarios</a></li>
				<li class="active">Actualizar Usuario</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
			 <h1>Usuarios<small>Directorio</small></h1>
		</div>

<!-- MAIN CONTENT -->
		<div class="row">
		<!-- New widget -->
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
            <!--
				Messages  	
			-->
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
			<!--
							
			-->
            <div class="powerwidget marine" id="checkout-form-validation-widget" data-widget-editbutton="false">
              <header>
                <h2>Actualizar<small>Usuario</small></h2>
              </header>
              <div class="inner-spacer">
				
				{{ Form::open(['action'=>['UsersController@update', $row->id],'files'=>'true', 'id'=>'checkout-form', 'class'=>'orb-form']) }}
                  
                  
                <header>
					@foreach ($row->Neighbors as $user)
						
						{{$user->name}} {{$user->last_name}} <span class="text-danger" style="float:right">ID #  {{$user->doc_id_num}}</span></header>
                  
					@endforeach
                 
                  <fieldset>
                    <div class="row">
						<section class="col col-5">
							<label class="label"><h4>Status</h4></label>
							@foreach ($status as $statu)
							<label class="radio state-success">
								<input type="radio" name="status" value= "{{$statu->id}}" {{($row->status_id == $statu->id)? 'checked':'';}}>
								<i></i>{{$statu->type}}
							</label>
							@endforeach
						</section>
                    <div class="col col-2"></div>
						<section class="col col-5">
                        <label class="label"><h4>Roles</h4></label>
                        @foreach ($roles as $rol)
                        <label class="toggle state-success">
							@foreach ($row->AssigmentRole as $users_role)
							<input type="checkbox" name="roles[]" value= "{{$rol->id}}" {{($rol->id == $users_role->id)? 'checked':'';}}>
							@endforeach
							<i></i>{{$rol->name}}
                        </label>
                        @endforeach
                        
                      </section>
                    </div>
                  </fieldset>
                  <footer>
                    <button type="submit" class="btn btn-default">Actualizar</button>
                  </footer>
                {{ Form::close() }}
              </div>
            </div>
            <!-- /End Widget --> 
				
			</div>
          <!-- /Inner Row Col-md-6 --> 
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

<!--Sign Out Dialog Modal-->
<div class="modal" id="signout">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">Are You Sure Want To Sign Out?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="yesigo">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

<!--Forms--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.lang_es.js')}}"></script>
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

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>



<!--/Scripts-->

@stop
