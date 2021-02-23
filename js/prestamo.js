// JavaScript Document
$(document).ready(
	function(){
		$("#menu #sMenu").hide();
		
		$("#menu div[id^=\"op_\"]").click(
			function(){
				switch($(this).attr("id")){
					case "op_1":
						window.location.href = "prestamo.php?op=1";
					break;
					case "op_2":
						window.location.href = "prestamo.php?op=2";
					break;
					case "op_3":
						window.location.href = "prestamo.php?op=3";
					break;
					case "op_4":
						window.location.href = "prestamo.php?op=4";
					break;
					default:break;
				}
			}
		);
		
		//$("#contenido").css({"height":"380px"});
		
		/***/
		/*para el formulario de prestamo*/
		/****/
		VerNumeroPrestamo();
		$("#BusquedaDocs #datosBusqueda").hide();
		$("#BusquedaDocs #resultadoBusqueda").hide();
		
		$("#BusquedaDocs #mostrarBusqueda").click(
			function(){
				$("#BusquedaDocs #datosBusqueda").toggle();
				$("#BusquedaDocs #resultadoBusqueda").toggle();
			}
		);
		$("#BusquedaDocs #botonBuscar").click(buscarDocs);
		$("#botonPrestar").click(RegistrarPrestamo);
		$("#botonCancelar").click(CancelarPrestamo);
		$("#cerrarS").click(
			function(){
				$.post("phps/control.php",{"opcion":"2"});
				window.location.href = "acceso.html";
			}
		);		
	}
);
/****/

/**prestamo*/
/*****/
buscarDocs = function(){
	numero = $("#texto").val();
	if($.trim(numero)!=""){
		$.post(
			"phps/fprestamo.php",
			{"opcion":"1","numero":numero},
			function(data){
				$("#BusquedaDocs #resultadoBusqueda").html(data);
			}
		);
	}	
}

AgregarDoc = function(idDoc){
	$.post(
		"phps/fprestamo.php",
		{"opcion":"2",
		 "idDoc":idDoc,
		 "idPrestamo":$("#formDatos input[id=\"inpres\"]").val()},
		function(data){
			$("#DocPrestados").html(data);
		}
	);		
}

VaciarTablaDetalle = function(){
	$.post(
		"phps/fprestamo.php",
		{"opcion":"3"},
		function(data){
			//$("#DocPrestados").html(data);
		}
	);
}

CamposVacios = function(){
	error = {std:true,texto:""};
	$("#formDatos input[type=text]").each(
		function(){
			if($.trim($(this).val()) == ""){
				switch($(this).attr("id")){
					case "nombre":	error.texto += "- Nombre\n";break;
					case "ci":		error.texto += "- C.I.\n";break;
					case "area":	error.texto += "- Area\n";break;
					case "obj_pres":error.texto += "- Objeto de Prestamo\n";break;
				}
			}
		}
	);
	if($.trim(error.texto) != "")
		error.std = true;
	else
		error.std = false;
		
	return error;	
}
/****/
TablaDetalleVacia = function(){
	if($.trim($("#DocPrestados").html()) != "")
		resp = false;
	else
		resp = true;
	return resp;	
}
/*****/
VerNumeroPrestamo = function(){
	$.post(
		"phps/fprestamo.php",
		{"opcion":"3"},
		function(data){
			//alert(data);	
			$("#formDatos input[id=\"inpres\"]").val(data);
			$("#formDatos #npres").html(data);
		}
	);
}
RegistrarPrestamo = function(){
		
	formVacio = CamposVacios();
	if(!formVacio.std){
		if(!TablaDetalleVacia()){
			//Registrar en las tablas
			if(confirm("Confirmacion de Registro de Prestamo.\nEsta Seguro?")){
				$.post(
					"phps/fprestamo.php",
					{"opcion" : "5",
					 "nombre":		$("input[id=\"nombre\"]").val(),
					 "ci":			$("input[id=\"ci\"]").val(),
					 "dependencia":	$("input[id=\"area\"]").val(),
					 "obj_pres":	$("input[id=\"obj_pres\"]").val()
					},
					function(data){
						if(data != "0"){
							alert("Los Datos se Registraron Correctamente.");
							window.open('htmls/hojaprestamo.php?np='+$("#inpres").val(), 'Hoja de Prestamo','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=600,height=480,directories=no,location=no');
							window.location.href = "prestamo.php?op=2";
						}
						else
							alert("ERROR: No se pudieron introducir los datos.");
					}
				);
			}
			else return;
		}
		else{
			alert("No Existen Items A Prestar.");
		}
	}
	else 
		alert("Existen Campos Vacios:\n" + formVacio.texto);
}
/***/
CancelarPrestamo = function(){
	$("#formDatos input[type=text]").each(
		function(){
			$(this).val("");
		}
	);
	$.post(
		"phps/fprestamo.php",
		{"opcion":"4"},
		function(data){
			if(data != "1")
				alert("Error:\nNo se pudo borrar la Tabla.")
			else 
				$("#DocPrestados").empty();
		}
	);	
}