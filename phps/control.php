<?PHP
	session_start();
	include_once "../clases/dbconexion.php";
	$dbcnx = new dbcnx();
	$dbcnx->db();
	
	switch($_POST["opcion"]){
		case "1":
			$usuario = $_POST["usuario"];
			$password = $_POST["password"];
			$respuesta = verificarUsuario($usuario, md5($password));
			if($respuesta != "0"){
				//$_SESSION["id"] = $respuesta["idusuario"];
				$_SESSION["nombre"] = $respuesta["nombre"];
				$_SESSION["usuario"] = $respuesta["cuenta"];
				$_SESSION["sesion"] = "archivos"; 
				echo "1";
			}
			else{
				echo $respuesta;
			}	
		break;
		case "2":
			//header("Location:prestamo.php");
			//echo "hola munod";
			session_destroy();
		break;
		default:break;
	}
	
	function verificarUsuario($usuario, $password){
		
		$consulta = "SELECT *
					 FROM usuario u
					 WHERE u.cuenta = '".$usuario."'
					 AND u.password = '".$password."'";
		$resultado = mysql_query($consulta);
		if(!$resultado){
			return "0";
		}
		else{
			if(!(mysql_affected_rows()>0)){
				return "0";
			}
			else{
				$row = mysql_fetch_array($resultado);
				return $row;
			}
		}			 
				 
	}
?>