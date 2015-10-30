<!--Main Menu-->
@if(Auth::check())
<?php $permiso = Session::get("dato")?>
<div class="responsive-admin-menu">
  <div class="responsive-menu">HABITARIA
	<div class="menuicon"><i class="fa fa-angle-down"></i></div>
  </div>
  <ul id="menu">
	<li>
	<a class="submenu active" href="{{URL::route('home')}}" data-id="dash-sub" title="Interface"><i class="entypo-briefcase"></i><span>Panel</span></a>
      <!-- Panel Sub-Menu -->
      <ul id="dash-sub" class="accordion">
        <li>
			<a class="{{Route::currentRouteName() == ('home') ? 'active' : '' }}"href="{{URL::route('home')}}"><i class="entypo-home"></i><span>Inicio</span></a>
		</li>

		@if($permiso[0]->state == 1 || $permiso[1]->state == 1 || $permiso[2]->state == 1)
		<li><a class="submenu
					 {{Route::currentRouteName() == ('account.states') ?        'active' : '' }}
					 {{Route::currentRouteName() == ('payments.record') ? 	    'active' : '' }}
					 {{Route::currentRouteName() == ('payments.neighbors') ? 	    'active' : '' }}
					 {{Route::currentRouteName() == ('buildings') ? 			'active' : '' }}"data-id="payments-sub"  title="Pagos" href="#" ><i class="fa fa-money"></i><span>Pagos</span></a>
			<ul id="payments-sub" class="accordion">
				@if($permiso[0]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('account.states') ? 'active' : '' }}"  href="{{URL::route('account.states')}}"><i class="fa fa-bank"></i><span>Mi Estado de Cuenta</span></a>
				</li>
				@endif
				@if($permiso[1]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('payments.record') ? 'active' : '' }}" href="{{URL::route('payments.record')}}"><i class="fa fa-folder-open"></i><span>Mi Historial</span></a>
				</li>
				@endif
				@if($permiso[2]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('payments.neighbors') ? 'active' : '' }}" href="{{URL::route('payments.neighbors')}}"><i class="fa fa-male"></i><span>&nbsp;&nbsp;Mis Vecinos</span></a>
				</li>
				@endif
			</ul>
        </li>
        @endif
		@if($permiso[3]->state == 1 || $permiso[4]->state == 1 || $permiso[17]->state == 1  || $permiso[18]->state == 1)
		<li><a class="submenu
					 {{Route::currentRouteName() == ('income.charge') ?   'active' : '' }}
					 {{Route::currentRouteName() == ('income.charge.other') ?   'active' : '' }}
					 {{Route::currentRouteName() == ('incomes.record') ?   'active' : '' }}
					 {{Route::currentRouteName() == ('income.charge.balances') ? 	    'active' : '' }}" data-id="incomes-sub" href="#" ><i class="fa fa-plus-circle"></i><span>Ingresos</span></a>
			<ul id="incomes-sub" class="accordion">
				@if($permiso[3]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('income.charge') ? 'active open' : '' }}" href="{{URL::route('income.charge')}}"><i class="fa fa-history"></i><span>&nbsp;Cobrar</span></a>
				</li>
				@endif
				@if($permiso[18]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('income.charge.other') ? 'active open' : '' }}" href="{{URL::route('income.charge.other')}}"><i class="fa fa-history"></i><span>&nbsp;Registrar ingreso</span></a>
				</li>
				@endif
				@if($permiso[4]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('incomes.record') ? 'active open' : '' }}" href="{{URL::route('incomes.record')}}"><i class="fa fa-folder-open"></i><span>Historial</span></a>
				</li>
				@endif
				@if($permiso[17]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('income.charge.balances') ? 'active open' : '' }}" href="{{URL::route('income.charge.balances')}}"><i class="fa fa-money"></i><span>Saldos</span></a>
				</li>
				@endif
			</ul>
        </li>
		@endif
		@if($permiso[5]->state == 1)
		<li><a class="submenu
					 {{Route::currentRouteName() == ('expenses') ?   'active' : '' }}
					 {{Route::currentRouteName() == ('report.expenses') ?   'active' : '' }}" data-id="expenses-sub" href="#" ><i class="fa fa-minus-circle"></i><span>Egresos</span></a>
			<ul id="expenses-sub" class="accordion">
				<li>
					<a class="{{Route::currentRouteName() == ('expenses') ? 'active open' : '' }}"href="{{URL::route('expenses')}}">
					<i class="fa fa-credit-card"></i><span>Registrar Gasto</span></a>
				</li>
				<li>
					<a class="{{Route::currentRouteName() == ('report.expenses') ? 'active open' : '' }}"href="{{URL::route('report.expenses')}}">
					<i class="fa fa-folder-open"></i><span>Historial</span></a>
				</li>
			</ul>
        </li>
        @endif

		@if($permiso[6]->state == 1 || $permiso[7]->state == 1 || $permiso[8]->state == 1)
		<li><a class="submenu {{Route::currentRouteName() == ('reports') ? 'active open' : '' }} {{Route::currentRouteName() == ('reports.incomes') ? 'active open' : '' }}" data-id="reports-sub" href="#" ><i class="fa fa-file-archive-o"></i><span>Reportes</span></a>
			<ul id="reports-sub" class="accordion">

				@if($permiso[7]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('reports') ? 'active open' : '' }}" href="{{URL::route('reports')}}">
					<i class="fa fa-minus-circle"></i><span>Pagos</span></a>
				</li>
				@endif
                @if($permiso[7]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('reports.incomes') ? 'active open' : '' }}" href="{{URL::route('reports.incomes')}}">
					<i class="fa fa-minus-circle"></i><span>Ingresos</span></a>
				</li>
				@endif
                @if($permiso[7]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('cities') ? 'active open' : '' }}"href="{{URL::to('dashboard/reports/status')}}">
					<i class="fa fa-minus-circle"></i><span>Estado General</span></a>
				</li>
				@endif
				<!-- @if($permiso[8]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('cities') ? 'active open' : '' }}"href="{{URL::route('cities')}}">
					<i class="fa fa-minus-circle"></i><span>Estado de Pagos</span></a>
				</li>
				@endif -->
			</ul>
        </li>
        @endif

        <!-- Roles -->
			@if($permiso[9]->state == 1 || $permiso[10]->state == 1 || $permiso[11]->state == 1 || $permiso[22]->state == 1)
			<li><a class="submenu
				{{Route::currentRouteName() == ('create') ?   'active' : '' }}
				 {{Route::currentRouteName() == ('permits') ?   'active' : '' }}
				 {{Route::currentRouteName() == ('logs') ?   'active' : '' }}"  data-id="roles-sub"  href="#" ><i class="glyphicon glyphicon-list"></i><span>Seguridad</span></a>
			<ul id="roles-sub" class="accordion">
				@if($permiso[9]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('create') ? 'active open' : '' }}" href="{{url()}}/dashboard/rol/create">
						<i class="glyphicon glyphicon-plus"></i><span>Roles</span></a>
				</li>
				@endif
				@if($permiso[10]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('permits') ? 'active open' : '' }}" href="{{url()}}/dashboard/rol/permits">
					<i class="glyphicon glyphicon-lock"></i><span>Permisos</span></a>
				</li>
				@endif
				<!--@if($permiso[11]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('assign') ? 'active open' : '' }}" href="{{url()}}/dashboard/rol/assign">
					<i class="glyphicon glyphicon-user"></i><span>Asignar</span></a>
				</li>
				@endif-->
				@if($permiso[22]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('logs') ? 'active open' : '' }}" href="{{URL::route('logs')}}">
					<i class="fa fa fa-bars"></i><span>Registros</span></a>
				</li>
				@endif
			</ul>
        </li>
        @endif

        <!-- end Roles-->
