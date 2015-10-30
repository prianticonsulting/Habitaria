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
						{{ Lang::get('confide::confide.invitation.account_confirmation.subject') }}
					</header>
				</td>
			</tr>
			<tr>	
				<td>
					<p style="margin-left:5%">
						Hola {{ $vecino->name }} {{ $vecino->last_name }}
					</p>
					
					<p style="margin-left:5%">
						{{ $name_inv }} {{ $lname_inv }} lo ha invitado a unirse al sitio de adminitración HABITARIA de la urbanización "{{ $urbanism }}".
					</p>

					<p style="margin-left:5%">Por favor acceda al siguiente enlace para culminar con su registro:</p>
					<a style="margin-left:5%" href="{{URL::action('ConfirmationController@culminate_reg_neighbor',$code)}}">
						{{substr(URL::action('ConfirmationController@culminate_reg_neighbor',$code), 0, 80) }}
					</a>
					<br>
					<p style="margin-right:2%" align="right">¡{{ Lang::get('confide::confide.email.account_confirmation.farewell') }}!</p>

				</td>
			</tr>
			
			<tr>
				<td><img src="{{asset('assets/images/mail/divisor.jpg')}}" class="divisor"></td>
			</tr>
		</table>
	</center>
</body>
