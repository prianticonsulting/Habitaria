<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HABITARIA</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/index/css/bootstrap.min.css')}}" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('assets/index/css/font-awesome.min.css')}}" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{asset('assets/index/css/animate.min.css')}}" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/index/css/creative.css')}}" type="text/css">

	<link rel="stylesheet" href="{{asset('assets/css/styles2.css')}}" type="text/css">

	<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/index/images/favicon/android-icon-192x192.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/index/images/favicon/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/index/images/favicon/favicon-96x96.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/index/images/favicon/favicon-16x16.png')}}">
	<!--

    HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <p class="text-red">
                    <img class="logo" src="{{asset('assets/index/images/ui-sam.png')}}" width="50" height="50" alt=""/>
                    v 1.0.4
                </p>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li>
					<!--LOGIN -->
						<form id="correo" method="POST" action="{{ URL::to('users/login') }}" accept-charset="UTF-8">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="loginbox">
								<label class=" topbox userbox">
								  <input type="email" name="email" id="email" value="{{Input::old('email')}}" class="user index_input" placeholder="Email" autocomplete="on" required>
								</label>

								<label class="t1-label password js-password box">
									<input type="password" name="password" id="password"  class="js-password-field pass index_input" placeholder="Contraseña" required>
								</label>

								<button type="submit" class="page-scroll">Iniciar sesión</button>
							</div>

                            <a href="{{URL::to('users/forgot_password')}}">¿Has olvidado la contraseña? Click Aqui</a>

						</form>
					<!--/LOGIN -->
                    </li>

                    <li>
                      <a class="page-scroll contacto" href="#contacto">Contacto</a>
                    </li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>HABITARIA</h1>
                <hr>
                <p>Administra tu colonia, colonia privada o edificio de departamentos</p>
				<br>Si tu colonia ya esta dada de alta espera la invitación de tu administrador</br>
				<br>Si eres administrador y aun no has dado de alta tu colonia utiliza el botón REGISTRA TU COLONIA AQUÍ</br>
				<p></p>
                <a href="{{URL::route('users.registro.admin')}}" class="btn btn-primary btn-xl page-scroll">Registra tu Colonia aqui</a>
            </div>
        </div>
    </header>
<section class="no-padding" id="portfolio">
    <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">                        </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">                        </a>
                </div>
                <div class="col-lg-4 col-sm-6"> </div>
                <div class="col-lg-4 col-sm-6"> </div>
                <div class="col-lg-4 col-sm-6"> </div>
                <div class="col-lg-4 col-sm-6"> </div>
            </div>
        </div>
    </section>
<section id="contacto">
    <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">CONTACTANOS</h2>
                    <hr class="primary">
				{{ Form::open(['route'=>'users.contacto','files'=>'true', 'id'=>'correo']) }}

									<label  class="input info_contact">
										<input style="width:67%; margin-bottom: 10px;" type="text" name="firstname"  placeholder="Tu Nombre *" required>
									</label>

									<label  class="input info_contact" id="label_email">
										<input style="width:67%; margin-bottom: 10px;" type="email" name="email"  placeholder="Tu Email *" id="email" required>
									</label>

									<label  class="input info_contact">
										<input style="width:67%; margin-bottom: 10px;"  type="number" name="phone"  placeholder="Tu Telefono *" required>
									</label>


								<textarea name ="texto" id ="texto" class="form-control" rows="5" placeholder="Tu Mensaje *" required></textarea>

						<p>
						<footer>
						  <button style="float:center;" type="submit" class="page-scroll" id="Enviar">Enviar Mensaje</button>
						</footer>
                {{ Form::close() }}
                </div>
				
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>Ph. +52 (81) 8881 7204 </p>       
                </div>
              
        </div> <div  align="right"><a href="http://prianticonsulting.com/" target="new"><img src="{{asset('assets/index/images/Logo_Prianti [Converted].png')}}" width="100" height="45" alt=""/></a> </div>
    </section>
    


<div class="modal" id="modal_msg">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <span class="text-dark-blue"> Leer por favor </span>
      <div class="modal-body text-center">
				<div class="callout callout-info">
							<h4>{{ Session::get('notice')}}</h4>
						</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>

<div class="modal" id="modal_error">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <span class="text-dark-red"> Leer por favor </span>
      <div class="modal-body text-center">
				<div class="callout callout-danger">
							<h4>{{ Session::get('error')}}</h4>
				</div>
			@if(Session::has('recuperar_pass'))
			<div class="row">
              <div class="col col-8">
				¿Olvidaste tu contraseña? haz clic <a href="{{URL::route('forgot')}}">aquí</a>
              </div>
            </div>
			@endif
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
    <!-- jQuery -->
	<script type="text/javascript" src="{{asset('assets/index/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

    <!-- Plugin JavaScript -->
	<script type="text/javascript" src="{{asset('assets/index/js/jquery.easing.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/index/js/jquery.fittext.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/index/js/wow.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
	<script type="text/javascript" src="{{asset('assets/index/js/creative.js')}}"></script>


	<script type="text/javascript">

@if(Session::has('notice'))
	window.onload = function() {
	$('#modal_msg').modal();
	};
@endif
@if(Session::has('error'))
	window.onload = function() {
	$('#modal_error').modal();
	};
@endif


	</script>


</body>

</html>