<!--
        <li><a class="submenu
					 {{Route::currentRouteName() == ('building.create') ?   'active' : '' }}
					 {{Route::currentRouteName() == ('building.info') ? 	'active' : '' }}
					 {{Route::currentRouteName() == ('building.edit') ? 	'active' : '' }}
					 {{Route::currentRouteName() == ('buildings') ? 		'active' : '' }}" href="#"  data-id="buildings-sub"  title="Edificios">
					 <i class="fa fa-empire"></i><span>desarrollos</span></a>
          <ul id="buildings-sub" class="accordion">

            <li>
				<a class="{{Route::currentRouteName() == ('buildings') ? 'active open' : '' }}">
				<i class="fa fa-home"></i><span>Colonias</span></a>
			</li>
			<li>
				<a class="{{Route::currentRouteName() == ('building.create') ? 'active open' : '' }}">
				<i class="fa fa-building"></i><span>Edificios</span></a>
			</li>
          </ul>
        </li>
        <li>
-->


			<!-- Configurar Colonias -->
			@if($permiso[12]->state == 1 || $permiso[13]->state == 1 || $permiso[14]->state == 1 || $permiso[15]->state == 1 || $permiso[16]->state == 1 || $permiso[19]->state == 1 || $permiso[20]->state == 1 || $permiso[21]->state == 1 || $permiso[23]->state == 1 || $permiso[24]->state == 1 || $permiso[25]->state == 1)
			<li><a class="submenu
				{{Route::currentRouteName() == ('config.colony.info') ?   'active' : '' }}
				{{Route::currentRouteName() == ('config.colony.ubic') ?   'active' : '' }}
				{{Route::currentRouteName() == ('config.colony.inv') ?   'active' : '' }}
				{{Route::currentRouteName() == ('config.colony.reg') ?   'active' : '' }}
				{{Route::currentRouteName() == ('config.colony.reg.fam') ?   'active' : '' }}
				{{Route::currentRouteName() == ('config.colony.edit.share') ?   'active' : '' }}
				{{Route::currentRouteName() == ('incomes.catalog') ?   'active' : '' }}
				{{Route::currentRouteName() == ('expenses.catalog') ?   'active' : '' }}
				{{Route::currentRouteName() == ('config.colony.email') ?   'active' : '' }}
				{{Route::currentRouteName() == ('config.colony.suggestion') ?   'active' : '' }}"  data-id="colony-sub"  href="#" ><i class="fa fa-cog"></i><span>Configuración</span></a>
			<ul id="colony-sub" class="accordion">
                @if(Session::get("rol_usuario") != 6)

				@if($permiso[12]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('config.colony.info') ? 'active open' : '' }}" href="{{URL::route('config.colony.info')}}">
						<i class="fa entypo-pencil"></i><span>Información</span></a>
				</li>
				@endif
				@if($permiso[13]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('config.colony.ubic') ? 'active open' : '' }}" href="{{URL::route('config.colony.ubic')}}">
					<i class="fa entypo-globe"></i><span>Calles</span></a>
				</li>
				@endif
				@if($permiso[15]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('config.colony.inv') ? 'active open' : '' }}" href="{{URL::route('config.colony.inv')}}">
					<i class="fa fa-male"></i><span>&nbsp;Invitar Vecinos</span></a>
				</li>
				@endif
				@if($permiso[16]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('config.colony.reg') ? 'active open' : '' }}" href="{{URL::route('config.colony.reg')}}">
					<i class="fa entypo-book"></i><span>Registrar Vecinos</span></a>
				</li>
				@endif
				<!-- @if($permiso[24]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('config.colony.reg.fam') ? 'active open' : '' }}" href="{{URL::route('config.colony.reg.fam')}}">
					<i class="fa entypo-users"></i><span>Registrar Familiar</span></a>
				</li>
				@endif -->
				<!--@if($permiso[23]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('config.colony.nueva') ? 'active open' : '' }}" href="{{URL::route('config.colony.nueva')}}">
					<i class="fa entypo-leaf"></i><span>Nueva Colonia</span></a>
				</li>
				@endif-->
				@if($permiso[14]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('config.colony.edit.share') ? 'active open' : '' }}" href="{{URL::route('config.colony.edit.share')}}">
					<i class="fa fa-money"></i><span>Cuota</span></a>
				</li>
				@endif
				@if($permiso[19]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('incomes.catalog') ? 'active open' : '' }}" href="{{URL::route('incomes.catalog')}}">
					<i class="fa fa-folder-open"></i><span>Categorias Ingresos</span></a>
				</li>
				@endif
				@if($permiso[20]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('expenses.catalog') ? 'active open' : '' }}" href="{{URL::route('expenses.catalog')}}">
					<i class="fa fa-folder-open-o"></i><span>Categorias Egresos</span></a>
				</li>
				@endif
				@if($permiso[21]->state == 1)
				<li>
					<a class="{{Route::currentRouteName() == ('config.colony.email') ? 'active open' : '' }}" href="{{URL::route('config.colony.email')}}">
					<i class="fa fa fa-envelope"></i><span>Enviar Correo</span></a>
				</li>
				@endif

                @endif
                <!--<li>
					<a class="{{Route::currentRouteName() == ('config.colony.suggestion') ? 'active open' : '' }}" href="{{URL::route('config.colony.suggestion')}}">
					<i class="fa fa fa-envelope"></i><span>Sugerencias</span></a>
				</li>-->

                <li>
					<a class="{{Route::currentRouteName() == ('config.colony.suggestion') ? 'active open' : '' }}" href="{{URL::route('suggestions')}}">
					<i class="fa fa fa-envelope"></i><span>Sugerencias</span></a>
				</li>-

			</ul>
        </li>
        @endif



        <!-- end Configurar Colonias-->

		<!--<li>
			<a href="{{URL::route('tree.permission')}}"><i class="entypo-flow-tree"></i>
			<span>Árbol de Permisos</span>
			</a>
		</li>-->


      </ul>
    </li>
  </ul>
</div>
<!--/MainMenu-->
@endif
