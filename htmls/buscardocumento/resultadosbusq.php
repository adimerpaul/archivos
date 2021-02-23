<?PHP

	$con = mysql_connect("localhost", "root", "GAAnUEVAvIDA");
	mysql_select_db("archivos",$con);
	
	$consulta = "SELECT `iddocumento`,`fecharegistro`,`num_documento`,`nomraz_social`,
				`detalle`,`importe`,`doc_adj`,`observaciones`,`gestion`,`tipo_documento`,`estado_doc`
				FROM `documento` 
				WHERE `num_documento`='".$_POST["nDoc"]."'";
	//echo $consulta;			 
	$resultado = mysql_query($consulta);
	if(!$resultado)
		echo "Error en la Consulta SQL";
	else{
		if(mysql_num_rows($resultado) <= 0)
			echo "No se Produjo Resultado";
		else{
			
			$table = "<br />";
			$table.= "<table align=\"center\" border=\"1\">";
			$table.= "<tr>";
			$table.= "<th colspan=\"9\" class=\"titulo\">Datos del Documento<input id=\"idReg\" type=\"hidden\" value=\"".$reg['iddocumento']."\"/></th>";
			$table.= "</tr>";
			$table.= "<tr>";
			$table.= "<th>N° de <br /> Doc.</th>";
			$table.= "<th>Tipo <br />de Doc.</th>";
			$table.= "<th>Gesti&oacute;n</th>";
			$table.= "<th>Nombre o Raz&oacute;n Social</th>";
			$table.= "<th>Detalle</th>";
			$table.= "<th>Importe</th>";
			$table.= "<th>Documentos <br /> Adjuntos</th>";
			$table.= "<th>Observaciones</th>";
			$table.= "<th>Fecha de <br />Registro</th>";
			$table.= "</tr>";
			while ($reg = mysql_fetch_array($resultado))
			{
			  $table.= "<tr>";
			  $table.= "<td align=\"center\" style=\"font-size:18px;\"><strong>".$reg['num_documento']."</strong></td>";
			  $table.= "<td align=\"center\" style=\"color:#00F; font-weight:bold; font-size:16px;\">".$reg['tipo_documento']."</td>";
			  $table.= "<td align=\"center\" style=\"color:#F00; font-weight:bold; font-size:16px;\">".$reg['gestion']."</td>";
			  $table.= "<td>".$reg['nomraz_social']."</td>";
			  $table.= "<td style=\"font-size:12px; width:140px;\">".$reg['detalle']."</td>";
			  $table.= "<td>".$reg['importe']."</td>";
			  $table.= "<td style=\"font-size:12px; width:120px;\">".$reg['doc_adj']."</td>";
			  $table.= "<td style=\"font-size:12px; width:120px;\">".$reg['observaciones']."</td>";
			  $table.= "<td style=\"font-size:12px;\">".darFormatoFecha($reg['fecharegistro'])."</td>";
			  //$table.= "<td>".$reg['fecharegistro']."</td>";
			  $table.= "</tr>";		  
			}
			$table.= "</table>";
			echo $table;
		}	
	}
	 /**funcion para modificar fecha**/
function darFormatoFecha($fecha){
	return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
}		
?>