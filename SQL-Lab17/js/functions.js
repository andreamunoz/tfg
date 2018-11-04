
$(document).ready(function () {

    username = $(this).find("#userPrincipal").attr("data-name");

    setTimeout(function () {
        $('#modalwindow').hide();
    }, 6000);

    setTimeout(function () {
        $('#modalsolucion').hide();
    }, 5000);

    setTimeout(function () {
        $('#modalsheet').hide();
    }, 5000);

    /*Mostrar los nombres de los profesores que tengan creadas tablas*/
    $.ajax({
        type: "POST",
        url: "../templates/adm_profesor/getUser.php",
        data: { prof: username },
        success: function (response)
        {
            $(".selector-user select").html(response).fadeIn();
        }
    });

    /*Mostrar las tablas del profesor seleccionado*/
    var form_data = {
        is_ajax: 1,
        dueno: username
    };
    $.ajax({
        type: "POST",
        url: "../templates/adm_profesor/getTablas.php",
        data: form_data,
        success: function (response)
        {
            $('.selector-tabla select').html(response).fadeIn();
        }
    });

    $(".selector-user select").change(function() {
        var form_data = {
                is_ajax: 1,
                dueno: $(".selector-user select option:checked").val(),
                cambio: true
        };
        $.ajax({
                type: "POST",
                url: "../templates/adm_profesor/getTablas.php",
                data: form_data,
                success: function(response)
                {   
                    $('.selector-tabla select').html(response).fadeIn();
                }
        });
    });

    $(".selector-tabla select").change(function() {
        var form_data = {
            is_ajax: 1,
            tabla: $(".selector-tabla select option:checked").val()
        };
        $.ajax({
            type: "POST",
            url: "adm_profesor/getColumns.php",
            data: form_data,
            success: function(response)
            {   
                $('.columnas-tabla #columnas tbody').html(response).fadeIn();
            }
        });
    });

    $(".selector-tabla select").click(function() {
        var form_data = {
            is_ajax: 1,
            tabla: $(".selector-tabla select option:checked").val()
        };
        $.ajax({
            type: "POST",
            url: "adm_profesor/getColumns.php",
            data: form_data,
            success: function(response)
            {   
                $('.columnas-tabla #columnas tbody').html(response).fadeIn();
            }
        });
    });

    $(".selector-tabla-sol select ").change(function(){
        
        var form_data = {
            is_ajax: 1,
            tabla: $(".selector-tabla-sol select option:checked").val()
        };
        console.log(form_data.tabla);
        if (form_data.tabla !== ""){

            $.ajax({
                type: "POST",
                url: "adm_profesor/getStructure.php",
                data: form_data,
                success: function(response)
                {   
                    $('.structure tbody').html(response).fadeIn();
                }
            });
            $.ajax({
                type: "POST",
                url: "adm_profesor/getHeadColumns.php",
                data: form_data,
                success: function(response)
                {   
                    $('.data thead').html(response).fadeIn();
                }
            });
            $.ajax({
                type: "POST",
                url: "adm_profesor/getData.php",
                data: form_data,
                success: function(response)
                {   
                    $('.data tbody').html(response).fadeIn();
                }
            });
        }else{
            $('.structure tbody').html("").fadeIn();
            $('.data tbody').html("").fadeIn();
        }
    });


/*****Avisos al dueño de la hoja cuando se modifica algun ejercicio*****/
    $('.marcarLeidos').click(function(){      
        var mi_user = $(this).attr("data-name");

        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getMarcarAvisosLeidos.php",
            data: { user: mi_user },
            success: function(response)
            {
                location.reload();
            }
        });
              
    });

    $('.mostrarTodos').click(function(){      
        var mi_user = $(this).attr("data-name");

        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getMostrarTodosAvisos.php",
            data: { user: mi_user },
            success: function(response)
            {
                var resultado = response.substring(23);
                var res = JSON.parse(resultado);
                $('#avisos').empty();
                $('#avisos').append('<h5>AVISOS</h5>');
                for(i=0; i<res.length; i++){
                    $('#avisos').append('<div class="aviso">'+res[i]+'</div>');
                }
                $('#avisos').append('<div class="row"><div class="col-md-6 marcarTodosLeidos" data-name="'+mi_user+'">Marcar todos los avisos como leídos</div><div class="col-md-6 mostrarNuevos" data-name="'+mi_user+'">Mostrar solo los avisos nuevos</div></div>');

            }
        });    
    });

    $('#avisos').on("click", ".marcarTodosLeidos", function(){      
        var mi_user = $(this).attr("data-name");
        // console.log("ESTOY EN MARCAR TODOS LEIDOS");
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getMarcarAvisosLeidos.php",
            data: { user: mi_user },
            success: function(response)
            {
                location.reload();
            }
        });
              
    });

    $('#avisos').on("click", ".mostrarNuevos", function(){ 

        location.reload();
              
    });
    
