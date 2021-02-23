<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buscar Documento Transcrito</title>
<style type="text/css">
	th{
		text-align:center;
		font-size:15px;
		color:#0000E6;
	}
	td{
		font-size:14px;
		}
	th.titulo{
		text-align:center;
	}
	.mdf{
		float:right;
		color:#096;
		font-size:10px;
	}
	.dmdf{
		float:left;
		
	}
</style>
<script type="application/javascript" src="jquery-1.4.2.min.js"></script>
<script type="application/javascript">
$(document).ready(
	function(){
		$("#buscarDocumento").click(
			function(){
				//alert("me hicieron click	");
				nDoc = $.trim($("#ndocumento").val());
				if(nDoc == "")
					alert("Introduzca un Numero de Documento");
				else{	
					//alert("Introdujo un Numero de Recibo. "+nRecibo);
					$.post(
						"resultadosbusq.php",
						{"nDoc" : nDoc},
						function(data){
							//alert(data);
							$("#datosDocumento").html(data);
							//$("#bModificar").click(Modificar);
						}
					);
			
				}
			}
		);
		
	}
);

function Modificar(){
	//alert("el registor a modififcar es "+$("#idReg").val());	
	//alert("el selectionado es "+$("#codPres").val());
	idReg = $("#idReg").val();	
	nMemo = $("#nMemo").val();
	destino = $("#destino").val();
	proyecto = $("#codProy").val();
	$.post(
		"actualizar.php",
		{"nMemo" : nMemo,
		 "destino" : destino,
		 "proyecto" : proyecto,
		 "idReg" : idReg
		},
		function(data){
			alert(data);
			$("#buscarRecibo").click();
			//$("#datosRecibo").html(data);
			//$("#bModificar").click(Modificar);
		}
	);
}
</script>
</head>

<body>
	<div align="center">
    <span style="color:#0000CC; font-size:18px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Documentos Transcritos</span><br />
    	<label>Introdusca Nro. de Documento</label>
        <input type="text" size="4" name="ndocumento" id="ndocumento"/>
        <button id="buscarDocumento">Buscar</button>
    </div>
    <div id="datosDocumento" align="center" style="font-family:'Courier New'"; ></div>
</body>
</html>