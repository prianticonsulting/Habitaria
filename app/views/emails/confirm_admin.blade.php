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
						{{ Lang::get('confide::confide.email.account_confirmation.subject') }}
					</header>
				</td>
			</tr>
			<tr>	
				<td>
					<p style="margin-left:5%">
						{{ Lang::get('confide::confide.email.account_confirmation.greetings', array('name' => (isset($user['username'])) ? $user['username'] : $user['email'])) }},
					</p>
					
					<p style="margin-left:5%">{{ Lang::get('confide::confide.email.account_confirmation.body') }}</p>
					<a style="margin-left:5%" href='{{{ URL::to("users/confirm/{$user['confirmation_code']}") }}}'>
						{{{ URL::to("users/confirm/{$user['confirmation_code']}") }}}
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
