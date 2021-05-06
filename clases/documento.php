<?PHP
class Documento{
	function listarDocumentos($numero){
		//$con = mysql_connect("localhost","root","GAAnUEVAvIDA");
		//mysql_select_db("archivos", $con);
		$consulta = "SELECT iddocumento,num_documento, tipo_documento, gestion, nomraz_social, doc_adj, estado_doc
					 FROM documento 
					 WHERE num_documento = '".$numero."'";
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(!(mysql_num_rows($resultado) > 0)){
				return 0;
			}
			else{
				$i = 0;
				while($row = mysql_fetch_array($resultado)){
					$respuesta[$i]["iddocumento"] = $row["iddocumento"];
					$respuesta[$i]["num_documento"] = $row["num_documento"];
					$respuesta[$i]["tipo_documento"] = $row["tipo_documento"];
					$respuesta[$i]["gestion"] = $row["gestion"];
					$respuesta[$i]["nomraz_social"] = $row["nomraz_social"];
					$respuesta[$i]["doc_adj"] = $row["doc_adj"];
					$respuesta[$i]["estado_doc"] = $row["estado_doc"];
					$i++; 
				}
				$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
	}
/*****/
	function pasarDocumentoADetalle($idDoc,$idPrestamo){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);
		$consulta = "SELECT iddocumento, tipo_documento
					 FROM documento 
					 WHERE iddocumento = '".$idDoc."'";
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			while($row = mysql_fetch_array($resultado)){
				$consulta2 = "INSERT INTO `archivos`.`cdetalle` (`idprestamo`,`iddoc` ,`tipodoc`)
							  VALUES ('".$idPrestamo."', '".$row["iddocumento"]."', '".$row["tipo_documento"]."')";
				$resultado2 = mysql_query($consulta2);
				if(!$resultado2){
					return 154;
				}
				else{
					//return $resultado." ".$resultado2;
					if(mysql_affected_rows()>0)
						return 1;
					else
						return 0;						
				}
			}			
		}
	}		
