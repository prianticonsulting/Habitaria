<?php setlocale(LC_TIME, 'es_ES.UTF-8');   ?>
@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Configuración de Colonia
@stop
@section ('cssPage')
    {{ HTML::style('assets/css/thread.css'); }}
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
				<li class="active">Sugerencias</li>
				<li class="active" style="float:right">Bienvenido {{Auth::user()->email}} </li>
			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
          <h1>Sugerencias</h1>
        </div>

        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">

            <!-- New widget -->
            <div class="powerwidget green" id="from-emails" data-widget-editbutton="false">
              <header >
                 <h2 id="titleSuggestion">Mensajes</h2>
              </header>
              <div class="inner-spacer">
                  <div class="trhead-container">

                      <div class="row">
                          <div class="col-md-3 pull-right">
                              <form class="navbar-form navbar-left" role="search">
                                  <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Filtrar mensajes">
                                  </div>
                              </form>
                          </div>
                      </div>

                      <ul id="comments">
                         <li class="cmmnt">
                              <div class="avatar">
                                  <img src="{{asset('assets/images/user-male.png')}}" width="55" height="55" alt="avatar">
                              </div>

                              <div class="cmmnt-content">
                                  <header>
                                      <span class="label label-default username text-primary">Usuario 1</span> - <span class="pubdate">publicado hace 1 semana</span>
                                  </header>

                                  <div class="bs-callout bs-callout-info">
                                      <p>Ut nec interdum libero. Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus. Cras lacinia lorem sit amet augue mattis vel cursus enim laoreet. Vestibulum faucibus scelerisque nisi vel sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pellentesque massa ac justo tempor eu pretium massa accumsan. In pharetra mattis mi et ultricies. Nunc vel eleifend augue. Donec venenatis egestas iaculis.</p>
                                  </div>

								  <div class="reply-msg">
									  <a href="#">Responder</a>
								  </div>
                             </div>

                             <ul class="replies">
                                 <li class="cmmnt">
                                     <div class="avatar">
                                         <img src="{{asset('assets/images/user-female.png')}}" width="55" height="55" alt="avatar">
                                     </div>

                                     <div class="cmmnt-content">
                                         <header>
                                            <span class="label label-default username text-primary">Usuario 2</span> - <span class="pubdate">publicado hace 1 días</span>
                                         </header>

                                         <div class="bs-callout bs-callout-info">
                                             <p>Ut nec interdum libero. Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus. Cras lacinia lorem sit amet augue mattis vel cursus enim laoreet. Vestibulum faucibus scelerisque nisi vel sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pellentesque massa ac justo tempor eu pretium massa accumsan. In pharetra mattis mi et ultricies. Nunc vel eleifend augue. Donec venenatis egestas iaculis.</p>
                                         </div>

										 <div class="reply-msg">
											 <a href="#">Responder</a>
										 </div>
                                     </div>
                                 </li>
                             </ul>
                         </li>

                        <li class="cmmnt">
                            <div class="avatar">
                                <img src="{{asset('assets/images/user-male.png')}}" width="55" height="55" alt="avatar">
                            </div>

                          <div class="cmmnt-content">
                            <header>
                                <span class="label label-default username text-primary">Usuario 3</span> - <span class="pubdate">publicado hace 6 días</span>
                            </header>

                            <div class="bs-callout bs-callout-info">
                                <p>Ut nec interdum libero. Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus. Cras lacinia lorem sit amet augue mattis vel cursus enim laoreet. Vestibulum faucibus scelerisque nisi vel sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pellentesque massa ac justo tempor eu pretium massa accumsan. In pharetra mattis mi et ultricies. Nunc vel eleifend augue. Donec venenatis egestas iaculis.</p>
                            </div>

							<div class="reply-msg">
								<a href="#">Responder</a>
							</div>
                          </div>
                        </li>

                        <li class="cmmnt">
                            <div class="avatar">
                                <img src="{{asset('assets/images/user-male.png')}}" width="55" height="55" alt="avatar">
                            </div>

                          <div class="cmmnt-content">
                            <header>
                                <span class="label label-default username text-primary">Usuario 4</span> - <span class="pubdate">publicado hace 5 días</span>
                            </header>

                            <div class="bs-callout bs-callout-info">
                                <p>Ut nec interdum libero. Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus. Cras lacinia lorem sit amet augue mattis vel cursus enim laoreet. Vestibulum faucibus scelerisque nisi vel sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pellentesque massa ac justo tempor eu pretium massa accumsan. In pharetra mattis mi et ultricies. Nunc vel eleifend augue. Donec venenatis egestas iaculis.</p>
                            </div>

							<div class="reply-msg">
								<a href="#">Responder</a>
							</div>
                          </div>

                          <ul class="replies">
                            <li class="cmmnt">
                                <div class="avatar">
                                    <img src="{{asset('assets/images/user-female.png')}}" width="55" height="55" alt="avatar">
                                </div>

                              <div class="cmmnt-content">
                                <header>
                                    <span class="label label-default username text-primary">Usuario 5</span> - <span class="pubdate">publicado hace 3 días</span>
                                </header>

                                <div class="bs-callout bs-callout-info">
                                    <p>Ut nec interdum libero. Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus. Cras lacinia lorem sit amet augue mattis vel cursus enim laoreet. Vestibulum faucibus scelerisque nisi vel sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pellentesque massa ac justo tempor eu pretium massa accumsan. In pharetra mattis mi et ultricies. Nunc vel eleifend augue. Donec venenatis egestas iaculis.</p>
                                </div>

								<div class="reply-msg">
									<a href="#">Responder</a>
								</div>
                              </div>

                              <ul class="replies">
                                <li class="cmmnt">
                                    <div class="avatar">
                                        <img src="{{asset('assets/images/user-male.png')}}" width="55" height="55" alt="avatar">
                                    </div>

                                  <div class="cmmnt-content">
                                    <header>
                                        <span class="label label-default username text-primary">Usuario 4</span> - <span class="pubdate">publicado hace 2 días</span>
                                    </header>

                                    <div class="bs-callout bs-callout-info">
                                        <p>Ut nec interdum libero. Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus. Cras lacinia lorem sit amet augue mattis vel cursus enim laoreet. Vestibulum faucibus scelerisque nisi vel sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pellentesque massa ac justo tempor eu pretium massa accumsan. In pharetra mattis mi et ultricies. Nunc vel eleifend augue. Donec venenatis egestas iaculis.</p>
                                    </div>

									<div class="reply-msg">
									 	<a href="#">Responder</a>
								 	</div>
                                  </div>
                                </li>
                              </ul>
                            </li>
                          </ul>

                          <ul class="replies">
                            <li class="cmmnt">
                                <div class="avatar">
                                    <img src="{{asset('assets/images/user-male.png')}}" width="55" height="55" alt="avatar">
                                </div>

                              <div class="cmmnt-content">
                                <header>
                                    <span class="label label-default username text-primary">Usuario 6</span> - <span class="pubdate">publicado hace 5 días</span>
                                </header>

                                <div class="bs-callout bs-callout-info">
                                    <p>Ut nec interdum libero. Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus. Cras lacinia lorem sit amet augue mattis vel cursus enim laoreet. Vestibulum faucibus scelerisque nisi vel sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pellentesque massa ac justo tempor eu pretium massa accumsan. In pharetra mattis mi et ultricies. Nunc vel eleifend augue. Donec venenatis egestas iaculis.</p>
                                </div>

								<div class="reply-msg">
									<a href="#">Responder</a>
								</div>
                              </div>
                            </li>
                          </ul>
                        </li>

                <li class="cmmnt">
                    <div class="avatar">
                        <img src="{{asset('assets/images/user-female.png')}}" width="55" height="55" alt="avatar">
                    </div>

                  <div class="cmmnt-content">
                    <header>
                        <span class="label label-default username text-primary">Usuario 7</span> - <span class="pubdate">publicado hace 11 horas</span>
                    </header>

                    <div class="bs-callout bs-callout-info">
                        <p>Ut nec interdum libero. Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus. Cras lacinia lorem sit amet augue mattis vel cursus enim laoreet. Vestibulum faucibus scelerisque nisi vel sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pellentesque massa ac justo tempor eu pretium massa accumsan. In pharetra mattis mi et ultricies. Nunc vel eleifend augue. Donec venenatis egestas iaculis.</p>
                    </div>

					<div class="reply-msg">
						<a href="#">Responder</a>
					</div>
                  </div>
                </li>
            </ul>


            <div class="row">
                <div class="col-md-6">
                    <nav>
                        <ul class="pagination">
                          <li class="disabled"><a href="#" aria-label="Anterior"><span aria-hidden="true">«</span></a></li>
                          <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                          <li><a href="#" aria-label="Siguiente"><span aria-hidden="true">»</span></a></li>
                       </ul>
                   </nav>
                </div>
            </div>


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
<div class="scroll-top-wrapper hidden-xs" >
    <i class="fa fa-angle-up"></i>
</div>
<!-- /scroll top -->

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

<!--Summernote-->
<script type="text/javascript" src="{{asset('assets/js/vendors/summernote/summernote.min.js')}}"></script>

<!--Bootstrap-->
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat-->
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App-->
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery.uitablefilter/jquery.uitablefilter.js')}}"></script>
<!-- SCRIPT -->

@stop
