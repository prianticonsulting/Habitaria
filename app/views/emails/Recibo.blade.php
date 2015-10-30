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
<table width="650" height="124" align="center" background="{{asset('assets/images/mail/header.jpg')}}">
	<tr>
	<td width="480" valign="top" align="right">
	<span style="font-size: 26px; font-weight: lighter;"> RECIBO DE PAGO </span><br>
	<span style="font-size: 20px; font-weight: lighter;"> {{ucwords($colonia)}} </span><br>
<!-- 	<span style="font-size: 20px; font-weight: lighter;"> {{ucwords($urbanismo)}} </span><br> -->
	<span style="font-size: 20px;"> {{$ciudad}}, {{$estado}} </span> 
	</td>
	</tr>
</table>

<table width="650" height="300" align="center">
<tr>
	<td bgcolor="#E4FFEB" align="left" style="padding-left: 2%" width="400">NOMBRE</td>
	<td bgcolor="#E4FFEB" align="center">FECHA</td>
</tr>
<tr>
	<td bgcolor="#9CFFB7" align="left" style="padding-left: 2%; font-weight: bold"> {{$Nombre}} </td>
	<td bgcolor="#9CFFB7" style="font-weight: bold" align="center"> {{$Fecha}} </td>
</tr>
<tr>
	<td bgcolor="#E4FFEB" align="left"  style="padding-left: 2%">DOMICILIO</td>
	<td bgcolor="#E4FFEB"></td>
</tr>
<tr>
	<td bgcolor="#9CFFB7" style="padding-left: 2%; font-weight: bold" align="left" > {{$Domicilio}} </td>
	<td bgcolor="#9CFFB7"></td>
</tr>
<tr>
	<td bgcolor="#E4FFEB" align="left" style="padding-left: 2%">COBRADOR</td>
	<td bgcolor="#E4FFEB"  align="center">MONTO</td>
</tr>
<tr>
	<td bgcolor="#9CFFB7" align="left"  style="padding-left: 2%; font-weight: bold">{{$Cobrador}}</td>
	<td bgcolor="#9CFFB7" style="font-weight: bold; font-size: 26px;" align="center"> ${{number_format($monto,2,'.',',')}} </td>
</tr>
</table>

<table width="650" height="408" align="center" background="{{asset('assets/images/mail/factura_pagado.jpg')}}" >
<tr valign="top" style="text-align: right;font-weight: lighter; font-size: 28px;">
	<td align="center"><br>
	<span style="font-style: inherit; font-weight: bolder;">GRACIAS POR SU PAGO</span><br>
	<FONT><br><span style="font-size: 24px">COMITÉ DE ADMINISTRACIÓN</span></FONT>
	</td>
</tr>
</table>

<table width="650" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#D0FFDD" style="table-layout:fixed">
  <tbody>
    <tr style="text-align:center">
      <td @if($m=1 < $mes_ini) style="background-color: #EDECEC;" @endif>	ENE</td>
      <td @if($m=2 < $mes_ini) style="background-color: #EDECEC;" @endif>	FEB</td>
      <td @if($m=3 < $mes_ini) style="background-color: #EDECEC;" @endif>	MAR</td>
      <td @if($m=4 < $mes_ini) style="background-color: #EDECEC;" @endif>	ABR</td>
      <td @if($m=5 < $mes_ini) style="background-color: #EDECEC;" @endif>	MAY</td>
      <td @if($m=6 < $mes_ini) style="background-color: #EDECEC;" @endif>	JUN</td>
      <td @if($m=7 < $mes_ini) style="background-color: #EDECEC;" @endif>	JUL</td>
      <td @if($m=8 < $mes_ini) style="background-color: #EDECEC;" @endif>	AGO</td>
      <td @if($m=9 < $mes_ini) style="background-color: #EDECEC;" @endif>	SEP</td>
      <td @if($m=10 < $mes_ini) style="background-color: #EDECEC;" @endif>	OCT</td>
      <td @if($m=11 < $mes_ini) style="background-color: #EDECEC;" @endif>	NOV</td>
      <td @if($m=12 < $mes_ini) style="background-color: #EDECEC;" @endif>	DIC</td>
    </tr>

				@foreach($payments as $payment)

							<tr>

								@for($i=0; $i<=11; $i++)

									@if($payment->$months[$i] == Null || $payment->$months[$i] < $cuotas[ $months[$i] ] )

										@if($i+1 < $mes_ini)
											<td style="background-color: #EDECEC;">&nbsp;</td>
										@else

											@if(	$i+1 == date("m")	)
											<td style="background-color: #9CFFB7;">&nbsp;</td>
											@else
											<td>&nbsp;</td>
											@endif

										@endif

									@else

											@if ( $payment->$months[$i] > $cuotas[ $months[$i] ] || $payment->$months[$i] == $cuotas[ $months[$i] ] )

												@if(	$i+1 == date("m")	)
													<td style="background-color: #9CFFB7;"><input type="image" src="{{asset('assets/images/mail/check.png')}}" value="pagado"></td>
												@else
													<td><input type="image" src="{{asset('assets/images/mail/check.png')}}" value="pagado"></td>
												@endif

											@else

												<td> &nbsp; </td>

											@endif

									@endif

								@endfor

								</tr>

				@endforeach

  </tbody>
</table>

</body>
</html>
