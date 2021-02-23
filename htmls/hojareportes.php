<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hoja de Reporte</title>
<style>
#membrete, .mem{
	color:#000;
	font-family:Arial;
	font-size:10px;
	font-weight:bold;
	text-align:center;
}
#imprimir{
	color:#39C;
	font-family:Arial;
	font-size:11px;
	font-weight:bold;
	text-align:right;
	padding:10px;
}
#titulo{
	text-align:center;
	font-family:Arial;
	font-weight:bold;
	font-size:18px;
	/*margin:0px 200px 0px 200px;*/
	border-bottom:#000 3px solid;
}
#subtitulo{
	text-align:center;
	font-family:Arial;
	font-weight:bold;
	font-size:14px;
}

.np{
	padding:8px;
	font-family:Arial;
	font-size:18px;
	font-weight:bold;
	border:1px solid #000;
	float:left;
}
.pd{
	padding:3px;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
	
}

.nump{
	border:3px solid #000;
	display:inline;
	float:left;
	position:absolute;
	padding:8px;
	font-size:24px;
	font-family:Arial;
	font-weight:bold;
}
.tab{
	border:1px solid #000;
	border-collapse:collapse;
	font-family:Arial;
	font-size:10px;	
	text-align:center;
}
.tab td, .tab th{
	padding:4px;
}
.encabezado{
	background:#FFD2A6;
	}
</style>
</head>

<body>
<!--
<div>
<div class="nump">Nº <?PHP echo $_GET["np"]?></div>
<div class="mem">titulo de algo<br />hola</div>
</div>
-->
<div style="clear:left;"></div>
<br />	

<div id="membrete"><span>Gobierno Autonomo Departamental de Oruro<br />ARCHIVOS</span></div>
<!--<div id="imprimir">Imprimir</div>-->
<br/>
<div id="titulo">Hoja de Reporte</div>
<br />
<div id="subtitulo">
<?PHP 
	$tipoRep = $_GET["tipoRep"];
	switch($tipoRep){
		case "1":
			echo "Listado de Documentos";
		break;
		case "2":
			echo "Listado de Prestamos";
		break;
		default:
		break;
	}
	
?>
</div>
<br />
<?PHP
	include("../clases/prestamo.php");
	include("../clases/documento.php");
	include("../clases/dbconexion.php");
	$dbcnx = new dbcnx();
	$dbcnx->db();
?>
<div id="datos">
<?PHP
	switch($tipoRep){
		case "1":
			$tipoDoc = $_GET["tipoDoc"];
			$gestDoc = $_GET["gestDoc"];
			$tipoOrd = $_GET["tipoOrd"];
	
			$doc = new Documento();
			$listadoDocsRep = $doc->ListDocsRep($tipoDoc,$gestDoc,$tipoOrd);
			
			if($listadoDocsRep != "0"){
		
				$i = 0;

				$tabla .= "<table class=\"tab\" align=\"center\" border=\"1\">";
				$tabla .= "<tr>";
				$tabla .= "<th class=\"encabezado\">Nº de<br />Doc.</th>";
				$tabla .= "<th class=\"encabezado\">Nombre o<br />Razon Social</th>";
				$tabla .= "<th class=\"encabezado\">Detalle</th>";
     			$tabla .= "<th class=\"encabezado\">Importe</th>";
		     	$tabla .= "<th class=\"encabezado\">Documentos<br/>Adjuntos</th>";
			 	$tabla .= "<th class=\"encabezado\">Gestion</th>";
				$tabla .= "<th class=\"encabezado\">Tipo</th>";
				$tabla .= "<th class=\"encabezado\">Fecha de<br />Registro</th>";
				$tabla .= "</tr>";
		
				while($i < $listadoDocsRep["nfilas"]){
					$tabla .= "<tr>";
		
					$tabla .= "<td>".$listadoDocsRep[$i]["num_documento"]."</td>";
					$tabla .= "<td>".$listadoDocsRep[$i]["nomraz_social"]."</td>";
					$tabla .= "<td>".$listadoDocsRep[$i]["detalle"]."</td>";
					$tabla .= "<td>".$listadoDocsRep[$i]["importe"]."</td>";
					$tabla .= "<td>".$listadoDocsRep[$i]["doc_adj"]."</td>";
					$tabla .= "<td>".$listadoDocsRep[$i]["gestion"]."</td>";
					$tabla .= "<td>".$listadoDocsRep[$i]["tipo_documento"]."</td>";
					$tabla .= "<td>".darFormatoFecha($listadoDocsRep[$i]["fecharegistro"])."</td>";
					$tabla .= "</tr>";
					$i++;
				}
			}
			else
				$tabla = "";	
			echo $tabla;
		break;
		case "2":
			$pres = new Prestamo();
			$listPres = $pres->listPrestamos();			
			
			if($listPres != "0"){
		
				$i = 0;

				$tabla .= "<table class=\"tab\" align=\"center\" border=\"1\">";
				$tabla .= "<tr>";
				$tabla .= "<th class=\"encabezado\">Nº de<br />Prestamo</th>";
				$tabla .= "<th class=\"encabezado\">Nombre</th>";
				$tabla .= "<th class=\"encabezado\">C.I.</th>";
     			$tabla .= "<th class=\"encabezado\">Area</th>";
		     	$tabla .= "<th class=\"encabezado\">Objeto del<br/>Prestamo</th>";
			 	$tabla .= "<th class=\"encabezado\">Fecha del Prestamo</th>";
				$tabla .= "</tr>";
		
				while($i < $listPres["nfilas"]){
					$tabla .= "<tr>";
					/*
					$respuesta[$i]["idprestamo"] = $row["idprestamo"];
					$respuesta[$i]["nombre"] = $row["nombre"];
					$respuesta[$i]["ci"] = $row["ci"];
					$respuesta[$i]["dependencia"] = $row["dependencia"];
					$respuesta[$i]["objeto_prestamo"] = $row["objeto_prestamo"];
					$respuesta[$i]["fecha_prestamo"] = $row["fecha_prestamo"];
					*/
					$tabla .= "<td>".$listPres[$i]["idprestamo"]."</td>";
					$tabla .= "<td>".$listPres[$i]["nombre"]."</td>";
					$tabla .= "<td>".$listPres[$i]["ci"]."</td>";
					$tabla .= "<td>".$listPres[$i]["dependencia"]."</td>";
					$tabla .= "<td>".$listPres[$i]["objeto_prestamo"]."</td>";
					$tabla .= "<td>".darFormatoFecha($listPres[$i]["fecha_prestamo"])."</td>";
								
					$tabla .= "</tr>";
					$i++;
				}
			}
			else
				$tabla = "";	
				echo $tabla;
		break;
		default:
		break;
	}
	
	
	
?>	
</div>
<div id="detalle"></div>
<div id="pie"></div>
</body>

</html>
<?PHP
/*para dar formato a la fecha*/
function darFormatoFecha($fecha){
	return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
}
?>