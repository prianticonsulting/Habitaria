var email1 = $("#email1");

function comprobacionTerminada (data) {
	if (data.dato == 2) {
		email1.popover("show");
		
		document.getElementById('registrate').disabled = true;
		
		email1.click(function(){
			email1.popover("hide");
		});
	}else{
		document.getElementById('registrate').disabled = false;
	}
}

function permisoEstado (id) {
	if ($(id).is(":checked")) {
		return 1;
	} else {
		return 0;
	}
}

function cambioPermisosTerminado (data) {
	$("#mnj").css({"display":"block"})
	if(data.estado == 1){
		$("#mnj").removeClass("callout-warning");
		$("#mnj").addClass("callout-info");
		$("#mnj").html("<p>Cambios realizados con éxito</p>");
		permiso = "";
		permisos = "";
		setTimeout(function() {
        $("#mnj").fadeOut(1000);
		},3000);
	}

}
function cambiarTablaPermisos (data) {
	$("#caragarPanel").html("");
	$("#caragarPanel").append(data.datos);
	rolesChange();
	cambiarPermiso();
	botonCambiarPermiso();
}


function rolesChange () {
	 permisos = "";
	 $("#roles").change(function(){
		var rol = $("#roles option:selected").text();
		          $("#tituloRol").html(rol);
		          $(".table").attr("data-rol",$("#roles").val());
		   	$.ajax({
				url: "cambiartablapermisos",
				type:"POST",
				data:{
					id: $("#roles").val(),
					role: rol,  
				},
				dataType: "json",
				success: cambiarTablaPermisos
			});
	});
}

function cambiarPermiso () {
	$(".cambioPermiso").change(function(){
		var rolValor = $(".table").attr("data-rol");
		var permisoId = $("#"+this.id).attr("data-id");
		var estado = permisoEstado("#"+this.id);
		permisos = permisos +","+permisoId+"."+estado+'la cabeza del guebo';
		console.log(permisos);
		/**/
	});
}

function botonCambiarPermiso () {
	
	$("#botonCambiarPermisos").click(function(){
		if (permisos != null && permisos != "") {
		var permiso = permisos.substr(1);
		console.log(permiso);
		$.ajax({
				url: "cambiarpermisos",
				type:"POST",
				data:{
					datos: permiso
				},
				dataType: "json",
				success: cambioPermisosTerminado
			});
		 } else {
   			$("#mnj").removeClass("callout-info");
			$("#mnj").addClass(" callout-warning");
			$("#mnj").html("<p>No a realizado cambios en ningun permiso</p>");
			$("#mnj").css({"display":"block"})
			setTimeout(function() {
			$("#mnj").fadeOut(1000);
			},3000);
   		}
	});
}

function crearRolTerminado (data) {
	if (data.estado == 1) {
		$("#rol").attr("data-content","Registro Exitoso")
		$("#rol").popover("show");
		$("#rol").val("");
		$("#cargarTabla").html(data.html);
		eliminarRol();
	} else {
		$("#rol").attr("data-content",data.error.rol);
		$("#rol").popover("show");
	}
	$("#rol").click(function(){
		$("#rol").popover("hide");
	});
}

function asignarRolTerminado (data) {
	$("#msj").css({"display":"block"})
	if(data.estado == 1){
		$("#msj").addClass("callout-warning");
		$("#msj").html("<h4>Cambios realizados con éxito</h4>");
		$("#msj").css({"display":"block"})
		setTimeout(function() {
		$("#msj").fadeOut(1000);
		},3000);
		rol = "";
		roles = "";
	}
}

function eliminarRolTerminado (data) {
	$(".alert").css({"display":"block"})
	if(data.estado == 1) {
		$(".alert").removeClass("alert-success");
		$(".alert").addClass("alert-warning");
		$(".alert").html("<strong>No es posible eliminar el rol, desvincule los usuarios asignados al rol</strong>");
		$(".eliminar").removeClass("btn-default");
		$(".eliminar").addClass("btn-danger");
	} else {
		$(".alert").removeClass("alert-warning");
		$(".alert").addClass("alert-success"); 
		$(".alert").html("<strong>El rol fue eliminado con exito</strong>");
		$("#cargarTabla").html(data.html);
		eliminarRol();
		$(".eliminar").removeClass("btn-default");
		$(".eliminar").addClass("btn-danger");
	}
	
}

function eliminarRol () {
	$(".eliminar").click(function(){
		$(".alert").click(function(){
			$(".alert").css({"display":"none"})
		});	
		$(this).addClass("btn-default");
		$.ajax({
				url: "eliminarrol",
				type:"POST",
				data:{
					rol:this.name
				},
				dataType: "json",
				success: eliminarRolTerminado
			});
	});
}
$(document).ready(function(){

	roles = "";
	permisos = "lacabeza";
	cambiarPermiso();
	rolesChange();
	email1.blur(function () {
		if (email1.val() != "" && email1.val() != null)	{
			$.ajax({
				url: "usuario",
				type:"POST",
				data:{email:email1.val()},
				dataType: "json",
				success: comprobacionTerminada
			});
		}
	});
	$("#crear").click(function(){
		$.ajax({
				url: "crearrol",
				type:"POST",
				data:{rol:$("#rol").val()},
				dataType: "json",
				success: crearRolTerminado
			});
	});

	/* asignar rol antes del cambio */
	$(".asignarRol").change(function(){
		roles = roles +","+this.value;
		/*$.ajax({
				url: "asignarrol",
				type:"POST",
				data:{
					rol:this.value
				},
				dataType: "json",
				success: asignarRolTerminado
			});*/
	});

	$("#botonAsignarRol").click(function(){
		rol = roles.substr(1);
		$("#msj").click(function(){
			$("#msj").css({"display":"none"})
		});
		if (rol != null && rol != "") {
			$.ajax({
				url: "asignarrol",
				type:"POST",
				data:{
					rol:rol
				},
				dataType: "json",
				success: asignarRolTerminado
			});
		} else {
				$("#msj").addClass("callout-warning");
				$("#msj").html("<h4>No ha realizado cambios en ningún rol</h4>");
				$("#msj").css({"display":"block"})
				setTimeout(function() {
				$("#msj").fadeOut(1000);
				},3000);
	}});

	$(".eliminar").click(function(){
		$(".alert").click(function(){
			$(".alert").css({"display":"none"})
		});	
		$.ajax({
				url: "eliminarrol",
				type:"POST",
				data:{
					rol:this.name
				},
				dataType: "json",
				success: eliminarRolTerminado
			});
	});
	eliminarRol();
	botonCambiarPermiso();
});

//Función para validar datalist de la parte de ingresos
function validarData(){ 
		var text = document.getElementById("neighbor_property_id"),
        element = document.getElementById("list");
            
            if(element.querySelector("option[value='"+text.value+"']"))
			{
				document.cobrar.submit();
            }
			else
			{
				if(text.value != '')
				{
					text.value ="";
					$("#msj").addClass("callout-warning");
					$("#msj").html("<h4>Debe seleccionar un residente de la lista</h4>");
					$("#msj").css({"display":"block"})
					setTimeout(function() {
					$("#msj").fadeOut(1000);
					},3000);
				}
			}
} 