<div class="panel panel-success">
          <div class="panel-heading">
            <strong id="tituloRol">{{$role}}</strong> 
            <span class="flotarl"><strong>Selecciona un rol:
            <select name="" id="roles">
                  <option value="{{$id}}">{{$role}}</option>
                  @foreach($roles as $rol)
                    @if($rol['name'] != $role)
                       @if($rol['id'] != 1 )
                        <option value="{{$rol['id']}}">{{$rol['name']}}</option>
                       @endif 
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
                 <!--<div style="display:none;" class="alert alert-warning alert-dismissible" role="alert"></div>-->
                
                </div>
              </div>
            </div>