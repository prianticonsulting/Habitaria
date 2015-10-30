<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Documento sin título</title>
<style type="text/css">
body {
	background-repeat: no-repeat;
	text-align: center;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;
}

.margen-left {
	text-align: left;
	left:10px;
}
</style>
</head>
<body>
<table  width="650" height="124" align="center" background="{{asset('assets/images/mail/header2.jpg')}}">	
	<tr>	
	<td width="170" valign="top">
	<a href="http://habitaria.mx/dev/public/"  target="_blank"><input type="image" src="{{asset('assets/images/mail/logo.jpg')}}" value="logo"></a>
	</td>	
	<td width="480" valign="top" align="right">
	<span style="font-size: 26px; font-weight: lighter;"> Información </span><br> 
	<span style="font-size: 20px; font-weight: lighter;"> {{$coloniaName->name}}</span><br>
	</td> 	
	</tr> 	
</table>

<table style="width:650px" align="center">
			<tr>
				<td><img src="{{asset('assets/images/mail/divisor.jpg')}}"></td>
			</tr>
			<tr>
				<td>
					<header style="font-size:30pt;text-align:right;font-style:oblique;">
						
					</header>
				</td>
			</tr>
			<tr>	
				<td>
					<p style="margin-left:5%">
						 {{$contenido}}
					</p>
					
					<p style="margin-left:5%"></p>
					
						
					</a>
					<br>
					<p style="margin-right:2%" align="right"></p>

				</td>
			</tr>
			
			<tr>
				<td><img src="{{asset('assets/images/mail/divisor.jpg')}}" class="divisor"></td>
			</tr>
</table>
	 
</table>

</body>
</html>