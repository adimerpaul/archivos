// JavaScript Document
$(document).ready(
	function(){
		verSelecTomo();
		$("#btnRegDoc").click(RegistrarDocumento);
		$("#cancelRegDoc").click(
			function(){
				$("#fRegistro_Documento input[type=\"text\"]").each(
					function(){
						$(this).val("");
					}
				);
				$("#fRegistro_Documento textarea").val("");
			}
		);
		
		$("#tipo").change(verSelecTomo);
	}
);

/***/
/***registro***/
verSelecTomo = function(){
	switch($("#tipo").val()){
		case "TOMO":
			$("#fila_nrs").hide();
			//$("#fila_det").hide();
			$("#fila_imp").hide();
		break;
		case "TI":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "TPDV":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "TND":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "SDV":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "SPV":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "SSEDEGES":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "SSEDCAM":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "SSEDES":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "SSEDEDE":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "SSEDUCA":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "PPC":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;
		case "PPR":
			$("#fila_nrs").hide();
			$("#fila_imp").hide();
		break;

		default:
			$("#fila_nrs").show();
			$("#fila_det").show();
			$("#fila_imp").show();
		break;
	}
}

camposFormRegDocVacios = function(){
	error = {std:true,texto:""};
	$("#fRegistro_Documento input[type=text]").each(
		function(){
			console.log($(this).val());
			if($.trim($(this).val()) == "" && $(this).is(":visible")){
				switch($(this).attr("id")){
					case "numero":		error.texto += "- Numero\n";break;
					case "nombre_rs":	error.texto += "- Nombre o Razon Social\n";break;
					case "detalle":		error.texto += "- Detalle\n";break;
					case "importe":		error.texto += "- Importe\n";break;
					case "doc_adj":		error.texto += "- Documentos Adjuntos\n";break;
				}
			}
		}
	);
	if($("#ini").val()!="" || $("#ini").val()!=null || isNaN($("#ini").val()))
		error.texto += "- Ini\n";
	if($("#fin").val()!="" || $("#fin").val()!=null || isNaN($("#fin").val()))
		error.texto += "- Fin\n";
	console.log($("#obs").val());
	if(($("#obs").val()) == "" || $("#obs").val() == null) 
	error.texto += "- Obsevaciones\n";
	

	if($.trim(error.texto) != "")
		error.std = true;
	else
		error.std = false;
		
	return error;	
}
RegistrarDocumento = function(){
	console.log($('#obs').val());

	formVacio = camposFormRegDocVacios();
	//console.log(formVacio.std);
	if(!formVacio.std){
		$.post(
			"phps/fregistro.php",
			{"opcion" : "1",
			 "gestion":		$("#fRegistro_Documento select[id=\"gestion\"]").val(),
			 "tipo":		$("#fRegistro_Documento select[id=\"tipo\"]").val(),
			 "numero":		$("#fRegistro_Documento input[id=\"numero\"]").val(),
			 "nombre_rs":	$("#fRegistro_Documento input[id=\"nombre_rs\"]").val(),
			 "detalle":		$("#fRegistro_Documento input[id=\"detalle\"]").val(),
			 "importe":		$("#fRegistro_Documento input[id=\"importe\"]").val(),
			 "doc_adj":		$("#fRegistro_Documento input[id=\"doc_adj\"]").val(),
			 "ini":	   		$("#fRegistro_Documento input[id=\"ini\"]").val(),
			 "fin":			$("#fRegistro_Documento input[id=\"fin\"]").val(),
			 "obs":			$("#fRegistro_Documento textarea[id=\"obs\"]").val(),
			},
			function(data){
				if(data == "1"){
					alert("Los Datos se Registraron Correctamente.");
					//alert("consulta= "+data);
					window.location.href = "prestamo.php?op=1";
				}
				else
					alert("ERROR: No se pudieron introducir los datos.");
			}
		);
		//alert("Todo lleno");
	}
	else 
		alert("Existen Campos Vacios:\n" + formVacio.texto);
}
/****/
