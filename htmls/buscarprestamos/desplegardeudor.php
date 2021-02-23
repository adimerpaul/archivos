<?PHP 
//echo "vengo de php y la hora en el servidor es: ".date("d-m-Y");
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = "GAAnUEVAvIDA"; 
$bd_base = "archivos"; 

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 

mysql_select_db($bd_base, $con); 
switch($_POST['opcion']){
 case 1:
 $cons = "SELECT nombre,fecha_prestamo, prestamo.idprestamo as p, `num_documento`,`gestion`,`tipo_documento` 
		  FROM `documento`, detalleprestamo, prestamo
		  WHERE documento.iddocumento=detalleprestamo.iddoc
		  AND detalleprestamo.idprestamo=prestamo.idprestamo
		  AND documento.estado_doc=1
		  AND nombre like '%".$_POST['nom']."%'";

 $resultado = mysql_query($cons);
 //echo $cons;
 if(!$resultado) die("fallo la consulta");
 else{
  if(!(mysql_num_rows($resultado)>0)) 
 	 echo "No existen resultado de la busqueda!";
  else{
	 $table = "<table border=\"1\" cellspacing=\"0\">";
	 $table .= "<tr class=\"rotulo\">";
	 $table .= "<td>N&ordm;</td>";
	 $table .= "<td>NOMBRE</td>";
	 $table .= "<td>FECHA DE<br /> PRESTAMO</td>";
	 $table .= "<td>N&ordm; DE<br /> PRESTAMO</td>";
	 $table .= "<td>N&ordm; DE<br /> DOCUMENTO</td>";
	 $table .= "<td>GESTION</td>";
	 $table .= "<td>TIPO DE DOCUMENTO</td>";
	 $table .= "</tr>";
	 $i=1;
 	 while($fila = mysql_fetch_array($resultado)){
	 	 $table .= "<tr>";
		 $table .= "<td>".$i."</td>";
		 $table .= "<td>".$fila['nombre']."</td>";
		 $table .= "<td align=\"center\">".$fila['fecha_prestamo']."</td>";
		 $table .= "<td align=\"center\">".$fila['p']."</td>";
		 $table .= "<td align=\"center\">".$fila['num_documento']."</td>";
		 $table .= "<td align=\"center\">".$fila['gestion']."</td>";
		 $table .= "<td align=\"center\">".$fila['tipo_documento']."</td>";
		 $table .= "</tr>";
	 	 $i++;
		 }
		 
	 $table .= "</table>";
	 echo $table;
  }
 }
 break;
 default:break;
}
?>