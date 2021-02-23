<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento Prestado</title>
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
	border:2px solid #000;
	/*display:inline;*/
	/*float:left;*/
	/*position:absolute;*/
	padding:8px;
	font-size:20px;
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
<div class="nump">Nº <?PHP //echo $_GET["np"]?></div>
<div class="mem">titulo de algo<br />hola</div>
</div>
-->
<div style="clear:left;"></div>
<br />	
<!--<div class="nump">Nº <?PHP //echo $_GET["nd"]?></div>-->
<div id="membrete"><span>Gobierno Autonomo Departamental de Oruro<br />ARCHIVOS</span></div>
<!--<div id="imprimir">Imprimir</div>-->
<br/>
<div id="titulo">Documento Prestado</div>
<br />
<?PHP
	include("../clases/prestamo.php");
	include("../clases/documento.php");
	include("../clases/dbconexion.php");
	$dbcnx = new dbcnx();
	$dbcnx->db();
	
	$pres = new Prestamo();
	$doc = new Documento();
	//$datosPres = $pres->DatosPrestamo($_GET["np"]);
	//$detallePres = $pres->DetallePrestamo($_GET["np"]);
	$documentoPres = $pres->DocumentoPrestado($_GET["nd"],$_GET["td"],$_GET["ge"]);
	$mostrarDoc = $doc->mostrarDocumento($_GET["nd"],$_GET["td"],$_GET["ge"]);
?>
<div id="datos">
<?PHP
	if($documentoPres != "0" && $mostrarDoc != "0"){
		//$tabla  = $documentoPres;
		$tabla  = "<div style=\"text-align:center\"><span class=\"nump\">Prestamo Nº ".$documentoPres["idprestamo"]."</span></div></br>";
		$tabla .= "<div style=\"text-align:center;\">";
		//$tabla .= "<span class=\"pd\">Nro. Prestamo: </span>".$documentoPres["idprestamo"]."&nbsp;&nbsp;&nbsp;";
		$tabla .= "<span class=\"pd\">Nombre: </span>".$documentoPres["nombre"]."&nbsp;&nbsp;&nbsp;";
		$tabla .= "<span class=\"pd\">C.I.: </span>".$documentoPres["ci"]."&nbsp;&nbsp;&nbsp;";
		$tabla .= "<span class=\"pd\">Area: </span>".$documentoPres["dependencia"]."&nbsp;&nbsp;&nbsp;";
		$tabla .= "<span class=\"pd\">Fecha de Prestamo: </span>".darFormatoFecha($documentoPres["fecha_prestamo"])."&nbsp;&nbsp;&nbsp;";
		$tabla .= "</div> <br />";
		
		
		/*
		$i = 0;
		*/
		$tabla .= "<table class=\"tab\" align=\"center\" border=\"1\">";
		$tabla .= "<tr>";
			
		$tabla .= "<th class=\"encabezado\">Nº de<br />Doc.</th>";
		$tabla .= "<th class=\"encabezado\">Tipo</th>";
     	$tabla .= "<th class=\"encabezado\">Gestion</th>";
     	$tabla .= "<th class=\"encabezado\">Nombre o Razon Social</th>";
	 	$tabla .= "<th class=\"encabezado\">Documentos<br/>Adjuntos</th>";
	 	/*
	 	$tabla .= "<th colspan=\"2\">Firma</th>";						
		$tabla .= "</tr>";
		
		$tabla .= "<tr>";
		$tabla .= "<th width=\"120px\">Entrega</th>";
		$tabla .= "<th width=\"120px\">Devolucion</th>";
		*/
		$tabla .= "</tr>";
		
		/*
		while($i < $detallePres["nfilas"]){
			*/
			$tabla .= "<tr>";
			$tabla .= "<td>".$mostrarDoc["num_documento"]."</td>";
			$tabla .= "<td>".$mostrarDoc["tipo_documento"]."</td>";
			$tabla .= "<td>".$mostrarDoc["gestion"]."</td>";
			$tabla .= "<td>".$mostrarDoc["nomraz_social"]."</td>";
			$tabla .= "<td>".$mostrarDoc["doc_adj"]."</td>";
			/*
			$tabla .= "<td></td>";
			$tabla .= "<td></td>";
			*/
			$tabla .= "</tr>";
			/*
			$i++;
		}
		*/
		$tabla .= "</table>";
	}
	else
		$tabla = "El documento se encuentra en ARCHIVOS.";	
	echo $tabla;
	
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