<?PHP
	$con = mysql_connect("localhost", "root", "GAAnUEVAvIDA");
	mysql_select_db("archivos",$con);
	
	$consulta = "
				UPDATE `archivos`.`documento` 
				SET `nomraz_social` = '".$_POST["nomrs"]."', `detalle` = '".$_POST["detalle"]."', `importe` = '".$_POST["importe"]."', 
				`doc_adj` = '".$_POST[	"docadj"]."', `observaciones` = '".$_POST["observaciones"]."' 
				WHERE `documento`.`iddocumento` = ".$_POST["idReg"]." 
				";
	//echo $consulta;			 
	$resultado = mysql_query($consulta);
	if(!$resultado)
		echo "Error en la Consulta SQL";
	else{
		if(mysql_affected_rows() > 0){
			echo "Se Actualizaron los Datos.";
		}
		else
			echo "No se Actualizaron los datos.";
	}
?>