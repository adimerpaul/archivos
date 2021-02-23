// JavaScript Document
$(document).ready(
	function(){
		$("#calabaza").click(poner);
		$("#buscarPrestamo").click(buscarPrestamo);
	}
);

poner = function(){
	$("#blur").html("<span id=\"s\"><button onClick=\"hola();\">hola</button></span>");
}
hola = function(le){
	alert("Que tal viejo maigo");
	$(le).parent().html("ketal");
	$(le).remove();
	$("#s").html("nuevo texx");
}

/*****/
buscarPrestamo = function(){
	if($.trim($("input[id=\"texto\"]").val()) != ""){
		$.post(
			"phps/fdevolucion.php",
			{"opcion" : "1",
		 	 "numero" : $.trim($("input[id=\"texto\"]").val())
			},
			function(data){
				if(data=="0"){
					$("#ResBusquedaPrestamo #datos").html("<span class=\"no_result\">No se produjo resultado.</span>");
					$("#ResBusquedaPrestamo #detalle").empty();
				}
				else{
					$("#ResBusquedaPrestamo #datos").html(data);
					darDetallePrestamo();
				}
				
			}
		);	
	}
}

darDetallePrestamo = function(){
		/****/
	$.post(
		"phps/fdevolucion.php",
		{"opcion" : "2",
	 	"numero" : $.trim($("input[id=\"texto\"]").val())
		},
		function(data){
			$("#ResBusquedaPrestamo #detalle").html(data+"<br/>");
		}
	);
}
/**/
DevolverDoc = function(idDoc){
	if(confirm("Confirmar Devolucion de Documento.")){
		$.post(
			"phps/fdevolucion.php",
			{"opcion" : "3",
		 	"idDoc" : idDoc
			},
			function(data){
				if(data == "1"){
					buscarPrestamo();
				}
				else
					alert("Error En La Devolucion De Documentos. ");
				//$("#ResBusquedaPrestamo #detalle").html(data);
			}
		);
	}
}