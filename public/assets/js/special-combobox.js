//******FOR COMPANIES
	//SHOW RESIDENT
		$('.resident').on('focusout', function(e){
			document.getElementById("houses").style.display = "inline";
		});
	//SHOW STATE
		$('#address').on('input', function(e){
			document.getElementById("state").style.display = "inline";
		});
		
	//SHOW COUNTIES
		$('#state').on('change', function(e){
				var state_id = e.target.value;
				var state_name = e.target.options[e.target.selectedIndex].text;
				
				//ajax
				
				$.get('ajax-counties?state_id=' + state_id, function(data){
					
					//success data
					document.getElementById("county").style.display = "inline";
					
					$('#county').empty();
					$('#county').append($('<option></option>').text('Select a County of '+ state_name +'').val('')); 
					$.each(data, function(index, countyObj){
						$('#county').append('<option value="'+countyObj.id+'">'+countyObj.name+'</option>');
						
					});
					
				});
		
		});
		
	//SHOW CITIES
		$('#county').on('change', function(e){
				var county_id = e.target.value;
				var county_name = e.target.options[e.target.selectedIndex].text;
				//ajax
				
				$.get('ajax-cities?county_id=' + county_id, function(data){
					
					//success data
					document.getElementById("city").style.display = "inline";
					
					$('#city').empty();
					$('#city').append($('<option></option>').text('Select a City of '+ county_name +'').val('')); 
					$.each(data, function(index, cityObj){
					
							
							$('#city').append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
						
					});
					
				});
		
		});
//

//******FOR FILES

	//SOURCE ADDRESS
		
		$('#state_a').on('change', function(e){
					var state_id = e.target.value;
					var state_name = e.target.options[e.target.selectedIndex].text;
					
					//ajax
					
					$.get('ajax-counties?state_id=' + state_id, function(data){
						
						//success data
						
						$("#county_a").removeAttr('readonly');
						
						$('#county_a').empty();
						$('#county_a').append($('<option></option>').text('Select a County of '+ state_name +'').val('')); 
						$.each(data, function(index, countyObj){
							$('#county_a').append('<option value="'+countyObj.id+'">'+countyObj.name+'</option>');
							
						});
						
					});
			
			});
			
		//SHOW CITIES
			$('#county_a').on('change', function(e){
					var county_id = e.target.value;
					var county_name = e.target.options[e.target.selectedIndex].text;
					//ajax
					
					$.get('ajax-cities?county_id=' + county_id, function(data){
						
						//success data
						
						$("#city_a").removeAttr('readonly');
						
						$('#city_a').empty();
						$('#city_a').append($('<option></option>').text('Select a City of '+ county_name +'').val('')); 
						$.each(data, function(index, cityObj){
						
								
								$('#city_a').append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
							
						});
						
					});
			
			});
		
		//
	//
	
	//DESTINATION ADDRESS
		//SHOW COUNTIES
			$('#state_b').on('change', function(e){
					var state_id = e.target.value;
					var state_name = e.target.options[e.target.selectedIndex].text;
					
					//ajax
					
					$.get('ajax-counties?state_id=' + state_id, function(data){
						
						//success data
						
						$("#county_b").removeAttr('readonly');
						
						$('#county_b').empty();
						$('#county_b').append($('<option></option>').text('Select a County of '+ state_name +'').val('')); 
						$.each(data, function(index, countyObj){
							$('#county_b').append('<option value="'+countyObj.id+'">'+countyObj.name+'</option>');
							
						});
						
					});
			
			});
			
		//SHOW CITIES
			$('#county_b').on('change', function(e){
					var county_id = e.target.value;
					var county_name = e.target.options[e.target.selectedIndex].text;
					//ajax
					
					$.get('ajax-cities?county_id=' + county_id, function(data){
						
						//success data
						
						$("#city_b").removeAttr('readonly');
						
						$('#city_b').empty();
						$('#city_b').append($('<option></option>').text('Select a City of '+ county_name +'').val('')); 
						$.each(data, function(index, cityObj){
						
								
								$('#city_b').append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
							
						});
						
					});
			
			});
		//
	//	
//