/***** FIN AVISOS *****/


    $('.resaltado').click(function(){      
        var tabla = $(this).attr("data-name");

        $('#nav-table-structure thead').html('<tr> <th style="width:30%;">Nombre Columna</th><th style="width:30%;">Tipo Columna</th><th style="width:20%;">Clave</th></tr>');
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getData.php",
            data: { tabla: tabla },
            success: function(response)
            {
                // console.log(response);
                $('#nav-table-datos tbody').html(response).fadeIn();
            }
        });
        $.ajax({
                type: "POST",
                url: "../templates/adm_profesor/getHeadColumns.php",
                data: { tabla: tabla },
                success: function(response)
                {   
                    $('#nav-table-datos thead').html(response).fadeIn();
                }
            });
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getStructure.php",
            data: { tabla: tabla },
            success: function(response)
            {
                // console.log(response);
                $('#nav-table-structure tbody').html(response).fadeIn();
            }
        });
            
    });
    
    $('.addFields').click(function(){      
        var tabla = $(this).attr("data-name");
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getAddFields.php",
            data: { tabla: tabla },
            success: function(response)
            {
                console.log(response);
                $('#employee-fields tbody').html(response).fadeIn();
            }
        });
    });
//    $('.checkbox-select-ejer').click(function(){
//        var id_ejer = $(this).attr("value");
//        var id_hoja = $(this).attr("id");
//        var name = $(this).closest('.del').find('td').eq(0).html();
//        var nivel = $(this).closest('.del').find('td').eq(1).html();
//        var tipo = $(this).closest('.del').find('td').eq(2).html();
//        var profe = $(this).closest('.del').find('td').eq(3).html();
//        
//        var tr = '<tr class="add ui-sortable-handle" data-index='+id_ejer+' data-index-sheet='+id_hoja+' data-position=""><td>'+name+'</td><td>'+nivel+'</td><td>'+tipo+'</td><td>'+profe+'</td><td style="text-align: center"><input class="checkbox-add-ejer" id='+id_hoja+' name="seleccionados[]" value='+id_ejer+' onclick="checkDes('+id_ejer+')" type="checkbox"></td></tr>';
//        console.log(tr);
//        var table = $('#employee_data').DataTable({
//            paging:   true,
//            destroy: true,
//            searching: true
//        });
//        table.row.add($(tr)).draw(false);
//        $(this).closest('tr').hide();
//    });
    
    $('#employee_table_hoja').DataTable({
            paging:   false,
            destroy: true,
            ordering: false,
            searching: false
        });
        
        
//    $('.checkbox-add-ejer').click(function(){
//        var id_ejer = $(this).attr("value");
//        var id_hoja = $(this).attr("id");
//        var name = $(this).closest('.add').find('td').eq(0).html();
//        var nivel = $(this).closest('.add').find('td').eq(1).html();
//        var tipo = $(this).closest('.add').find('td').eq(2).html();
//        var profe = $(this).closest('.add').find('td').eq(3).html();
//        
//        var tr = '<tr class="del ui-sortable-handle" data-index='+id_ejer+' data-index-sheet='+id_hoja+' data-position=""><td>'+name+'</td><td>'+nivel+'</td><td>'+tipo+'</td><td>'+profe+'</td><td style="text-align: center"><input class="checkbox-select-ejer" id='+id_ejer+' name="seleccionados[]" value='+id_ejer+' checked="" onclick="checkAdd('+id_ejer+')" type="checkbox"></td></tr>';
//        $(tr).click();
//        console.log(tr);
//        var table = $('#employee_table_hoja').DataTable();
//        table.row.add($(tr)).draw(false);
//        $(this).closest('tr').hide();
//    });
    
    $('.select_profe option').click(function(){
        var profe = $(this).attr("value");
        var table = $('#employee_data').DataTable();
         table.columns(1).search(profe).draw(false);
         
    });
    $('.select_nivel option').click(function(){
        var nivel = $(this).attr("value");
        var table = $('#employee_data').DataTable();
        table.columns(2).search(nivel).draw(false);
    });
    
    $('.select_tipo option').click(function(){
        var tipo = $(this).attr("value");
        var table = $('#employee_data').DataTable();
        table.columns(3).search(tipo).draw(false);
    });

    
    $('.contenedor-item').click(function(){
       var borrar = $(this).removeClass('border-left-white'); 
       console.log($(this));
    });

    $('#close-tablas').click(function(){
        $('#modal-tables').hide();
    });


});

