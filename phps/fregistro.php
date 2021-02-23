<?PHP
include_once "../clases/documento.php";
/*****/
include_once "../clases/dbconexion.php";
	$dbcnx = new dbcnx();
	$dbcnx->db();
/*****/
if(isset($_POST["opcion"])){
	switch($_POST["opcion"]){
		case "1":
			$doc = new Documento();
			$fecharegistro = date("Y-m-d");
			$gestion = trim($_POST["gestion"]);
			$tipo = trim($_POST["tipo"]);	
			$numero = trim($_POST["numero"]);	
			$nombre_rs = trim($_POST["nombre_rs"]);
			$detalle = trim($_POST["detalle"]);	
			$importe = trim($_POST["importe"]);	
			$doc_adj = trim($_POST["doc_adj"]);	
			$obs = trim($_POST["obs"]);
			
			echo $doc->registrarDocumento($fecharegistro,$gestion,$tipo,$numero,$nombre_rs,$detalle,$importe,$doc_adj,$obs);
		break;
	}
}
