<?PHP

	$con = mysql_connect("localhost", "root", "GAAnUEVAvIDA");
	mysql_select_db("archivos",$con);
	
	$consulta = "SELECT `iddocumento`,`fecharegistro`,`num_documento`,`nomraz_social`,
				`detalle`,`importe`,`doc_adj`,`observaciones`,`gestion`,`tipo_documento`,`estado_doc`
				FROM `documento` 
				WHERE `num_documento`='".$_POST["nDoc"]."'
				       and `gestion`='".$_POST["gestion"]."'
					   and `tipo_documento`='".$_POST["tDoc"]."'";
	//echo $consulta;			 
	$resultado = mysql_query($consulta);
	if(!$resultado)
		echo "Error en la Consulta SQL";
	else{
		if(mysql_num_rows($resultado) <= 0)
			echo "No se Produjo Resultado";
		else{
			
			$table = "<br />";
			while ($reg = mysql_fetch_array($resultado))
			{
			  $table.= "<table align=\"center\" border=\"1\" >";
			  $table.= "<tr>";
			  $table.= "<th colspan=\"2\" class=\"titulo\">Datos del Documento<input id=\"idReg\" type=\"hidden\" value=\"".$reg['iddocumento']."\"/></th>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th align=\"right\">Fecha de registro:</th>";
			  $table.= "<td>".darFormatoFecha($reg['fecharegistro'])."</td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th>Numero de Documento:</th>";
			  $table.= "<td>".$reg['num_documento']."</td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th>Nombre o razon Social:</th>";
			  $table.= "<td><input size=\"50\" maxlength=\"50\" id=\"nomrs\" value=\"".$reg['nomraz_social']."\" /></td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th align=\"right\">Detalle:</th>";
			  $table.= "<td ><input size=\"100\" id=\"detalle\" value=\"".$reg['detalle']."\" /></td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th align=\"right\">Importe:</th>";
			  $table.= "<td ><input size=\"8\" maxlength=\"10\" id=\"importe\" value=\"".$reg['importe']."\" /></td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th>Documentos Adjuntos:</th>";
			  $table.= "<td ><input size=\"90\" id=\"docadj\" value=\"".$reg['doc_adj']."\" /></td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th align=\"right\">Observaciones:</th>";
			  $table.= "<td><input size=\"90\" id=\"observaciones\" value=\"".$reg['observaciones']."\" /></td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th align=\"right\">Gesti&oacute;n:</th>";
			  $table.= "<td>".$reg['gestion']."</td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<th align=\"right\">Tipo de documento:</th>";
			  $table.= "<td>".$reg['tipo_documento']."</td>";
			  $table.= "</tr>";
			  $table.= "<tr>";
			  $table.= "<td colspan=\"2\">";
			  $table.= "<div align=\"right\" style=\"padding:5px\"><button id=\"bModificar\">Modificar</button></div>";
			  $table.= "</td>";
			  $table.= "</tr>";
			  $table.= "</table>";
			  
			 }
			 echo $table;
		}	
	}
	 /**funcion para modificar fecha**/
function darFormatoFecha($fecha){
	return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
}	
?>