@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Árbol de Permisos
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
				<li class="active">árbol de Permisos</li>
				<li class="active" style="float:right">Bienvenido {{$attendant->name}} {{$attendant->last_name}}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
			 <h1>Perfiles<small>Usuarios</small></h1>			 
		</div>
		
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
            <div class="powerwidget blue" id="tree-view" data-widget-editbutton="false">
              <header>SuperAdmin
              </header>
              <div class="inner-spacer">
                <div class="tree well margin-0px">
                  <ul>
                    <li> <span><i class="fa fa-folder-open"></i> Pagos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Estado de Cuenta</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
						<li> <span><i class="fa fa-minus-circle"></i> Vecinos</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Ingresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Cobrar</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Egresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Registrar Gastos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Reportes</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ingresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Egresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Colonias</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Configurar Colonia</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Vecinos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Invitar Vecinos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Permisos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Establecer Permisos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Catalogos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ver Catalogos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Cuotas</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                    </li>					
                  </ul>
                </div>
              </div>
            </div>
            <!-- /New widget --> 
        
		<!-- New widget -->
            <div class="powerwidget blue" id="tree-view" data-widget-editbutton="false">
              <header>Admin
              </header>
              <div class="inner-spacer">
                <div class="tree well margin-0px">
                  <ul>
                    <li> <span><i class="fa fa-folder-open"></i> Pagos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Estado de Cuenta</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
						<li> <span><i class="fa fa-minus-circle"></i> Vecinos</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Ingresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Cobrar</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Egresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Registrar Gastos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Reportes</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ingresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Egresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Colonias</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Configurar Colonia</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Vecinos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Invitar Vecinos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Permisos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Establecer Permisos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Catalogos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ver Catalogos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Cuotas</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                    </li>					
                  </ul>
                </div>
              </div>
            </div>
            <!-- /New widget --> 

			<!-- New widget -->
            <div class="powerwidget blue" id="tree-view" data-widget-editbutton="false">
              <header>Presidente
              </header>
              <div class="inner-spacer">
                <div class="tree well margin-0px">
                  <ul>
                    <li> <span><i class="fa fa-folder-open"></i> Pagos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Estado de Cuenta</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
						<li> <span><i class="fa fa-minus-circle"></i> Vecinos</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Ingresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Cobrar</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Egresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Registrar Gastos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Reportes</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ingresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Egresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Colonias</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Configurar Colonia</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Vecinos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Invitar Vecinos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Permisos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Establecer Permisos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Catalogos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ver Catalogos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Cuotas</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                    </li>					
                  </ul>
                </div>
              </div>
            </div>
            <!-- /New widget --> 
 
			<!-- New widget -->
            <div class="powerwidget blue" id="tree-view" data-widget-editbutton="false">
              <header>Cobrador
              </header>
              <div class="inner-spacer">
                <div class="tree well margin-0px">
                  <ul>
                    <li> <span><i class="fa fa-folder-open"></i> Pagos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Estado de Cuenta</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
						<li> <span><i class="fa fa-minus-circle"></i> Vecinos</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Ingresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Cobrar</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Egresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Registrar Gastos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Reportes</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ingresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Egresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Colonias</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Configurar Colonia</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Vecinos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Invitar Vecinos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Permisos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Establecer Permisos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Catalogos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ver Catalogos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Cuotas</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                    </li>					
                  </ul>
                </div>
              </div>
            </div>
            <!-- /New widget --> 

			<!-- New widget -->
            <div class="powerwidget blue" id="tree-view" data-widget-editbutton="false">
              <header>Comprador
              </header>
              <div class="inner-spacer">
                <div class="tree well margin-0px">
                  <ul>
                    <li> <span><i class="fa fa-folder-open"></i> Pagos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Estado de Cuenta</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
						<li> <span><i class="fa fa-minus-circle"></i> Vecinos</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Ingresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Cobrar</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Egresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Registrar Gastos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Reportes</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ingresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Egresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Colonias</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Configurar Colonia</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Vecinos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Invitar Vecinos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Permisos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Establecer Permisos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Catalogos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ver Catalogos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Cuotas</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                    </li>					
                  </ul>
                </div>
              </div>
            </div>
            <!-- /New widget --> 

			<!-- New widget -->
            <div class="powerwidget blue" id="tree-view" data-widget-editbutton="false">
              <header>Vecino
              </header>
              <div class="inner-spacer">
                <div class="tree well margin-0px">
                  <ul>
                    <li> <span><i class="fa fa-folder-open"></i> Pagos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Estado de Cuenta</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
						<li> <span><i class="fa fa-minus-circle"></i> Vecinos</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Ingresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Cobrar</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Historial</span> <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Egresos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Registrar Gastos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Reportes</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ingresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                        <li> <span><i class="fa fa-minus-circle"></i> Egresos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>	
                    <li> <span><i class="fa fa-folder-open"></i> Colonias</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Configurar Colonia</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Vecinos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Invitar Vecinos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Permisos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Establecer Permisos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Catalogos</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                      <ul>
                        <li> <span><i class="fa fa-minus-circle"></i> Ver Catalogos</span> 
                          <!--Buttons-->
                          <div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-default">Mover</button>
							<button type="button" class="btn btn-default">Renombrar</button>
							<button type="button" class="btn btn-default">Eliminar</button>
                          </div>
                          <!--/Buttons-->
                        </li>
                      </ul>
                    </li>
                    <li> <span><i class="fa fa-folder-open"></i> Cuotas</span> <!--Buttons-->
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Mover</button>
                        <button type="button" class="btn btn-default">Renombrar</button>
                        <button type="button" class="btn btn-default">Eliminar</button>
                      </div>
                      <!--/Buttons-->
                    </li>					
                  </ul>
                </div>
              </div>
            </div>
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

<!--/Scripts-->	

@stop
