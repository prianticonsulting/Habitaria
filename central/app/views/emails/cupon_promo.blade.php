<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
.coupons {
	position: relative;
	margin-bottom: 20px;
	border-radius: 4px;
	min-height: 60px;
	text-align: center;
	box-shadow: 0 1px 1px rgba(0,0,0, .05);
	background: #c6d5d3;
	height:150px;
	width:500px;
}
.coupons-inner {
	margin-left: 50px;
	font-size: 0.85em;
	font-weight: 600;
	border-left: 5px dashed #fff;
	padding: 15px;
	background: #ddd
}
.coupons:before {
	content: "";
	position: absolute;
	top: 45%;
	left: 15px;
	width: 15px;
	height: 15px;
	background: #fff;
	border-radius: 50%;
}
.coupons-code {
	font-size: 1.7em;
	font-weight: 800;
	color: #fff;
	padding: 5px;
	margin-top: 5px;
	background-color: #858689;
}
.coupons .one-time {
	margin-top: 10px;
	color: #999;
	border: 2px solid #999;
	display: inline-block;
	padding: 3px 7px;
	font-weight: 800;
	font-size: 0.75em
}
.text-green {
	color: #82b964
}
.text-dark-blue {
	color: #3b8dbd
}
.powerwidget .inner-spacer {
	padding: 10px;
	border-bottom-left-radius: 3px;
	border-bottom-right-radius: 3px;
}
</style>	
</head>

<body>
	<center>
		<table style="width:650px">
			<tr>
				<td><img src="{{asset('assets/images/mail/divisor.jpg')}}"></td>
			</tr>
			<tr>
				<td>
					<header style="font-size:30pt;text-align:right;font-style:oblique;">
						Cupón de Promoción 
					</header>
				</td>
			</tr>
			<tr>
				<td>				
					<p style="margin-left:5%">
						Hola {{ $admin }}, usted ha recibido un cupón de promoción para ser activado en la colonia {{ $colony }} para extender su versión de prueba en HABITARIA.
					</p>
				</td>
			</tr>
			<tr>
				<td>
				<center>
				<div class="inner-spacer">
				   <div class="coupons">
                    <div class="coupons-inner"><span style="text-transform: uppercase">Cupón de activación de la promoción. Valido por: </span> <span class="text-dark-blue"  style="text-transform: uppercase">{{ $days }} DÍAS </span>
                      <div class="coupons-code"><span class="text-green" style="font-size:15px;">{{ $code }}</span></div>
                      <div class="one-time"  style="text-transform: uppercase">Este cupón solo puede ser usando una vez</div>
                    </div>
                  </div>
				 </div>
				</center>
				</td>			
			</tr>
			<tr>	
			<td>
					<br>
					<p style="margin-right:2%" align="right">¡Saludos!</p>

				</td>
			</tr>
			
			<tr>
				<td><img src="{{asset('assets/images/mail/divisor.jpg')}}" class="divisor"></td>
			</tr>
			
		</table>
	</center>
</body>
