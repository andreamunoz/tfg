$(document).ready(function(){

    	var mi_id = $("#editaHojaId").attr("data-number");
    	// console.log(mi_id);
    	 $.ajax({
                method: "GET",
                url: "../templates/adm_profesor/getEditarHojaEjercicio.php",
                data: { id: mi_id },
                success: function(response){
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

                            $("#editaHojaId").val(id_hoja);
                            $("#editaHojaNombre").val(nombre_hoja);
                            $("#tabla_editar_hoja_ejercicios > tbody").empty();
                            var cont = 1;
                            $.each(res,function(registro, value) {
                                
                                fila = '<tr><td class="primera"><input type="checkbox" class="form-check-input" id="checkbox-editar-hoja" name="seleccionadosEdHoja[]" value='+ value["id_ejercicio"] +'></td>';
                                fila += '<td>'+value['descripcion']+'</td>';
                                fila += '<td>'+value['nivel']+'</td>';
                                fila += '<td>'+value['tipo']+'</td>';
                                fila += '<td>'+value['creador_ejercicio']+'</td>';
                                fila += '<td id="rowVer" class="boton_ver_ejercicio" data-number='+ value["id_ejercicio"] +'><a data-toggle="modal" href="#modalVerEejercicio"><i id="icon_ver" class="fa fa-eye" title="ver" aria-hidden="true"></i></a></td>'
                                fila += '</tr>';
                        
                                $('#tabla_editar_hoja_ejercicios tbody').append(fila);

                            });
                        }else{
                            $("#editarHojaEjercicio").show();
                            $("#listarHojaEjercicios").hide();

                            $("#editaHojaId").val(id_hoja);
                            $("#editaHojaNombre").val(nombre_hoja);
                            $("#tabla_editar_hoja_ejercicios > tbody").empty();
                        }
                    }
                }
            });
    	 $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getListarHojas.php",
            data: { orden: 0 },
            success: function(response){
                
                var resultado = response.substring(23);
                
                if(response !== null){
                    $("#table-listar-hojas > tbody").append(resultado);

                }
            }
        });
});