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
			$pres = new Documento();
			$datosPres = $pres->listarDoc(strtoupper($_POST["tipo"]),$_POST["listfechareg"]);
			//echo $_POST["numero"]." ".$_POST["opcion"];
			$i=0;
			if($datosPres != "0"){

							
			$tabla = "<table id='example' class='display' style='width:100%'>";
			$tabla .= "<thead>";
			$tabla .= "<tr>";
			
			$tabla .= "<th>Nº de Documento</th>";
			$tabla .= "<th>Tipo</th>";
     		$tabla .= "<th>Gestion</th>";
     		$tabla .= "<th>Nombre o Razon Social</th>";
	 		$tabla .= "<th>Documentos Adjuntos</th>";
 	 		$tabla .= "<th>Observacions</th>";
 	 		$tabla .= "<th>Opcion</th>";
						
			$tabla .= "</tr>";
			$tabla .= "</thead>";
			$tabla .= "</tbody>";
			while($i < $datosPres["nfilas"]){
				$tabla .= "<tr>";
				//$tabla .= "<td>".$detallePres[$i]["iddoc"]."</td>";
				
				//$tabla .= "<td>".$detallePres["iddocumento"]."</td>";
				$tabla .= "<td>".$datosPres[$i]["num_documento"]."</td>";
				$tabla .= "<td>".$datosPres[$i]["tipo_documento"]."</td>";
				$tabla .= "<td>".$datosPres[$i]["gestion"]."</td>";
				$tabla .= "<td>".$datosPres[$i]["nomraz_social"]."</td>";
				$tabla .= "<td>".$datosPres[$i]["doc_adj"]."</td>";
				$tabla .= "<td>".$datosPres[$i]["observaciones"]."</td>";
				$tabla .= "<td><a href='prestamo.php?op=6&id=".$datosPres[$i]["iddocumento"]."'>Mod</a>
				</td>";
				//<button onclick='eliminar(".$datosPres[$i]["iddocumento"].")' >Elim</button>
									
				$tabla .= "</tr>";
				$i++;
			}
			$tabla .= "</tbody>"; 
			$tabla .= "</table>";
			$tabla .= "<script> 	$(document).ready(function(){
				$('#example').DataTable({
	
					dom: 'Bfrtip',
					lengthMenu: [
						[ 10, 25, 50, -1 ],
						[ '10 reg', '25 reg', '50 reg', 'todos' ]
					],
					buttons: [
						'pageLength',
						'excel',
						'pdf'
					]
				}

				);
		
			}
			);</script>"; 
			echo $tabla;}
			else {
				echo '0';
			}
			break; 
		case "2":
				$docmen = new Documento();
				$id=$_POST['iddoc'];
				$datosdoc = $docmen->verDoc($id);
				if ($datosdoc == 0) echo '0';
				else
				echo ($datosdoc[0]);
				break;	
		case "3":
				//echo "hola munod este es ".$_POST["numero"];
				$pres = new Documento();
				$datosPres = $pres->listarComp($_POST["comprobante"]);
				//echo $_POST["numero"]." ".$_POST["opcion"];
				$i=0;
				if($datosPres != "0"){
	
								
				$tabla = "<table id='example' class='display' style='width:100%'>";
				$tabla .= "<thead>";
				$tabla .= "<tr>";
				
				$tabla .= "<th>Nº de Documento</th>";
				$tabla .= "<th>Tipo</th>";
				 $tabla .= "<th>Gestion</th>";
				 $tabla .= "<th>Nombre o Razon Social</th>";
				 $tabla .= "<th>Documentos Adjuntos</th>";
				  $tabla .= "<th>Observacions</th>";
							
				$tabla .= "</tr>";
				$tabla .= "</thead>";
				$tabla .= "</tbody>";
				while($i < $datosPres["nfilas"]){
					$tabla .= "<tr>";
					//$tabla .= "<td>".$detallePres[$i]["iddoc"]."</td>";
					
					//$tabla .= "<td>".$detallePres["iddocumento"]."</td>";
					$tabla .= "<td>Doc-".$datosPres[$i]["num_documento"]."</td>";
					$tabla .= "<td>".$datosPres[$i]["tipo_documento"]."</td>";
					$tabla .= "<td>".$datosPres[$i]["gestion"]."</td>";
					$tabla .= "<td>".$datosPres[$i]["nomraz_social"]."</td>";
					$tabla .= "<td>".$datosPres[$i]["doc_adj"]."</td>";
					$tabla .= "<td>".$datosPres[$i]["observaciones"]."</td>";
					//<button onclick='eliminar(".$datosPres[$i]["iddocumento"].")' >Elim</button>
										
					$tabla .= "</tr>";
					$i++;
				}
				$tabla .= "</tbody>"; 
				$tabla .= "</table>";
				$tabla .= "<script> 	$(document).ready(function(){
					$('#example').DataTable({
		
						dom: 'Bfrtip',
						lengthMenu: [
							[ 10, 25, 50, -1 ],
							[ '10 reg', '25 reg', '50 reg', 'todos' ]
						],
						buttons: [
							'pageLength',
							'excel',
							'pdf'
						]
					}
	
					);
			
				}
				);</script>"; 
				echo $tabla;}
				else {
					echo '0';
				}
				break; 
	
		default: break;
	}
}

/*para dar formato a la fecha*/
function darFormatoFecha($fecha){
	return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
}

?>