$(document).ready(function(){

	var mi_id = $("#infoHojaId").attr("data-number");
    //console.log(mi_id);
     $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getEditarHojaEjercicio.php",
            data: { id: mi_id },
            success: function(response){
                //console.log(response);
                var resultado = response.substring(23);
                var res = JSON.parse(resultado);
                numEjerHoja = res["numEjercicios"];
                var id_hoja = res["id_hoja"];
                var nombre_hoja = res["nombre_hoja"];
                var hayEjercicios = res["hayEjercicios"];
                
                delete res["id_hoja"];
                delete res["nombre_hoja"];
                delete res["hayEjercicios"];
                delete res["numEjercicios"];
                
                if(response !== null){
                    if (hayEjercicios !== 0 ){
                        
                        $("#infoHojaId").val(id_hoja);
                        $("#infoHojaNombre").val(nombre_hoja);
                        $("#tabla_info_hoja_ejercicios > tbody").empty();
                        var cont = 1;
                        $.each(res,function(registro, value) {
                            
                            fila = '<tr>';
                            fila += '<td>'+value['descripcion']+'</td>';
                            fila += '<td>'+value['nivel']+'</td>';
                            fila += '<td>'+value['tipo']+'</td>';
                            fila += '<td>'+value['creador_ejercicio']+'</td>';
                            fila += '<td id="rowVerEjerInfo" class="boton_ver_ejercicio" data-number='+ value["id_ejercicio"] +'><a data-toggle="modal" href="#modalVerEjercicioInfo"><i id="icon_ver" class="fa fa-eye" title="ver" aria-hidden="true"></i></a></td>'
                            fila += '</tr>';
                    
                            $('#tabla_info_hoja_ejercicios tbody').append(fila);

                        });
                    }else{
                        $("#infoHojaId").val(id_hoja);
                        $("#infoHojaNombre").val(nombre_hoja);
                        $("#tabla_info_hoja_ejercicios > tbody").empty();
                    }
                }
            }
        });



});