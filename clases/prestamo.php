<?PHP
class Prestamo{
	function DatosPrestamo($numero){
		//$con = mysql_connect("localhost","root","GAAnUEVAvIDA");
		//mysql_select_db("archivos", $con);
		$consulta = "SELECT * 
					 FROM `prestamo` 
					 WHERE `idprestamo` = '".$numero."'";
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
					$respuesta/*[$i]*/["nombre"] = $row["nombre"];
					$respuesta/*[$i]*/["ci"] = $row["ci"];
					$respuesta/*[$i]*/["dependencia"] = $row["dependencia"];
					$respuesta/*[$i]*/["objeto_prestamo"] = $row["objeto_prestamo"];
					$respuesta/*[$i]*/["fecha_prestamo"] = $row["fecha_prestamo"];
					//$i++; 
				}
				//$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
	}
	/***/
	function DetallePrestamo($numero){
		
		$consulta = "SELECT d.iddocumento, d.num_documento, 
					d.tipo_documento, d.gestion, d.nomraz_social, 
					d.doc_adj,d.observaciones, d.estado_doc
					 FROM detalleprestamo dp, documento d
					 WHERE dp.iddoc = d.iddocumento
					 AND dp.idprestamo = '".$numero."'";			 
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
					//$respuesta[$i]["iddoc"] = $row["iddoc"];
					$respuesta[$i]["iddocumento"] = $row["iddocumento"];
					$respuesta[$i]["num_documento"] = $row["num_documento"];
					$respuesta[$i]["tipo_documento"] = $row["tipo_documento"];
					$respuesta[$i]["gestion"] = $row["gestion"];
					$respuesta[$i]["nomraz_social"] = $row["nomraz_social"];
					$respuesta[$i]["doc_adj"] = $row["doc_adj"];
					$respuesta[$i]["estado_doc"] = $row["estado_doc"];
					$respuesta[$i]["observaciones"] = $row["observaciones"];
					
					$i++; 
				}
				$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
	}
	function listPrestamos(){
		$consulta = "SELECT * 
					 FROM `prestamo`";
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
					$respuesta[$i]["idprestamo"] = $row["idprestamo"];
					$respuesta[$i]["nombre"] = $row["nombre"];
					$respuesta[$i]["ci"] = $row["ci"];
					$respuesta[$i]["dependencia"] = $row["dependencia"];
					$respuesta[$i]["objeto_prestamo"] = $row["objeto_prestamo"];
					$respuesta[$i]["fecha_prestamo"] = $row["fecha_prestamo"];
					$i++; 
				}
				$respuesta["nfilas"] = $i;
				return $respuesta;
			}
		}
	}
	/********************************************/
	function DocumentoPrestado($numero,$tipo,$gestion){
		
		$consulta = "SELECT p.idprestamo, p.nombre, p.ci, p.dependencia, p.objeto_prestamo,p.fecha_prestamo
					 FROM (
       						SELECT dt.idprestamo,t.iddocumento,t.num_documento,t.tipo_documento,t.estado_doc
       						FROM detalleprestamo dt,
							(
								SELECT iddocumento,num_documento,tipo_documento,estado_doc,gestion
								FROM documento
								WHERE num_documento = '".$numero."'
								and tipo_documento = '".$tipo."'
								and gestion = '".$gestion."'
								and estado_doc = '1'
							)t
       						WHERE t.iddocumento = dt.iddoc  
      					  )t2, prestamo p
					 WHERE t2.idprestamo = p.idprestamo
					 ORDER BY p.idprestamo DESC
					 LIMIT 1";			 
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
					//$respuesta[$i]["iddoc"] = $row["iddoc"];
					
					$respuesta/*[$i]*/["idprestamo"] = $row["idprestamo"];
					$respuesta/*[$i]*/["nombre"] = $row["nombre"];
					$respuesta/*[$i]*/["ci"] = $row["ci"];
					$respuesta/*[$i]*/["dependencia"] = $row["dependencia"];
					$respuesta/*[$i]*/["objeto_prestamo"] = $row["objeto_prestamo"];
					$respuesta/*[$i]*/["fecha_prestamo"] = $row["fecha_prestamo"];
					//$respuesta/*[$i]*/["estado_doc"] = $row["estado_doc"];
					
					//$i++; 
				}
				//$respuesta["nfilas"] = $i;
				 
				return $respuesta;
			}
		}
	}
}
?>