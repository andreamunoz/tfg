$(document).ready(function()
{
  /*--------------Hoja de Ejercicios----------------*/

    $('.principal').show();
    $('.adm-hojas').hide();
    $('.adm-ejercicios').hide();
    $('.adm-estadisticas').hide();
    $('.adm-tablas').hide();
    $('.configuracion').hide();

    $("#principal").click(function(){
        
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        $('.principal').show();
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
        
    });

    $("#crear_hoja").click(function(){
        
        $('.principal').hide();
        $('.adm-hojas').show();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
       
        $('.crear-hoja').show("slow");
        $('.editar-hoja').hide();
        $('.lista-hoja').hide();
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
    // $("#editar_hoja").click(function(){
        
    //     $('.principal').hide();
    //     $('.adm-hojas').show();
    //     $('.configuracion').hide();
    //     $('.adm-ejercicios').hide();
    //     $('.adm-estadisticas').hide();
    //     $('.adm-tablas').hide();
                  
    //     $('.crear-hoja').hide("linear");
    //     $('.editar-hoja').show();
    //     $('.lista-hoja').hide("linear");
        
    //     var that = $(this);
    //     that.closest('.sub-menu').find('li.active').removeClass('active');
    //     that.parent().addClass('active');
    // });
    $("#lista_hoja").click(function(){
       
        $('.principal').hide();
        $('.adm-hojas').show();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        
        $('.crear-hoja').hide("linear");
        $('.editar-hoja').hide();
        $('.lista-hoja').show("swing");
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });

	/*--------------Ejercicios----------------*/

    $("#crear_ejercicio").click(function(){
        
        $('.principal').hide();
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-estadisticas').hide();
        $('.adm-ejercicios').show();
        $('.adm-tablas').hide();
        
        $('.crear-ejercicio').show("slow");
        $('.editar-ejercicio').hide();
        $('.lista-ejercicio').hide();
        
        var that = $(this);
        console.log(that);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
    // $("#editar_ejercicio").click(function(){
        
    //     $('.principal').hide();
    //     $('.adm-hojas').hide();
    //     $('.configuracion').hide();
    //     $('.adm-estadisticas').hide();
    //     $('.adm-ejercicios').show();
    //     $('.adm-tablas').hide();
                 
    //     $('.crear-ejercicio').hide("linear");
    //     $('.editar-ejercicio').show();
    //     $('.lista-ejercicio').hide("linear");
        
    //     var that = $(this);
    //     that.closest('.sub-menu').find('li.active').removeClass('active');
    //     that.parent().addClass('active');
    // });
    $("#lista_ejercicio").click(function(){
        
        $('.principal').hide();
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        $('.adm-ejercicios').show();
       
        $('.crear-ejercicio').hide("linear");
        $('.editar-ejercicio').hide();
        $('.lista-ejercicio').show("swing");
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
  
  
/*--------------Configuracion-----------------*/
  $("#perfil").click(function(){
        
        $('.principal').hide();
        $('.configuracion').show();
        $('.adm-hojas').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
  });

  /*---------------Estadisticas-------------------*/
  $("#estadistic").click(function(){
        
        $('.principal').hide();
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-tablas').hide();
        $('.adm-estadisticas').show();

        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
  });

  /*---------------Tablas-------------------*/
  $("#adjuntar_tabla").click(function(){
        
        $('.principal').hide();
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').show(); 

        $('.adjuntar-tablas').show();

        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
  });

});



$(document).ready(function()
{
    

   /* $("#configurar").click(function(){
        
        var that = $(this);
        that.closest('.menu-content').find('li.active').removeClass('active');
        that.closest('.menu-content').find('ul').removeClass('show');    
        that.parent().addClass('active');
    });
    $("#noticias").click(function(){
       
        var that = $(this);
        that.closest('.menu-content').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });*/

});  

$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});



/***BUSQUEDA AVANZADA*****/
/***********************************/

$(document).ready(function()
{
    $('.busqueda_avanzada').hide();

    $('.filtrar').click(function(){
        
        $('.busqueda_avanzada').show();
    });
    $("#cerrar").click(function(){
       
        $('.busqueda_avanzada').toggle("slow");
    });

});  

$(document).ready(function(){
    $('.boton_editar_ejercicio').click(function(){      
        var mi_id = $(this).attr("data-number");
        
        $.ajax({
            
            method: "POST",
            url: "../templates/adm_profesor/getEditarEjercicio.php",
            data: { id: mi_id },
            success: function(response)
            {   
                location.href = "../templates/adm_profesor/adm_editar_ejercicio.php";
            }            
        });     
    });

    $('.boton_borrar_ejercicio').click(function(){      
        var mi_id = $(this).attr("data-number");

        var r = confirm("Vas a eliminar el ejercicio "+mi_id+".¿Estás seguro?");
        if (r == true){
            $.ajax({
                method: "POST",
                url: "../templates/adm_profesor/getBorrarEjercicio.php",
                data: { id: mi_id },
                success: function(response)
                {
                    location.reload();
                }
            });
        }        
    });

    $('.boton_deshabilitar_ejercicio').click(function(){      
        var mi_id = $(this).attr("data-number");

        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getDeshabilitarEjercicio.php",
            data: { id: mi_id },
            success: function(response)
            {
                location.reload();
            }
        });
               
    });

    $('.boton_habilitar_ejercicio').click(function(){      
        var mi_id = $(this).attr("data-number");

        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getHabilitarEjercicio.php",
            data: { id: mi_id },
            success: function(response)
            {
                location.reload();
            }
        });      
    });

    $('input[id=checkbox-crear-hoja] ').change(function(e){
       if ($('input[type=checkbox]:checked').length > 2) {
            $(this).prop('checked', false);
            console.log($(this));
            alert("Máximo 10 ejercicios");
       }
    });

    $('.boton_editar_hojaejercicio').click(function(){      
        var mi_id = $(this).attr("data-number");
        
        $.ajax({
            
            method: "POST",
            url: "../templates/adm_profesor/getEditarHojaEjercicio.php",
            data: { id: mi_id },
            success: function(response)
            {   
                location.href = "../templates/adm_profesor/adm_editar_hojaejercicio.php";
            }            
        });     
    });

    $(this).on("click", "#rowVer", function(){
        var mi_id = $(this).attr("data-number");
        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getVerEjercicio.php",
            data: { id: mi_id },
            success: function(response){
                var resultado = response.substring(23);
                var res = JSON.parse(resultado);

                if(response !== null){
                    $("#modalVerEejercicio").modal();
                    $("#verNombre").text("Ejercicio "+res.nombre);
                    $("#verDueno").text(res.dueno);
                    $("#verTablas").text(res.tablas);
                    $("#verCategoria").text(res.categoria);
                    $("#verNivel").text(res.nivel);
                    if(res.deshabilitar === "0"){
                        $("#verDeshabilitar").text("Habilitado");
                    }else{
                        $("#verDeshabilitar").text("Deshabilitado");
                    }
                    $("#verDescripcion").text(res.descripcion);
                    $("#verEnunciado").text(res.enunciado);
                    $("#verSolucion").text(res.solucion);
                }
            }
        })
    });

});