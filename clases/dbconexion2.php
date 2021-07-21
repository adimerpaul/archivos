<?PHP
class dbcnx{
	var $host;
	var $usuario;
	var $password;
	var $db;
	var $cnx;

	function dbcnx($host = "example_database", $usuario = "example_user", $password = "password"){
		$this->host = $host;
		$this->usuario = $usuario;
		$this->password = $password;

		$this->cnx = @mysql_connect($this->host, $this->usuario, $this->password) or die("Error: No hay conexion.");
		//echo "acac";
	}

	function db($db = "archivos"){
		$this->db = $db;
		@mysql_select_db($this->db, $this->cnx) or die("Error: Base de Datos Inexistente.");
	}
}
?>