/****/
	function listarDetalleTemporal(){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);
		$consulta = "SELECT d.iddocumento, d.num_documento, d.tipo_documento, d.gestion, d.nomraz_social, d.doc_adj
					 FROM cdetalle cd,documento d 
					 WHERE cd.iddoc = d.iddocumento";
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(!(mysql_num_rows($resultado) > 0)){
				return 0;
			}
			else{
				$i = 0;
				while($row = mysql_fetch_array($resultado)){
					$respuesta[$i]["iddocumento"] = $row["iddocumento"];
					$respuesta[$i]["num_documento"] = $row["num_documento"];
					$respuesta[$i]["tipo_documento"] = $row["tipo_documento"];
					$respuesta[$i]["gestion"] = $row["gestion"];
					$respuesta[$i]["nomraz_social"] = $row["nomraz_social"];
					$respuesta[$i]["doc_adj"] = $row["doc_adj"];
					$i++; 
				}
				$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
	}
	/***/
	function vaciarTablaDetalle(){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);
		$consulta = "SELECT * FROM cdetalle";
		$resultado = mysql_query($consulta);
		if(!$resultado)
			return 0;
		else{
			if(!(mysql_num_rows($resultado) > 0))
				return 1;
			else{
				$consulta2 = "TRUNCATE TABLE `cdetalle`";
				$resultado2 = mysql_query($consulta2);
				if(!$resultado2)
					return 0;
				else
					return 1;			
			}	
		}
	}
	/**/
	function verNumPrestamo(){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);
		$consulta = "SELECT idprestamo
					 FROM `prestamo`
					 ORDER BY idprestamo DESC
					 LIMIT 1 ";
		$resultado = mysql_query($consulta);
		if(!$resultado)
			return 0;
		else{
			if(!(mysql_num_rows($resultado) > 0))
				return 1;
			else{
				$row = mysql_fetch_array($resultado);
				$respuesta = $row["idprestamo"];			
			}
			return $respuesta + 1;
		}
	}
	/****/
	function insertarDatosPrestamo($nombre, $ci, $dependencia, $objeto_prestamo, $fecha_prestamo){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);

		$consulta = "INSERT INTO `archivos`.`prestamo` (`nombre`, `ci`, `dependencia` ,`objeto_prestamo` ,`fecha_prestamo`)
					 VALUES ('".$nombre."', '".$ci."', '".$dependencia."', '".$objeto_prestamo."', '".$fecha_prestamo."')";
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(mysql_affected_rows()>0)
				return 1;
			else
				return 0;
		}
	}
	function insertarDetallePrestamo(){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);
		$consulta = "SELECT * FROM cdetalle";
		$resultado = mysql_query($consulta);
		if(!$resultado)
			return 0;
		else{
			$r = 0;
			while($row = mysql_fetch_array($resultado)){
				$consulta2 = "INSERT INTO `archivos`.`detalleprestamo` (`idprestamo`, `tipodoc`, `iddoc`)
							 VALUES ('".$row["idprestamo"]."', '".$row["tipodoc"]."', '".$row["iddoc"]."')";
				$idD = $row["iddoc"];			 
				$resultado2 = mysql_query($consulta2);
				if(!$resultado2){
					$r = 0;
				}
				else{
					if(mysql_affected_rows()>0){
						/**actualizar el estado del documento*/
						$consulta3 = "UPDATE `archivos`.`documento` 
									  SET `estado_doc` = '1' 
							  		  WHERE `documento`.`iddocumento` = '".$idD."'";
						$resultado3 = mysql_query($consulta3);
						$r = 1;
					}
					else
						$r = 0;
				}
			}
			return $r;
		}
	}
	
	function registrarDocumento($fecharegistro,$gestion, $tipo, $numero, $nombre_rs, $detalle, $importe, $doc_adj, $obs){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);
		$consulta = "INSERT INTO `archivos`.`documento` 
					 (`fecharegistro`,`num_documento`,`nomraz_social`,`detalle`,`importe`, 
					  `doc_adj`,`observaciones`,`gestion`,`tipo_documento`,`estado_doc`)
					 VALUES ('".$fecharegistro."', '".$numero."', '".$nombre_rs."', '".$detalle."', '".$importe."', 
					 		 '".$doc_adj."', '".$obs."', '".$gestion."', '".$tipo."','0')";
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(mysql_affected_rows()>0)
				return 1;
			else
				return 0;
		}
		//return $consulta;	
	}
	
	function modificarDocumento($iddoc,$gestion, $tipo, $numero, $nombre_rs, 
		$detalle, $importe, $doc_adj, $obs){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);
		$consulta = "UPDATE `archivos`.`documento` set
					`num_documento`='$numero',
					 `nomraz_social`='$nombre_rs',
					 `detalle`='$detalle',
					 `importe`=$importe, 
					  `doc_adj`='$doc_adj',
					  `observaciones`='$obs',
					  `gestion`='$gestion',
					  `tipo_documento`='$tipo'
					  WHERE iddocumento=$iddoc";
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(mysql_affected_rows()>0)
				return 1;
			else
				return 0;
		}
		//return $consulta;	
	}

	function eliminarDocumento($iddoc){
	//$con = mysql_connect("localhost","root","");
	//mysql_select_db("archivos", $con);
	$consulta = "DELETE FROM documento
				  WHERE iddocumento=$idDoc";
	$resultado = mysql_query($consulta);
	if(!$resultado){
		return 0;
	}
	else{
			return 1;
	}
	//return $consulta;	
}

	function ActualizarEstadoDevolucionDoc($idDoc){
		//$con = mysql_connect("localhost","root","");
		//mysql_select_db("archivos", $con);
		$consulta = "UPDATE `archivos`.`documento` 
					 SET `estado_doc` = '0' 
					 WHERE `documento`.`iddocumento` = '".$idDoc."'";
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(mysql_affected_rows()>0)
				return 1;
			else
				return 0;
		}
		//return $consulta;	
	}
	
	/****/
	function ListDocsRep($tipoDoc,$gestDoc,$tipoOrd){
		$consulta = "SELECT `num_documento`, `nomraz_social`, `detalle`, `importe`,`doc_adj`,`gestion`,`tipo_documento`,`estado_doc`,fecharegistro
					 FROM `documento`
					 WHERE `iddocumento` > 0";
		 		
		if($tipoDoc != "1") 
			$consulta .= " AND `tipo_documento` = '".$tipoDoc."'";
		if($gestDoc != "1")
			$consulta .= " AND `gestion` = '".$gestDoc."'";
		switch($tipoOrd){
			case "1":
				$consulta .= " ORDER BY num_documento";
			break;
			case "2":
				$consulta .= " ORDER BY nomraz_social";
			break;
			default:break;
		}
		
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(!(mysql_num_rows($resultado) > 0)){
				return 0;
			}
			else{
				$i = 0;
				while($row = mysql_fetch_array($resultado)){
					$respuesta[$i]["num_documento"] = $row["num_documento"];
					$respuesta[$i]["nomraz_social"] = $row["nomraz_social"];
					$respuesta[$i]["detalle"] = $row["detalle"];
					$respuesta[$i]["importe"] = $row["importe"];
					$respuesta[$i]["doc_adj"] = $row["doc_adj"];
					$respuesta[$i]["gestion"] = $row["gestion"];
					$respuesta[$i]["tipo_documento"] = $row["tipo_documento"];
					$respuesta[$i]["estado_doc"] = $row["estado_doc"];
					$respuesta[$i]["fecharegistro"]=$row["fecharegistro"];
					$i++; 
				}
				$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
		//return $consulta;
	}
	/***********************************/
	function mostrarDocumento($numero,$tipo,$gestion){
		
		$consulta = "SELECT iddocumento,num_documento, tipo_documento, gestion, nomraz_social, doc_adj
					 FROM documento 
					 WHERE num_documento = '".$numero."'
					 AND tipo_documento = '".$tipo."'
					 AND gestion = '".$gestion."'"
					 ;
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(!(mysql_num_rows($resultado) > 0)){
				return 0;
			}
			else{
				//$i = 0;
				while($row = mysql_fetch_array($resultado)){
					$respuesta/*[$i]*/["iddocumento"] = $row["iddocumento"];
					$respuesta/*[$i]*/["num_documento"] = $row["num_documento"];
					$respuesta/*[$i]*/["tipo_documento"] = $row["tipo_documento"];
					$respuesta/*[$i]*/["gestion"] = $row["gestion"];
					$respuesta/*[$i]*/["nomraz_social"] = $row["nomraz_social"];
					$respuesta/*[$i]*/["doc_adj"] = $row["doc_adj"];
					//$respuesta[$i]["estado_doc"] = $row["estado_doc"];
					/*$i++; */
				}
				//$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
	}

	function listarDoc($tipo,$fecharegistro){
		//$tipo=strtoupper($tipo);
		$consulta = "SELECT iddocumento,num_documento, 
					 tipo_documento, gestion, nomraz_social, doc_adj,
					 observaciones
					 FROM documento 
					 WHERE tipo_documento = '$tipo'
					 AND fecharegistro = '$fecharegistro'"
					 ;
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(!(mysql_num_rows($resultado) > 0)){
				return 0;
			}
			else{
				$i = 0;
				while($row = mysql_fetch_array($resultado)){
					$respuesta[$i]["iddocumento"] = $row["iddocumento"];
					$respuesta[$i]["num_documento"] = $row["num_documento"];
					$respuesta[$i]["tipo_documento"] = $row["tipo_documento"];
					$respuesta[$i]["gestion"] = $row["gestion"];
					$respuesta[$i]["nomraz_social"] = $row["nomraz_social"];
					$respuesta[$i]["doc_adj"] = $row["doc_adj"];
					$respuesta[$i]["observaciones"] = $row["observaciones"];
					//$respuesta[$i]["estado_doc"] = $row["estado_doc"];
					$i++; 
				}
				$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
	}

	function reporteFec($fecharegistro,$gestion){
		//$tipo=strtoupper($tipo);

		if($fecharegistro=='0')
		$consulta = "SELECT iddocumento,num_documento, 
		tipo_documento, gestion, nomraz_social, doc_adj, fecharegistro,
		observaciones
		FROM documento where gestion ='$gestion'" ;
		else
		$consulta = "SELECT iddocumento,num_documento, 
					 tipo_documento, gestion, 
					 nomraz_social, doc_adj,fecharegistro,
					 observaciones
					 FROM documento 
					 WHERE  fecharegistro = '$fecharegistro'
					 and gestion='$gestion'"
					 ;
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return 0;
		}
		else{
			if(!(mysql_num_rows($resultado) > 0)){
				return 0;
			}
			else{
				$i = 0;
				while($row = mysql_fetch_array($resultado)){
					$respuesta[$i]["iddocumento"] = $row["iddocumento"];
					$respuesta[$i]["num_documento"] = $row["num_documento"];
					$respuesta[$i]["tipo_documento"] = $row["tipo_documento"];
					$respuesta[$i]["fecharegistro"] = $row["fecharegistro"];
					$respuesta[$i]["gestion"] = $row["gestion"];
					$respuesta[$i]["nomraz_social"] = $row["nomraz_social"];
					$respuesta[$i]["doc_adj"] = $row["doc_adj"];
					$respuesta[$i]["observaciones"] = $row["observaciones"];
					//$respuesta[$i]["estado_doc"] = $row["estado_doc"];
					$i++; 
				}
				$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
	}

	function verDoc($iddoc){
		//$tipo=strtoupper($tipo);
		$consulta = "SELECT iddocumento,num_documento, 
		tipo_documento, gestion, nomraz_social, doc_adj,
		detalle,importe,
		observaciones
					 FROM documento 
					 WHERE iddocumento = $iddoc"
					 ;
		$resultado = mysql_query($consulta);
		$i = 0;
		while($row = mysql_fetch_array($resultado)){
			$respuesta[$i]["iddocumento"] = $row["iddocumento"];
			$respuesta[$i]["num_documento"] = $row["num_documento"];
			$respuesta[$i]["tipo_documento"] = $row["tipo_documento"];
			$respuesta[$i]["gestion"] = $row["gestion"];
			$respuesta[$i]["detalle"] = $row["detalle"];
			$respuesta[$i]["importe"] = $row["importe"];
			$respuesta[$i]["nomraz_social"] = $row["nomraz_social"];
			$respuesta[$i]["doc_adj"] = $row["doc_adj"];
			$respuesta[$i]["observaciones"] = $row["observaciones"];
			//$respuesta[$i]["estado_doc"] = $row["estado_doc"];
			$i++; 
		}
		$respuesta["nfilas"] = $i;
				return $respuesta;
	}

}

?>