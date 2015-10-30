@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - DASHBOARD | Reportes-Egresos
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
				<li class="active" style="float:right">Bienvenido {{	$usuario	}}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
			 <h1>Egreso<small>Editar</small></h1>
			 
		</div>
	<!-- Widget Row Start grid -->
		<div class="row" id="powerwidgets">
			<div class="col-md-12 bootstrap-grid"> 
			<!-- New widget -->
				 <div class="powerwidget green" id="datatable-filter-column" data-widget-editbutton="false">
             
			 <header>Editar egreso</header>
			 
				<div class="invoice-block">
					<!--Messages -->
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
					
					
				</div>
				
				<div class="inner-spacer">
                {{ Form::open(['route'=>'expense.edit.store','files'=>'true','class'=>'orb-form','id'=>'registration-form']) }}
               
                <fieldset>
					<div class="row">
                    <section class="col col-4">
						<label class="label">Monto</label>
						<label class="input"> <i class="icon-prepend fa fa-money"></i>
						  {{ Form::text('amount',$expense->amount,Input::old("amount"),['placeholder'=>'Ingrese monto del gasto']) }}
						  {{ Form::hidden('expense',$expense->id) }}
						</label>
					</section>
                    
                    <section class="col col-4">
						<label class="label">Concepto</label>
						<label class="select">
							<select name="sub_account_id" required>
								<option value="{{$expense->sub_account_id}}">{{$expense->SubAccount->description}}</option>
								@foreach($sub_accounts as $sub_account) 
								@if($sub_account->id != $expense->sub_account_id)
								 <option value="{{$sub_account->id}}" {{ ( Input::old("sub_account_id") == $sub_account->id	) ? 'selected="selected"' : null }} >
									{{$sub_account->description}}
								 </option>
								 @endif
								@endforeach
							 
							</select>
							<i></i> 
						</label>
                    </section>
					
					   <section class="col col-4">
						  <label class="label">Comentarios</label>
						   <label class="textarea"> <i class="icon-prepend fa fa-comments"></i>
							{{ Form::textarea('coments',$expense->coments, ['size'=>'2x2']) }}						
						  </label>
                      </section>
					 
                    </div>
                    <div class="row">
					<section class="col col-6">
					
					@if($files->count() > 0)
					<table class="display table table-striped table-hover">
						  <thead>
							<tr>
							  <th width="80%">ARCHIVOS GUARDADOS</th>
							  <th>Opciones</th>
							</tr>
						  </thead>					  
						  <tbody>
								@foreach($files as $file)
								<tr>
									@if($file->expense_id == $expense->id)
									<td>
									<a href="{{asset('uploads/files/expenses').'/'.$file->filename}}" target="_blank">
										<button type="button" class="btn btn-primary btn-xs">{{$file->public_filename}}</button>
									</a>
									</td>
									<td><center>
									<a href="{{URL::action('ExpensesController@delete_fileEgreso',$file->id)}}" title="Eliminar"><i class="fa fa-times-circle"></i></a> 
									</center>
									</td>
									@endif
								</tr>
								@endforeach						  
						  </tbody>
					  </table>
					 <br>
					 
					  <label class="label">Archivos, anexos, comprobante, facturas, etc.</label>
						@for($i=$files->count(); $i <3 ; $i++)
						  <label for="file" class="input input-file">
						  <div class="button">
							{{ Form::file('file[]') }}
							Seleccionar</div>
						  <input type="text" readonly>
						  </label>
						  <br>
						@endfor
						  <div class="note"><strong>Peso máximo 5 megas</strong>| Solo se pueden subir gif, jpeg, pdf, xml, png, doc, docx, xls, xlsx.</div>
						  
					 @else

						  <label class="label">Archivos, anexos, comprobante, facturas, etc.</label>

						  <label for="file" class="input input-file">
						  <div class="button">
							{{ Form::file('file[]') }}
							Seleccionar</div>
						  <input type="text" readonly>
						  </label>
						  <br>
						  <label for="file" class="input input-file">
						  <div class="button">
							{{ Form::file('file[]') }}
							Seleccionar</div>
						  <input type="text" readonly>
						  </label>
						  <br>
						  <label for="file" class="input input-file">
						  <div class="button">
							{{ Form::file('file[]') }}
							Seleccionar</div>
						  <input type="text" readonly>
						  </label>
						  <div class="note"><strong>Peso máximo 5 megas</strong>| Solo se pueden subir gif, jpeg, pdf, xml, png, doc, docx, xls, xlsx.</div>
						
					@endif   
						  
						</section>
                    </div>
                </fieldset> 
                 
                <footer>
                    <a href="{{URL::to('dashboard/reports/expenses')}}"><button style="float:right;" type="button" class="btn btn-success pull-left">Egresos</button></a> <button style="float:right;" type="submit" class="btn btn-success">Guardar cambios</button>
                </footer>
                {{ Form::close() }}
              </div>
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
<!--Demo Script for File Input Fields.-->
<script>
    $(function() {
        $('input[type="file"]').change(function() {
            $(this).parent().next().val($(this).val());
        });
    });
</script>
<!--Fullscreen--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/fullscreen/screenfull.min.js"></script>

<!--Forms--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/forms/jquery.form.min.js"></script>
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/forms/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/forms/jquery.validate.lang_es.js"></script>

<!--NanoScroller--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js"></script>

<!--Sparkline--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/sparkline/jquery.sparkline.min.js"></script>

<!--Horizontal Dropdown--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js"></script>
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/classie/classie.js"></script>

<!--Datatables--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/datatables/jquery.dataTables-bootstrap.js"></script>
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/datatables/dataTables.colVis.js"></script>
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/datatables/colvis.extras.js"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/powerwidgets/powerwidgets.min.js"></script>

<!--Bootstrap--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/bootstrap/bootstrap.min.js"></script>

<!--Chat--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/todos/todos.js"></script>


<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>

<!--/Scripts-->	

@stop
