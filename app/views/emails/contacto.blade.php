<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body>
	<center><img src="{{asset('assets/images/mail/header.jpg')}}" style="font-family: sans-serif;font-size:12pt;"></center>
	<center>
		<table style="width:650px">
			<tr>
				<td><img src="{{asset('assets/images/mail/divisor.jpg')}}"></td>
			</tr>
			<tr>
				<td>
					<header style="font-size:30pt;text-align:right;font-style:oblique;">
						 <b>Nuevo Mensaje de Contacto</b>
					</header>
				</td>
			</tr>
			<tr>	
				<td>
					<p style="margin-left:5%">
						<b>Nombre:</b> {{strtoupper($nombre)}}.
					</p>
					<p style="margin-left:5%">
						<b>Correo:</b> {{strtolower($contacto)}}.
					</p>
					<p style="margin-left:5%">
						<b>Telefono:</b> {{$telefono}}.
					</p>
					
					<p style="margin-left:5%"> <b>Mensaje:</b>  {{strtoupper($mensaje)}}</p>
				</td>
			</tr>
			
			<tr>
				<td><img src="{{asset('assets/images/mail/divisor.jpg')}}" class="divisor"></td>
			</tr>
		</table>
	</center>
</body>
