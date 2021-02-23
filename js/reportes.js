// JavaScript Document
$(document).ready(
	function(){
		$("#Reportes div[id^=\"pars\"]").hide();
		$("#Reportes input[type=\"radio\"][name=\"tiporep\"]").click(
			function(){
				$("#Reportes div[id^=\"pars\"]").hide();
				$("#Reportes #pars_"+$(this).val()).show();
			}
		);
		$("#bMostrarRep").click(
			function(){
				tiporep = $("#Reportes input[type=\"radio\"][name=\"tiporep\"]:checked").val();
				switch(tiporep){
					case 'list_docs':
						tipoDoc = $("#tipoDoc").val();
						gestDoc = $("#gestDoc").val();
						ord = $("input:radio[name=\"ord\"]:checked").val();
						switch(ord){
							case "numdoc":
								tipoOrd = "1";
							break;
							case "nombre":
								tipoOrd = "2";
							break;
							default:
								tipoOrd = "0";
							break;
						}
						//alert("tipoDoc="+tipoDoc+" gestDoc="+gestDoc+" ord="+tipoOrd);
						window.open('htmls/hojareportes.php?tipoRep=1&tipoDoc='+tipoDoc+'&gestDoc='+gestDoc+'&tipoOrd='+tipoOrd, 'Hoja de Reporte','status=no,toolbar=yes,scrollbars=yes,titlebar=no,menubar=yes,resizable=yes,width=800,height=500,directories=no,location=no');
					break;
					case 'list_pres':
						//alert(tiporep);
						window.open('htmls/hojareportes.php?tipoRep=2', 'Hoja de Reporte','status=no,toolbar=yes,scrollbars=yes,titlebar=no,menubar=yes,resizable=yes,width=800,height=500,directories=no,location=no');
					break;
					case 'list_detpres':
						if($.trim($("#np").val())!=""){
							window.open('htmls/hojaprestamo.php?np='+$("#np").val(), 'Hoja de Prestamo','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=yes,resizable=yes,width=800,height=500,directories=no,location=no');
						}
						else{
							alert("Numero de Prestamo Vacio.");
						}
					break;
					/********************************/
					case 'doc_pres':
						if($.trim($("#nd").val())!=""){
							tipoDocPres = $("#tipoDocPres").val();
							gestionDocPres=$("#gestionDocPres").val();
							window.open('htmls/hojadocprestado.php?nd='+$("#nd").val()+'&td='+tipoDocPres+'&ge='+gestionDocPres, 'Documento Prestao','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=yes,resizable=yes,width=800,height=500,directories=no,location=no');
						}
						else{
							alert("Numero de Documento Vacio.");
						}
					break;
					default:break;
				}
			}
		);
	}
);