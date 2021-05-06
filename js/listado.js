$(document).ready(function(){

var fechoy= new Date();
var dia=0;
var mes=0;
if(fechoy.getDate()<10)
    dia='0'+fechoy.getDate();
else dia=fechoy.getDate();
if((fechoy.getMonth()+1)<10)
mes='0'+(fechoy.getMonth()+1);
else
mes=(fechoy.getMonth()+1);
var anio=fechoy.getFullYear()
$('#listfechareg').val(anio+'-'+mes+'-'+dia);





$('#buscarDocumento').click(function(){
    /****/
    console.log($("#tipo").val());
    console.log($("#listfechareg").val());
$.post(
    "phps/flistado.php",
    {"opcion" : "1",
     "tipo" : $("#tipo").val(),
     "listfechareg" : $("#listfechareg").val()
    },
    function(data){
        if(data!='0')
            $("#ResListado #detalle").html(data+"<br/>");
        else
            $("#ResListado #detalle").html('no existen registros'+"<br/>");
        
    }
    )
    })

$('#RepfecDocumento').click(function(){
    /****/
    console.log($("#listfechareg").val());
$.post(
    "phps/freporte.php",
    {"opcion" : "1",
     "listfechareg" : $("#listfechareg").val(),
     "listgestion":$('#listgestion').val(),
    },
    function(data){
        if(data!='0')
            $("#ResListado #detalle").html(data+"<br/>");
        else
            $("#ResListado #detalle").html('no existen registros'+"<br/>");
        
    }
    )
    })
    $('#todoDocumento').click(function(){
        /****/
       
    $.post(
        "phps/freporte.php",
        {"opcion" : "1",
         "listfechareg" : '0',
         "listgestion":$('#listgestion').val(),
        },
        function(data){
            if(data!='0')
                $("#ResListado #detalle").html(data+"<br/>");
            else
                $("#ResListado #detalle").html('no existen registros'+"<br/>");
            
        }
        )
        })
});
