$(document).ready(function(){

username = $(this).find("#userPrincipal").attr("data-name");

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

});