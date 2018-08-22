
$(document).ready(function(){
    
    username = $(this).find("#userPrincipal").attr("data-name");
    
    setTimeout(function(){
        $('#modalwindow').hide();
    },10000);
    
    setTimeout(function(){
        $('#modalsolucion').hide();
    },5000);
    
    setTimeout(function(){
        $('#modalsheet').hide();
    },5000);
    
    /*Mostrar los nombres de los profesores que tengan creadas tablas*/
    $.ajax({
        type: "POST",
        url: "../templates/adm_profesor/getUser.php",
        success: function(response)
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
        success: function(response)
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

});

