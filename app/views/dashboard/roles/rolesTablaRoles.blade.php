     <!-- Widget Row Start grid -->
    <div id="cargarTabla">
    <div class="row" id="powerwidgets">
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
