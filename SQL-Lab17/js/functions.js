
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

    /*Nueva forma mostrar columnas en crear ejercicio: */
    $(".selector-tabla select").change(function() {
        var form_data = {
            is_ajax: 1,
            tabla: $(".selector-tabla select option:checked").val()
        };
         if (form_data.tabla !== ""){
            $('#structure_table thead').html('<tr> <th style="width:30%;">Nombre Columna</th><th style="width:30%;">Tipo Columna</th><th style="width:20%;">Clave</th></tr>');

            $.ajax({
                type: "POST",
                url: "adm_profesor/getStructure.php",
                data: form_data,
                success: function(response)
                {   
                    $('#structure_table tbody').html(response).fadeIn();
                }
            });
        }else{
            $('.structure-table tbody').html("").fadeIn();
        }
    });

    $(".selector-tabla-show select").click(function() {
        var form_data = {
            is_ajax: 1,
            tabla: $(".selector-tabla-show select option:checked").val()
        };
        $.ajax({
            type: "POST",
            url: "adm_profesor/getColumns.php",
            data: form_data,
            success: function(response)
            {   
                $('.columnas-tabla-show #columnas tbody').html(response).fadeIn();
            }
        });
    });

    $(".selector-tabla-sol select ").change(function(){
        
        var form_data = {
            is_ajax: 1,
            tabla: $(".selector-tabla-sol select option:checked").val()
        };
        //console.log(form_data.tabla);
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
    
    $(".tabla-tablas tr").click(function() { 
        var selected = $(this).hasClass("highlight"); 
        $(".tabla-tablas tr").removeClass("highlight"); 
        if(!selected) $(this).addClass("highlight"); 
    }); 
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
        $('tr').removeClass("gradient");
        $(this).closest('tr').addClass("gradient");
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
    
    $('#employee_table_hoja').DataTable({
            paging:   false,
            destroy: true,
            ordering: false,
            searching: false
        });
           
    $('.checkbox-select-ejer').click(function(){
        var id_ejer = $(this).attr("value");
        var id_hoja = $(this).closest('.del').attr("data-index-sheet");
        var name = $(this).closest('.del').find('td').eq(0).html();
        var nivel = $(this).closest('.del').find('td').eq(1).html();
        var tipo = $(this).closest('.del').find('td').eq(2).html();
        var profe = $(this).closest('.del').find('td').eq(3).html();
        
        var tr = '<tr class="add" data-index='+id_ejer+' data-index-sheet='+id_hoja+' data-position=""><td>'+name+'</td><td>'+nivel+'</td><td>'+tipo+'</td><td>'+profe+'</td><td style="text-align: center"><input class="checkbox-add-ejer" type="checkbox" id='+id_ejer+' name="seleccionados[]" value='+id_ejer+' ></td></tr>';
        $(tr).click();
        console.log(tr);
        var table = $('#employee_data').DataTable();
        table.row.add($(tr)).draw(false);
        $(this).closest('tr').hide();
    });
    
    $('.select_profe option').click(function(){
        var name = $(this).attr("name");
        var apellido1 = $(this).attr("apellido1");
        var apellido2 = $(this).attr("apellido2");
        var profe = name + " " + apellido1 + " " + apellido2;
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

    $('.contenedor-item').on('click',function(){
        $('.contenedor-item').removeClass('border-left-white');
    });

    $('#close-modal').click(function(){
        $('#modal-close').hide();
    });

    $('#new_exercice').click(function(){
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getBorrarDatosCrearEjercicio.php",
            success: function(response)
            {
                location.assign("../templates/configuration_new_exercises.php");
            }
        });
    });

    $('#new_table').click(function(){
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getBorrarDatosCrearTablas.php",
            success: function(response)
            {
                location.assign("../templates/configuration_new_tables.php");
            }
        });
    });

    $('#logout').click(function(){
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getBorrarDatosSesion.php",
            success: function(response)
            {
                location.assign("../templates/login/login.php");
            }
        });
    });    

});

function cargar(){
    $('.contenedor-item').removeClass('border-left-white');
    var array = window.location.href.split('/');
    $('.menu-item').each(function( index ) {
        if($(this).attr('href') == array[array.length-1]){
            $(this).children('.contenedor-item').addClass('border-left-white');
        }
    });
}

$( window ).on( "load", function() {    
    cargar();
});

