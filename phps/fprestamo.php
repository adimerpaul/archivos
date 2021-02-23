<?PHP
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
			$doc = new Documento();
			$ArrayDocs = $doc->listarDocumentos($_POST["numero"]);
			if($ArrayDocs != "0"){
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
			}
			else
				echo "<span class=\"no_result\">No se Produjo Resultado.</span>";
		break;
		case "2":
			$doc = new Documento();
			
			if($doc->pasarDocumentoADetalle($_POST["idDoc"],$_POST["idPrestamo"]) <> "0"){
				$ArrayDocs = $doc->listarDetalleTemporal();
				$i = 0;
			
				$tabla = "<table align=\"center\">";
				$tabla .= "<tr>";
				$tabla .= "<th>Nº de <br /> Documento</th>";
			    $tabla .= "<th>Tipo</th>";
	     		$tabla .= "<th>Gestion</th>";
     			$tabla .= "<th>Nombre o Razon Social</th>";
	 			$tabla .= "<th>Documentos Adjuntos</th>";
				$tabla .= "</tr>";
				while($i < $ArrayDocs["nfilas"]){
					$tabla .= "<tr>";
					$tabla .= "<td>".$ArrayDocs[$i]["num_documento"]."</td>";
					$tabla .= "<td>".$ArrayDocs[$i]["tipo_documento"]."</td>";
					$tabla .= "<td>".$ArrayDocs[$i]["gestion"]."</td>";
					$tabla .= "<td>".$ArrayDocs[$i]["nomraz_social"]."</td>";
					$tabla .= "<td>".$ArrayDocs[$i]["doc_adj"]."</td>";
					$tabla .= "</tr>";
					$i++;
				}
				$tabla .= "</table>"; 
				echo $tabla;
			}
			else 
				echo "Error en el registro del Detalle de Prestamo.";
			
		break;
		case "3":
			$doc = new Documento(); 
			$npres = $doc->verNumPrestamo();
			
			if(($npres+0) <= 0)
				echo "NoN";
			else
				echo $doc->verNumPrestamo();
			
		break;
		case "4":
			$doc = new Documento();
			echo $doc->vaciarTablaDetalle();
			
		break;	
		case "5":
			$doc = new Documento();
			
			$nombre = $_POST["nombre"]; 
			$ci = $_POST["ci"]; 
			$dependencia = $_POST["dependencia"]; 
			$objeto_prestamo = $_POST["obj_pres"]; 
			$fecha_prestamo = date("Y-m-d");
			
			$exitoInsertDatosPrestamo = $doc->insertarDatosPrestamo($nombre, $ci, $dependencia, $objeto_prestamo, $fecha_prestamo);
			$exitoInsertDetallePrestamo = $doc->insertarDetallePrestamo();
			
			if($exitoInsertDatosPrestamo == "1" && $exitoInsertDetallePrestamo == "1"){
				if($doc->vaciarTablaDetalle()== "1")
					echo "1";
			}
			else
				echo "0";
		break;
		case "10":
		/*INSERT INTO `archivos`.`documento` (
`iddocumento` ,
`fecharegistro` ,
`num_documento` ,
`nomraz_social` ,
`detalle` ,
`importe` ,
`doc_adj` ,
`observaciones` ,
`gestion` ,
`tipo_documento` ,
`estado_doc`
)
VALUES (
'2', '2011-09-15', '1', 'mi nueva razon social', 'es un detlle mas', '50.26', 'uno a 100', 'nada mas', '2001', 'tomo', '5'
);
*/
			echo "nada malo";
		break;
		default:break;
	}
}

/***/
/*funciones*/
/***/
function botonPrestar($idDoc){
	//$boton = "<button onClick=\"AgregarDoc(".$idDoc.")\">Prestar</button>";
	$boton = "<button onClick=\"AgregarDoc(".$idDoc.")\">Prestar</button>";
	return $boton;
}
?>