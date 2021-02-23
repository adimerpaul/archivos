<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificar Documento</title>
<style type="text/css">
	th{
		text-align:right;
		color:#0000CC;
		font-size:14px;
	}
	td{
	font-size:14px;
	color:#0000CC;
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
	.texto{
		color: #00C;
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
				gestion=$("#gestion").val();
				tDoc=$("#tipo").val();
				if(nDoc == "")
					alert("Introduzca un Numero de Documento.");
				else{	
					//alert("Introdujo un Numero de Recibo. "+nDoc);
					
					$.post(
						"modificararchivo.php",
						{"nDoc" : nDoc,
						"gestion":gestion,
						"tDoc":tDoc
						},
						function(data){
							//alert(data);
							$("#datosDocumento").html(data);
							$("#bModificar").click(Modificar);
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
	nomrs = $("#nomrs").val();
	detalle = $("#detalle").val();
	importe = $("#importe").val();
	docadj=$("#docadj").val();//aumentado
	observaciones=$("#observaciones").val();//aumentado
	$.post(
		"actualizar.php",
		{"nomrs" : nomrs,
		 "detalle" : detalle,
		 "importe" : importe,
		 "docadj":docadj,//aumentado
		 "observaciones":observaciones,//aumentado
		 "idReg" : idReg
		},
		
		function(data){
			alert(data);
			$("#buscarDocumento").click();
			//$("#datosRecibo").html(data);
			//$("#bModificar").click(Modificar);
		}
	);
}
</script>
</head>

<body>
	<div align="center" style="margin:50px; border:#3F6;">
    <span style="color:#0000CC; font-size:18px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Modificar Registro de Documento</span><br />
    	<label style="color:#0000CC">Nro. de Documento</label>
        <input type="text" size="4" name="ndocumento" id="ndocumento"/>&nbsp;&nbsp;&nbsp;
        <label style="color:#0000CC">Gesti&oacute;n</label>
        <select id="gestion">
	    <option value="PREFECTURA 2007">PREFECTURA 2007</option>
	    <option value="PREFECTURA 2008">PREFECTURA 2008</option>
	    <option value="PREFECTURA 2009">PREFECTURA 2009</option>
   	    <option value="PREFECTURA 2010">PREFECTURA 2010</option>
   	    <option value="GOBIERNO 2010">GOBIERNO 2010</option>
   	    <option value="GOBIERNO 2011">GOBIERNO 2011</option>
  	    <option value="GOBIERNO 2012">GOBIERNO 2012</option>
            <option value="GOBIERNO 2013">GOBIERNO 2013</option>
            <option value="GOBIERNO 2014">GOBIERNO 2014</option>
            <option value="GOBIERNO 2015">GOBIERNO 2015</option>
	    <option value="GOBIERNO 2016">GOBIERNO 2016</option>
            <option value="GOBIERNO 2017">GOBIERNO 2017</option>
            <option value="GOBIERNO 2018">GOBIERNO 2018</option>
            <option value="GOBIERNO 2019">GOBIERNO 2019</option>
	    </select>&nbsp;&nbsp;&nbsp;
        <label style="color:#0000CC">Tipo:</label>
        <select id="tipo">
	    <option value="PREVENTIVO">PREVENTIVO</option>
   	    <option value="SERVICIOS">SERVICIOS</option>
   	    <option value="SIP">S.I.P.</option>
		<option value="ASAMBLEA">ASAMBLEA</option>
		<option value="TOMO">T. C-31 EGRESOS SIGMA</option>
		<option value="TI">T. C-21 INGRESOS</option>
		<option value="TPDV">T. PLLAS. DESCARGO VIATICOS</option>
		<option value="TND">T. NOTA DE DEVITOS</option>
		<option value="SDV">T. S.I.P. DESCARGO VIATICOS</option>
		<option value="SPV">T. S.I.P. PAGO VIATICOS</option>
		<option value="SSEDEGES">T. SERV. SEDEGES</option>
		<option value="SSEDCAM">T. SERV. SEDCAM</option>
		<option value="SSEDES">T. SERV. SEDES</option>
		<option value="SSEDEDE">T. SERV. SEDEDE</option>
		<option value="SSEDUCA">T. SERV. SEDUCA</option>
		<option value="PPC">T. PLLAS. PERS. CONTRATO</option>
		<option value="PPR">T. PLLAS. PERS. REGULAR</option>
            <option value="SP">T. S.I.P. PEAJES</option>
            <option value="PECM">T. PAGO EFECTIVO CONTRATOS MENORES</option>
            <option value="PAPC">T. PLLA. ADIC. PERSONAL A CONTRATO</option>
        </select>
        
        <button id="buscarDocumento">Buscar</button>
    </div>
    <div id="datosDocumento"></div>
</body>
</html>