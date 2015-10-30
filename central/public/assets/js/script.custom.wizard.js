	var num = 0;
	var nu = 0;	
	var calle_cero = 0;
	
	evento = function (evt) {
	return (!evt) ? event : evt;
}

  addStreet = function () { 
	
	var street = document.getElementById("street_field").value;
	
	if(isNaN(street)) {
		document.getElementById("table2").style.display='inline';
		document.getElementById("location2").checked= 1;
		document.getElementById("street_field").value = "";
	
		calle_cero = ++nu;
		
		var input  	= document.createElement("input");
		var tr  	= document.createElement("TR");
		var td  	= document.createElement("TD");
		var t 		= document.createTextNode(street);
		
		
		input.type	= 'hidden';
		input.name	= 'streets[]';
		input.value	= (street);
		input.id 	= 'street' + (++num);
		
		
		td.style.fontWeight = "600";
		td.name		= 'names[]';
		
		tr.className= 'text-info';
		tr.id 		= input.id;
		
		a 			= document.createElement('i');
		a.name		= tr.id;
		a.style.float	= 'right';
		a.style.cursor	= 'pointer';
		a.className		= 'icon fa fa-trash-o';
		a.onclick		= deleteStreet;
		
		tr.appendChild(td);
		td.appendChild(t);
		td.appendChild(a);


	   container = document.getElementById('streets');
	   container.appendChild(tr);
	   container.appendChild(input);
		
	}

}


deleteStreet= function (evt){
   evt = evento(evt);
   
   td = rObj(evt);
   td_field = document.getElementById(td.name);
   td_field.parentNode.removeChild(td_field); 
   
   input = rObj(evt);
   input_field = document.getElementById(input.name);
   input_field.parentNode.removeChild(input_field); 

	calle_cero= --nu;
	
	if(calle_cero == 0) {
	  document.getElementById("location2").checked= 0; 
	  document.getElementById("table2").style.display='none';
	}	  
}


addMail = function () { 
	var emails 		= document.getElementById("email_field").value;
	var emailArray	= emails.split("\n",10);
	var invalidos = "";
	document.getElementById("email_field").value = "";
  
	var uniq = emailArray.reduce(function(a,b){
		if (a.indexOf(b) < 0 ) a.push(b);
		return a;
	},[]);
	
	var mail 		= "";

	uniq.forEach( function (mail)
	{
	
			expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if ( expr.test(mail) ){
				
			document.getElementById("email_invalidos").innerHTML="";
			
			document.getElementById("mail_area").style.display='block';
			
			document.getElementById("email2").checked= 1;
			document.getElementById("email_field").value = "";
		
			var input  	= document.createElement("input");
			var button  = document.createElement("BUTTON");
			var t 		= document.createTextNode(mail);
			
			input.type	= 'hidden';
			input.name	= 'mails[]';
			input.value	= (mail); 
			input.id 	= 'mail' + (++num);
			
			button.name		= 'invitation[]';
			button.className= 'btn btn-warning btn-xs';
			button.type		= 'button';
			button.style.paddingRight="25px";
			button.id 		= input.id;
			
			i 				= document.createElement('i');
			i.name			= button.id;
			i.style.cursor		= 'pointer';
			i.style.marginLeft	= '-3%';
			i.style.marginRight	= '1.5%';
			i.style.marginBottom= '2%';
			i.style.color	= '#FFFFFF';
			i.className		= 'fa fa-times-circle';
			i.onclick		= deleteMail;
			i.id			= button.id;
			
			
		
			button.appendChild(t);
			
			container = document.getElementById("mail_area");
			container.appendChild(button);
			container.appendChild(i);
			container.appendChild(input);
		   
		   }else{
					invalidos=invalidos+mail+"\n";
					document.getElementById("email_invalidos").innerHTML="Formato inválido";
				}

	});
	
	if(invalidos){

				document.getElementById("email_field").value = invalidos.slice(0,-1);
			}
}


deleteMail = function (evt){
   evt = evento(evt);

   button = rObj(evt);
   button_new	= document.getElementById(button.name);
   button_new.parentNode.removeChild(button_new); 
   
   input = rObj(evt);
   input_field = document.getElementById(input.name);
   input_field.parentNode.removeChild(input_field); 
   
   i = rObj(evt);
   i_new= document.getElementById(i.id);
   i_new.parentNode.removeChild(i_new);
   
   
}
	
rObj = function (evt) { 
   return evt.srcElement ?  evt.srcElement : evt.target;
}


