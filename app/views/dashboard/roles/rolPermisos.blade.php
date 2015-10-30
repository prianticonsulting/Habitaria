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
        <li class="active">Permisos</li>
        <li class="active" style="float:right">Bienvenido {{$breadcrumbs_data}}</li>
        </ul>
      </div>
    <!--/Breadcrumb-->
    
    <div class="page-header">
       <h1>Seguridad<small>Permisos</small></h1>      
    </div>
        <div id="caragarPanel">
        @if(count($roles) > 0 && count($permisos) > 0)
        <!-- Widget Row Start grid -->
        <div class="panel panel-success">
          <div class="panel-heading">
            <strong id="tituloRol">{{$roles[1]['name']}}</strong> 
            <span class="flotarl"><strong>Selecciona un rol:
            <select name="roles" id="roles">
                  <option value="{{$roles[1]['id']}}">{{$roles[1]['name']}}</option>
                  @foreach($roles as $rol)
                    @if($rol['id'] != 1 && $rol['id'] != $roles[1]['id'])
                    <option value="{{$rol['id']}}">{{$rol['name']}}</option>
                    @endif
                  @endforeach
              </select> 
              </strong>
              </span>
          </div>
            <div class="panel-body">
  
              <div class="inner-spacer">
                <div class="tree well margin-0px">
                  <table class="table table-bordered" data-rol="{{$roles[0]['id']}}">
                  <tr>
                    <th>Menu</th>
                    <th>Modulo</th>
                    <th>Permiso</th>
                  </tr>
                  <tr>
                    <td rowspan="3">pagos</td>
                    <td>
                      Estado de cuenta
                    </td>
                    <td>
                      @if($permisos[0]['state'] == 1)
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[0]['id']}}" id="pagosCuenta" checked> 
                      @else
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[0]['id']}}" id="pagosCuenta"> 
                      @endif
                    </td>
                  </tr>
                   <tr>
                      <td>Historial</td>
                       <td>
                       @if($permisos[1]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[1]['id']}}" id="pagosHistorial" checked>
                       @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[1]['id']}}" id="pagosHistorial">
                       @endif
                    </td>
                    </tr>
                    <tr>
                      <td>Vecinos</td>
                       <td>
                      @if($permisos[2]['state'] == 1)
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[2]['id']}}" id="pagosVecinos" checked>
                      @else
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[2]['id']}}" id="pagosVecinos">
                      @endif
                    </td>
                    </tr>
                  <tr>
                    <td rowspan="4">Ingresos</td>
                    <td>Cobrar</td>
                    <td>
                      @if($permisos[3]['state'] == 1)
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[3]['id']}}" id="ingresosCobrar" checked>
                      @else
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[3]['id']}}" id="ingresosCobrar">
                      @endif
                    </td>
                  </tr>
				  <tr>
                    <td>Registrar ingreso</td>
                     <td>
                       @if($permisos[18]['state'] == 1)
                         <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[18]['id']}}" id="ingresosRegistrar" checked>
                       @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[18]['id']}}" id="ingresosRegistrar">
                       @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Historial</td>
                     <td>
                       @if($permisos[4]['state'] == 1)
                         <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[4]['id']}}" id="ingresosHitorial" checked>
                       @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[4]['id']}}" id="ingresosHitorial">
                       @endif
                    </td>
                  </tr>
				  <tr>
                    <td>Saldos</td>
                     <td>
                       @if($permisos[17]['state'] == 1)
                         <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[17]['id']}}" id="ingresosSaldos" checked>
                       @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[17]['id']}}" id="ingresosSaldos">
                       @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Egresos</td>
                    <td>Registrar gasto</td>
                    <td>
                      @if($permisos[5]['state'] == 1)
                         <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[5]['id']}}" id="egresosRegistrarGastos" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[5]['id']}}" id="egresosRegistrarGastos">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="3">Reportes</td>
                    <td>Ingresos</td>
                    <td>
                      @if($permisos[6]['state'] == 1)
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[6]['id']}}" id="reportesIngresos" checked>
                      @else
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[6]['id']}}" id="reportesIngresos">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Egresos</td>
                    <td>
                       @if($permisos[7]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[7]['id']}}" id="reportesEgresos" checked>
                       @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[7]['id']}}" id="reportesEgresos">
                       @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Ciudades</td>
                    <td>
                       @if($permisos[8]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[8]['id']}}" id="reportesCiudades" checked>
                       @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[8]['id']}}" id="reportesCiudades">
                       @endif
                    </td>
                  </tr>
                   <tr>
                    <td rowspan="4">Seguridad</td>
                    <td>Roles</td>
                    <td>
                       @if($permisos[9]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[9]['id']}}" id="rolesCrear" checked> 
                       @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[9]['id']}}" id="rolesCrear"> 
                       @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Permisos</td>
                    <td>
                      @if($permisos[10]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[10]['id']}}" id="rolesAsignar" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[10]['id']}}" id="rolesAsignar">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Asignar</td>
                    <td>
                      @if($permisos[11]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[11]['id']}}" id="rolesPermisos" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[11]['id']}}" id="rolesPermisos">
                      @endif
                    </td>
                  </tr>
                   <tr>
                    <td>Registro</td>
                    <td>
                      @if($permisos[22]['state'] == 1) 
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[22]['id']}}" id="rolesLogs" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[22]['id']}}" id="rolesLogs">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="8">Colonias</td>
                    <td>
                      Información
                    </td>
                    <td>
                      @if($permisos[12]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[12]['id']}}" id="coloniasInformacion" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[12]['id']}}" id="coloniasInformacion">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Calles</td>
                    <td>
                      @if($permisos[13]['state'] == 1)
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[13]['id']}}" id="coloniaUbicacion" checked>
                      @else
                        <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[13]['id']}}" id="coloniaUbicacion">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Cuota</td>
                    <td>
                      @if($permisos[14]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[14]['id']}}" id="coloniaCuota" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[14]['id']}}" id="coloniaCuota">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Invitar Vecino</td>
                    <td>
                      @if($permisos[15]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[15]['id']}}" id="coloniaInvitarVecino" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[15]['id']}}" id="coloniaInvitarVecino">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Registrar Vecino</td>
                    <td>
                      @if($permisos[16]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[16]['id']}}" id="coloniaRegistrarVecino" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[16]['id']}}" id="coloniaRegistrarVecino">
                      @endif
                    </td>
                  </tr>
				  <tr>
                    <td>Registrar Familiar</td>
                    <td>
                      @if($permisos[24]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[24]['id']}}" id="coloniaRegistrarFamiliar" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[24]['id']}}" id="coloniaRegistrarFamiliar">
                      @endif
                    </td>
                  </tr>
				  <tr>
				  <td>Nueva Colonia</td>
                    <td>
                      @if($permisos[23]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[23]['id']}}" id="nuevaColonia" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[23]['id']}}" id="nuevaColonia">
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Categorias Ingresos</td>
                    <td>
                      @if($permisos[19]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[19]['id']}}" id="coloniaIngresos" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[19]['id']}}" id="coloniaIngresos">
                      @endif
                    </td>
                  </tr>
                   <tr>
                    <td>Categorias Egresos</td>
                    <td>
                      @if($permisos[20]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[20]['id']}}" id="coloniaEgresos" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[20]['id']}}" id="coloniaEgresos">
                      @endif
                    </td>
                  </tr>
				  <td rowspan="3">Correo</td>
                   <td>Enviar Correo</td>
                    <td>
                      @if($permisos[21]['state'] == 1)
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[21]['id']}}" id="coloniaCorreo" checked>
                      @else
                          <input type="checkbox" class="cambioPermiso" data-id="{{$permisos[21]['id']}}" id="coloniaCorreo">
                      @endif
                    </td>
                  </tr>
                </table>
                 <div style="display:none;" class="callout callout-warning" role="alert" id="mnj"></div>
                <div class="page-header"></div>
               
                <footer>
                  <button style="float:right;" id="botonCambiarPermisos" class="btn btn-success">Guardar cambios</button>
                </footer><br><br>
                </div>

              </div>
              
            </div>
            
             @else
                <div style="display:block;" class="callout callout-warning" role="callout">
                  No hay datos para mostrar
                </div>
             @endif
           
	

		   <!-- /New widget --> 
            <div id="caragarPanel">
    <!-- New widget -->
            
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
