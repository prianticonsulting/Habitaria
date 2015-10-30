@extends ('dashboard.layouts.default')

@section ('titlePage')
  HABITARIA - PANEL | Reportes de Pagos
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
       <h1>Reportes <small> Pagos</small></h1>
    </div>

        <!-- Widget Row Start grid -->

            <!-- /New widget -->

             <div class="row" id="powerwidgets">
          <div class="col-md-12  bootstrap-grid">
            <div class="powerwidget green"  data-widget-editbutton="false">
              <header></header>

              <div class="inner-spacer">
                {{ Form::open(['url' => 'dashboard/reports/generate-pdf-payments', 'class' => 'orb-form','id' => 'data-pickers']) }}
                      <label for="">Generar Reporte</label>
                      <fieldset>

                          <?php

                              $firstDayUTS = mktime(0, 0, 0, date("m"), 1, date("Y"));
                              $lastDayUTS  = mktime(0, 0, 0, date("m"), date('t'), date("Y"));

                              $firstDay = date("d-m-Y", $firstDayUTS);
                              $lastDay  = date("d-m-Y", $lastDayUTS);

                          ?>

                              <div class="row">
                                <section class="col col-6">
                                <label class="label">Desde</label>
                                  <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="desde" id="desde" autocomplete="off" placeholder="Desde" value="{{$firstDay}}">
                                  </label>
                                </section>
                                <section class="col col-6">
                                  <label class="label">Hasta</label>
                                  <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="hasta" id="hasta" autocomplete="off" placeholder="Hasta" value="{{$lastDay}}">
                                  </label>
                                </section>
                              </div>
                              <div class="row">
                                <section class="col col-6">
                                  <label class="input">
                                     <button type="submit" id="btnReport" class="btn btn-default">Generar Reporte</button>
                                  </label>
                                </section>
                              </div>
                      </fieldset>
                </form>
                <br><br>
                <div id="tablaReporte" class="col-md-12 table-responsive"></div>
         </div>
        </div>
    </div>




          <!-- /Inner Row Col-md-12 -->
    </div>
    <!-- /Widgets Row End Grid-->

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
<script type="text/javascript">


// Date range
        if ($('#desde').length) {
            $('#desde').datepicker({
                dateFormat: 'dd-mm-yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#hasta').datepicker('option', 'minDate', selectedDate);
                },
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá']
            });
        }
        if ($('#hasta').length) {
            $('#hasta').datepicker({
                dateFormat: 'dd-mm-yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#desde').datepicker('option', 'maxDate', selectedDate);
                },
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá']
            });
        }


  $(document).ready(function(){

    $("#btnReport").click(function(e) {
      e.preventDefault();

      $.post('reports/ajax-generate-payments',
        {
          desde : $("#desde").val(),
          hasta : $("#hasta").val()
        },
        function(data) {
            $("#tablaReporte").html(data);
        });

    });



  });


</script>

@stop
