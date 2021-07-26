<?PHP
	@session_start();
	if(isset($_SESSION["sesion"]) && $_SESSION["sesion"]=="archivos"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prestamo de Archivos</title>
<script type="application/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="application/javascript" src="js/registro.js"></script>
<script type="application/javascript" src="js/prestamo.js"></script>
<script type="application/javascript" src="js/devolucion.js"></script>
<script type="application/javascript" src="js/reportes.js"></script>
<script type="application/javascript" src="js/listado.js"></script>
<script type="application/javascript" src="js/jquery-3.5.1.js"></script>
<script type="application/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="application/javascript" src="js/jszip.min.js"></script>
<script type="application/javascript" src="js/pdfmake.min.js"></script>
<script type="application/javascript" src="js/vfs_fonts.js"></script>
<script type="application/javascript" src="js/dataTables.buttons.min.js"></script>
<script type="application/javascript" src="js/buttons.html5.min.js"></script>
<script type="application/javascript" src="js/chart.js"></script>

<link type="text/css" rel="stylesheet" href="css/estilo.css"/>
<link type="text/css" rel="stylesheet" href="css/jquery.dataTables.min.css"/>
<link type="text/css" rel="stylesheet" href="css/buttons.dataTables.min.css"/>

</head>
<body>
  <div id="documento">
	<div id="cabecera"></div>
    <div id="datos">
    	Usuario: <span class="sp_user"><?PHP echo $_SESSION["nombre"]?></span>
        &nbsp;&nbsp;&nbsp;
        <span id="cerrarS">Cerrar Sesión</span>
    </div>
    <div id="menu">
    	<div id="op_1">Registro</div>
        <div id="op_2">Prestamo</div>
        <div id="op_3">Devolucion</div>
        <div id="op_4">Reportes</div>
        <div id="op_5">Listado</div>
        <div id="op_7">Reg Reporte</div>
        <div id="op_8">Buscar Compro</div>
        <div id="op_9">Resumen</div>
    </div>
    <div id="contenido" style="height:500px auto;">
    	<?PHP 
			switch($_GET["op"]){
				case "1":
					include "htmls/registro.html";
				break;
				case "2":
					include "htmls/fprestamo.html";
				break;
				case "3":
					include "htmls/devolucion.html";
				break;
				case "4":
					include "htmls/reportes.html";
				break;
				case "5":
					include "htmls/listado.html";
				break;
				case "6":
					{include "htmls/modificar.html";
						?>
						<script>
							$("#iddocumento").val(<?php echo $_GET["id"];?>);
							recuperar();
						</script>
						<?php					
					}
				break;
				case "7":
					include "htmls/reporte.html";
					break;
				case "8":
					include "htmls/buscar.html";
					break;
				case "9":
					{include "htmls/resumen.html";
					?>
					<Script ></Script>
					<?php
					}
			}
			//include "htmls/registro.html";
		?>
    </div>
    <div id="pie">Gobierno Autonomo Municipal de Oruro - Sistemas &copy; 2021 </div>
  </div>    
</body>

</html>
<?PHP 
	}
	else{
		echo "<div>Acceso Negado</div>";
	}
?>