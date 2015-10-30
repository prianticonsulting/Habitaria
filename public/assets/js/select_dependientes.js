//JavaScript
// select dependientes configurar colonias

$(document).ready(function(){
	
		$('#country').change(function(){	
			$.get("{{ url('listStates')}}",
			{ country: $(this).val() },
			function(data) {
				$('#state').empty();
				$('#state').append($('<option></option>').text('Seleccione Estado').val('')); 
				$.each(data, function(i) {
					$('#state').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
				});
			}, "json");
		});	
		
	$('#state').change(function(){
			$.get("{{ url('listCities')}}",
			{ state: $(this).val() },
			function(data) {
				$('#city').empty();
				$('#city').append($('<option></option>').text('Seleccione Ciudad').val('')); 
				$.each(data, function(i) {
					$('#city').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
				});
			}, "json");
		});	
		
	});	
	