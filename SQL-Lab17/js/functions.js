
$(document).ready(function () {

    username = $(this).find("#userPrincipal").attr("data-name");

    setTimeout(function () {
        $('#modalwindow').hide();
    }, 10000);

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


});

