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
						{{ Lang::get('confide.invitation.account_confirmation.subject') }}
					</header>
				</td>
			</tr>
			<tr>	
				<td>
					<p style="margin-left:5%">
						{{ Lang::get('confide.invitation.account_confirmation.greetings', array('name' => $email)) }}
					</p>
					
					<p style="margin-left:5%" class="primary">¡Has sido cordialmente invitado a unirte a HABITARIA!</p> 
					<p style="margin-left:5%" class="primary">{{ strtoupper($name_inv) }} {{ strtoupper($lname_inv) }} quiere que seas parte de la Colonia "{{ strtoupper($urbanism) }}".</p>
					
					<p style="margin-left:5%" class="primary">HABITARIA es un lugar en internet que se encarga principalemnte de administrar---</p>

					<p style="margin-left:5%" class="primary">{{ Lang::get('confide.invitation.account_confirmation.body') }}</p>
					<a style="margin-left:5%" href="{{URL::action($link,$code)}}">
						{{substr(URL::action($link,$code), 0, 80) }}
					</a>
					<br>
					<p style="margin-right:2%" align="right">¡{{ Lang::get('confide.invitation.account_confirmation.farewell') }}!</p>

				</td>
			</tr>
			
			<tr>
				<td><img src="{{asset('assets/images/mail/divisor.jpg')}}" class="divisor"></td>
			</tr>
		</table>
	</center>
</body>
