// JavaScript Document
$(document).ready(
	function(){
		recuperar();
		verSelecTomo();
		$("#btnModDoc").click(ModificarDocumento);
		$("#cancelModDoc").click(function(){
			window.location.href = "prestamo.php?op=5";}
			);
		
		$("#tipo").change(verSelecTomo);
	}
);
 
/***/
recuperar=function(){
	$.post(
		"phps/flistado.php",
		{"opcion" : "2",
		 "iddoc" : $("#iddocumento").val()
		},
		function(data){
			if(data!='0'){
				console.log(data);
				var row=JSON.parse(data);
				console.log(row);
				$("#modgestion").val(row['gestion']);
				$("#modnumero").val(row['num_documento']);
				$("#modtipo").val(row['tipo_documento']);
				$("#modnombre_rs").val(row['nomraz_social']);
				$("#moddetalle").val(row['detalle']);
				$("#modimporte").val(row['importe']);
				$("#moddoc_adj").val(row['doc_adj']);
				$("#modini").val(row['ini']);
				$("#modfin").val(row['fin']);
				$("#modobs").val(row['observaciones']);
			}
			else
				$("#ResListado #detalle").html('no existen registros'+"<br/>");
			
		}
		)	
}
/***registro***/
verSelecTomo = function(){
	switch($("#modtipo").val()){
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
			if($.trim($(this).val()) == "" && $(this).is(":visible")){
				switch($(this).attr("id")){
					case "modnumero":		error.texto += "- Numero\n";break;
					case "modnombre_rs":	error.texto += "- Nombre o Razon Social\n";break;
					case "moddetalle":		error.texto += "- Detalle\n";break;
					case "modimporte":		error.texto += "- Importe\n";break;
					case "moddoc_adj":		error.texto += "- Documentos Adjuntos\n";break;
				}
			}
		}
	);
	if(isNaN($('#modini').val())) error.texto+="- ini\n";
	if(isNaN($('#modfin').val())) error.texto+="- fin\n";
	if($.trim($("#fmodificar_Documento textarea").val()) == "") error.texto += "- Obsevaciones\n";
	
	if($.trim(error.texto) != "")
		error.std = true;
	else
		error.std = false;
		
	return error;	
}
ModificarDocumento = function(){
	console.log($("#modnumero").val());
	formVacio = camposFormRegDocVacios();
	if(!formVacio.std){
		$.post(
			"phps/fregistro.php",
			{"opcion" : "2",
			 "iddocumento":		$("#fmodificar_Documento input[id=\"iddocumento\"]").val(),
			 "modgestion":		$("#fmodificar_Documento select[id=\"modgestion\"]").val(),
			 "modtipo":		    $("#fmodificar_Documento select[id=\"modtipo\"]").val(),
			 "modnumero":		$("#fmodificar_Documento input[id=\"modnumero\"]").val(),
			 "modnombre_rs":	$("#fmodificar_Documento input[id=\"modnombre_rs\"]").val(),
			 "moddetalle":		$("#fmodificar_Documento input[id=\"moddetalle\"]").val(),
			 "modimporte":		$("#fmodificar_Documento input[id=\"modimporte\"]").val(),
			 "moddoc_adj":		$("#fmodificar_Documento input[id=\"moddoc_adj\"]").val(),
			 "modini":			$("#fmodificar_Documento input[id=\"modini\"]").val(),
			 "modfin":			$("#fmodificar_Documento input[id=\"modfin\"]").val(),
			 "modobs":			$("#fmodificar_Documento textarea[id=\"modobs\"]").val()
			},
			function(data){
				if(data == "1"){
					alert("Los Datos se Modificaron Correctamente.");
					//alert("consulta= "+data);
					window.location.href = "prestamo.php?op=5";
				}
				else
					alert("ERROR: No se pudieron modificar los datos.");
			}
		);
		//alert("Todo lleno");
	}
	else 
		alert("Existen Campos Vacios:\n" + formVacio.texto);
}
/****/
