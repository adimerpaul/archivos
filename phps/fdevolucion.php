<?PHP
include_once "../clases/prestamo.php";
include_once "../clases/documento.php";
/****/
include_once "../clases/dbconexion.php";
	$dbcnx = new dbcnx();
	$dbcnx->db();
/****/
if(isset($_POST["opcion"])){
	switch($_POST["opcion"]){
		case "1":
			//echo "hola munod este es ".$_POST["numero"];
			$pres = new Prestamo();
			$datosPres = $pres->DatosPrestamo($_POST["numero"]);
			//echo $_POST["numero"]." ".$_POST["opcion"];
			
			if($datosPres != "0"){
							
				$tabla = "<table align=\"center\">";
				$tabla .= "<tr>";
				$tabla .= "<th>Nombre:</th>";
				$tabla .= "<td>".$datosPres/*[$i]*/["nombre"]."</td>";
				$tabla .= "</tr>";

				$tabla .= "<tr>";
				$tabla .= "<th>C.I.:</th>";
				$tabla .= "<td>".$datosPres/*[$i]*/["ci"]."</td>";
				$tabla .= "</tr>";
			
				$tabla .= "<tr>";
				$tabla .= "<th>Area:</th>";
				$tabla .= "<td>".$datosPres/*[$i]*/["dependencia"]."</td>";
				$tabla .= "</tr>";

				$tabla .= "<tr>";
				$tabla .= "<th>Objeto de Prestamo:</th>";
				$tabla .= "<td>".$datosPres/*[$i]*/["objeto_prestamo"]."</td>";
				$tabla .= "</tr>";
			
				$tabla .= "<tr>";
				$tabla .= "<th>Fecha de Prestamo:</th>";
				$tabla .= "<td>".darFormatoFecha($datosPres/*[$i]*/["fecha_prestamo"])."</td>";
				$tabla .= "</tr>";
			
				$tabla .= "</table>"; 
			}
			else
				$tabla = "0";	
			echo $tabla;
			
		break;
		case "2":
			$pres = new Prestamo();
			$detallePres = $pres->DetallePrestamo($_POST["numero"]);
			$i = 0;
			
			$tabla = "<table align=\"center\">";
			$tabla .= "<tr>";
			
			$tabla .= "<th>Nº de Documento</th>";
			$tabla .= "<th>Tipo</th>";
     		$tabla .= "<th>Gestion</th>";
     		$tabla .= "<th>Nombre o Razon Social</th>";
	 		$tabla .= "<th>Documentos Adjuntos</th>";
	 		$tabla .= "<th>Devolver</th>";
 	 		//$tabla .= "<th>Prestar</th>";
						
			$tabla .= "</tr>";
			while($i < $detallePres["nfilas"]){
				$tabla .= "<tr>";
				//$tabla .= "<td>".$detallePres[$i]["iddoc"]."</td>";
				
				//$tabla .= "<td>".$detallePres["iddocumento"]."</td>";
				$tabla .= "<td>".$detallePres[$i]["num_documento"]."</td>";
				$tabla .= "<td>".$detallePres[$i]["tipo_documento"]."</td>";
				$tabla .= "<td>".$detallePres[$i]["gestion"]."</td>";
				$tabla .= "<td>".$detallePres[$i]["nomraz_social"]."</td>";
				$tabla .= "<td>".$detallePres[$i]["doc_adj"]."</td>";
				
				if($detallePres[$i]["estado_doc"] == '0')
					$tabla .= "<td>Devuelto</td>";
				else	
					$tabla .= "<td>".botonDevolver($detallePres[$i]["iddocumento"])."</td>";
					
				$tabla .= "</tr>";
				$i++;
			}
			$tabla .= "</table>"; 
			echo $tabla;
		break;
		case "3":
			$doc = new Documento();
			echo $doc->ActualizarEstadoDevolucionDoc($_POST["idDoc"]);
			//echo "taca;o";
			//$detallePres = $pres->DetallePrestamo($_POST["numero"]);
			//$i = 0;
		break;	
		/*
		case "1":
			//echo "hola munod este es ".$_POST["numero"];
			$pres = new Prestamo();
			$ArrayDocs = $pres->DatosPrestamo($_POST["numero"]);
			$i = 0;
			
			$tabla = "<table>";
			$tabla .= "<tr>";
			$tabla .= "<th>Nº de Documento</th>";
		    $tabla .= "<th>Tipo</th>";
     		$tabla .= "<th>Gestion</th>";
     		$tabla .= "<th>Nombre o Razon Social</th>";
	 		$tabla .= "<th>Documentos Adjuntos</th>";
 	 		$tabla .= "<th>Prestar</th>";
			$tabla .= "</tr>";
			while($i < $ArrayDocs["nfilas"]){
				$tabla .= "<tr>";
				$tabla .= "<td>".$ArrayDocs[$i]["num_documento"]."</td>";
				$tabla .= "<td>".$ArrayDocs[$i]["tipo_documento"]."</td>";
				$tabla .= "<td>".$ArrayDocs[$i]["gestion"]."</td>";
				$tabla .= "<td>".$ArrayDocs[$i]["nomraz_social"]."</td>";
				$tabla .= "<td>".$ArrayDocs[$i]["doc_adj"]."</td>";
				if($ArrayDocs[$i]["estado_doc"] == '0')
					$tabla .= "<td>".botonPrestar($ArrayDocs[$i]["iddocumento"])."</td>";
				else	
					$tabla .= "<td>No Disponible</td>";
				$tabla .= "</tr>";
				$i++;
			}
			$tabla .= "</table>"; 
			echo $tabla;
		break;*/
	}
}
/***/
function botonDevolver($idDoc){
	//$boton = "<button onClick=\"AgregarDoc(".$idDoc.")\">Prestar</button>";
	$boton = "<button onClick=\"DevolverDoc(".$idDoc.")\">Devolver</button>";
	return $boton;
}
/*para dar formato a la fecha*/
function darFormatoFecha($fecha){
	return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
}

?>