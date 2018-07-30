$(document).ready(function(){

    
    // var mi_id = $(this).attr("data-number");
    var mi_id = $("#editaId").attr("data-number");
    // console.log(mi_id);
    $.ajax({
        method: "GET",
        url: "../templates/adm_profesor/getEditarEjercicio.php",
        data: { id: mi_id },
        success: function(response){
            var resultado = response.substring(23);
            var res = JSON.parse(resultado);

            if(response !== null){
                
                $("#editaId").val(res.nombre);
                $("#editaDueno").val(res.dueno);
                $("#editaTablas").val(res.tablas);
                var cont = 1;
                $.each(res.todasCategorias,function(registro, value) {
                    if(res.categoria === value){
                        $("#editaCategoria").append('<option value=c'+cont+' selected>'+value+'</option>');
                    }else{
                        $("#editaCategoria").append('<option value=c'+cont+'>'+value+'</option>');

                    }
                    cont++;
                });
                
                if("facil" === res.nivel){
                    $("#editaNivel").append('<option value="facil" selected>Principiante</option>');
                    $("#editaNivel").append('<option value="medio">Intermedio</option>');
                    $("#editaNivel").append('<option value="dificil">Avanzado</option>');
                }else if("medio" === res.nivel){
                    $("#editaNivel").append('<option value="facil">Principiante</option>');
                    $("#editaNivel").append('<option value="medio" selected>Intermedio</option>');
                    $("#editaNivel").append('<option value="dificil">Avanzado</option>');
                }else if("dificil" === res.nivel){
                    $("#editaNivel").append('<option value="facil">Principiante</option>');
                    $("#editaNivel").append('<option value="medio">Intermedio</option>');
                    $("#editaNivel").append('<option value="dificil" selected>Avanzado</option>');
                }

                if(res.deshabilitar === "0"){
                    $("#editaDeshabilitar").append('<option value="0" selected>Habilitado</option>');
                    $("#editaDeshabilitar").append('<option value="1" >Deshabilitado</option>');
                }else{
                    $("#editaDeshabilitar").append('<option value="0" >Habilitado</option>');
                    $("#editaDeshabilitar").append('<option value="1" selected>Deshabilitado</option>');
                }
                $("#editaDescripcion").val(res.descripcion);
                $("#editaEnunciado").val(res.enunciado);
                $("#editaSolucion").val(res.solucion);
            }
        }
    })
});