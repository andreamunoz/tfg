$(document).ready(function(){


    username = $(this).find("#userPrincipal").attr("data-name");
    var numEjerHoja = 0;
    var ordenarCreadorHojaListar = 1;
    var ordenarNivelAgregarEjerAHoja = 1;
    var ordenarTipoAgregarEjerAHoja = 3;
    var ordenarCreadorAgregarEjerAHoja = 5;
    var editar_id_hoja = sessionStorage.getItem("editar_id_hoja");

    var dondeEstoy = sessionStorage.getItem("dondeEstoy");

    if(dondeEstoy === null){
        dondeEstoy = "";
    }


    switch(dondeEstoy){
        case "principal":
            sessionStorage.removeItem("editar_id_hoja");
            $('.principal').show();
            $('.adm-hojas').hide();
            $('.adm-ejercicios').hide();
            $('.adm-estadisticas').hide();
            $('.adm-tablas').hide();
            $('.configuracion').hide();

            var that = $(this);
            that.find('#liprin').addClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').removeClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').removeClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').removeClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "false");
            that.find('#liejer').attr("aria-expanded", "false");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').removeClass("show");
            that.find('ul#ejercicios').removeClass("show");
            that.find('ul#configurar').removeClass("show");
            
            break;

        case "adm-hojas-crear-hoja":
            
            sessionStorage.setItem("dondeEstoy", "adm-hojas-crear-hoja");
            sessionStorage.removeItem("editar_id_hoja");
            $('.principal').hide();
            $('.adm-hojas').show();
            $('.configuracion').hide();
            $('.adm-ejercicios').hide();
            $('.adm-estadisticas').hide();
            $('.adm-tablas').hide();
           
            $('.crear-hoja').show();
            $('.editar-hoja').hide();
            $('.lista-hoja').hide();
            
            var that = $(this);
            that.find('#liprin').removeClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').removeClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').addClass('active');
            that.find('#licrho').addClass('active');
            that.find('#liliho').removeClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "true");
            that.find('#liejer').attr("aria-expanded", "false");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').addClass("show");
            that.find('ul#ejercicios').removeClass("show");
            that.find('ul#configurar').removeClass("show");
            break;

        case "adm-hojas-editar-hoja":
            
            sessionStorage.setItem("dondeEstoy", "adm-hojas-editar-hoja");
            $('.principal').hide();
            $('.adm-hojas').show();
            $('.configuracion').hide();
            $('.adm-ejercicios').hide();
            $('.adm-estadisticas').hide();
            $('.adm-tablas').hide();
           
            $('.crear-hoja').hide();
            $('.editar-hoja').show();
            $('.lista-hoja').hide();
            
            var that = $(this);
            that.find('#liprin').removeClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').removeClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').addClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').addClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "true");
            that.find('#liejer').attr("aria-expanded", "false");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').addClass("show");
            that.find('ul#ejercicios').removeClass("show");
            that.find('ul#configurar').removeClass("show");

            break;

        case "adm-hojas-lista-hojas":
            sessionStorage.setItem("dondeEstoy", "adm-hojas-lista-hojas");
            sessionStorage.removeItem("editar_id_hoja");
            $('.principal').hide();
            $('.adm-hojas').show();
            $('.configuracion').hide();
            $('.adm-ejercicios').hide();
            $('.adm-estadisticas').hide();
            $('.adm-tablas').hide();
            
            $('.crear-hoja').hide();
            $('.editar-hoja').hide();
            $('.lista-hoja').show();

            var that = $(this);
            that.find('#liprin').removeClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').removeClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').addClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').addClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "true");
            that.find('#liejer').attr("aria-expanded", "false");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').addClass("show");
            that.find('ul#ejercicios').removeClass("show");
            that.find('ul#configurar').removeClass("show");
            break;
 
        case "adm-ejercicios-crear-ejercicio":
            sessionStorage.setItem("dondeEstoy", "adm-ejercicios-crear-ejercicio");
            sessionStorage.removeItem("editar_id_hoja");
            $('.principal').hide();
            $('.adm-hojas').hide();
            $('.configuracion').hide();
            $('.adm-estadisticas').hide();
            $('.adm-ejercicios').show();
            $('.adm-tablas').hide();
            
            $('.crear-ejercicio').show();
            $('.editar-ejercicio').hide();
            $('.lista-ejercicio').hide();
            
            var that = $(this);
            that.find('#liprin').removeClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').addClass('active');
            that.find('#licrej').addClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').removeClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').removeClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "false");
            that.find('#liejer').attr("aria-expanded", "true");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').removeClass("show");
            that.find('ul#ejercicios').addClass("show");
            that.find('ul#configurar').removeClass("show");
           
            break;

        case "adm-ejercicios-lista-ejercicios":
            sessionStorage.setItem("dondeEstoy", "adm-ejercicios-lista-ejercicios");
            sessionStorage.removeItem("editar_id_hoja");
            $('.principal').hide();
            $('.adm-hojas').hide();
            $('.configuracion').hide();
            $('.adm-estadisticas').hide();
            $('.adm-tablas').hide();
            $('.adm-ejercicios').show();
           
            $('.crear-ejercicio').hide();
            $('.editar-ejercicio').hide();
            $('.lista-ejercicio').show();

            var that = $(this);
            that.find('#liprin').removeClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').addClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').addClass('active');
            that.find('#lihoja').removeClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').removeClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "false");
            that.find('#liejer').attr("aria-expanded", "true");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').removeClass("show");
            that.find('ul#ejercicios').addClass("show");
            that.find('ul#configurar').removeClass("show");
            break;
                
        case "configuracion":
            sessionStorage.setItem("dondeEstoy", "configuracion");
            sessionStorage.removeItem("editar_id_hoja");
            $('.principal').hide();
            $('.configuracion').show();
            $('.adm-hojas').hide();
            $('.adm-ejercicios').hide();
            $('.adm-estadisticas').hide();
            $('.adm-tablas').hide();

            var that = $(this);
            that.find('#liprin').removeClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').removeClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').removeClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').removeClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').addClass('active');
            that.find('#liperf').addClass('active');
            that.find('#lihoja').attr("aria-expanded", "false");
            that.find('#liejer').attr("aria-expanded", "false");
            that.find('#liconf').attr("aria-expanded", "true");
            that.find('ul#hojas').removeClass("show");
            that.find('ul#ejercicios').removeClass("show");
            that.find('ul#configurar').addClass("show");
            break;

        case "adm-estadisticas":
            sessionStorage.setItem("dondeEstoy", "adm-estadisticas");
            sessionStorage.removeItem("editar_id_hoja");

            $('.principal').hide();
            $('.adm-hojas').hide();
            $('.configuracion').hide();
            $('.adm-ejercicios').hide();
            $('.adm-tablas').hide();
            $('.adm-estadisticas').show();

            var that = $(this);
            that.find('#liprin').removeClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').removeClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').removeClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').removeClass('active');
            that.find('#liesta').addClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "false");
            that.find('#liejer').attr("aria-expanded", "false");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').removeClass("show");
            that.find('ul#ejercicios').removeClass("show");
            that.find('ul#configurar').removeClass("show");
            break;

        case "adm-tablas-adjuntar-tablas":
            sessionStorage.setItem("dondeEstoy", "adm-tablas-adjuntar-tablas");
            sessionStorage.removeItem("editar_id_hoja");
            $('.principal').hide();
            $('.adm-hojas').hide();
            $('.configuracion').hide();
            $('.adm-ejercicios').hide();
            $('.adm-estadisticas').hide();
            $('.adm-tablas').show(); 

            $('.adjuntar-tablas').show();

            var that = $(this);
            that.find('#liprin').removeClass('active');
            that.find('#litabl').addClass('active');
            that.find('#liejer').removeClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').removeClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').removeClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "false");
            that.find('#liejer').attr("aria-expanded", "false");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').removeClass("show");
            that.find('ul#ejercicios').removeClass("show");
            that.find('ul#configurar').removeClass("show");
            break;

        default:  
            sessionStorage.removeItem("editar_id_hoja");
            $('.principal').show();
            $('.adm-hojas').hide();
            $('.adm-ejercicios').hide();
            $('.adm-estadisticas').hide();
            $('.adm-tablas').hide();
            $('.configuracion').hide();

            var that = $(this);
            that.find('#liprin').addClass('active');
            that.find('#litabl').removeClass('active');
            that.find('#liejer').removeClass('active');
            that.find('#licrej').removeClass('active');
            that.find('#liliej').removeClass('active');
            that.find('#lihoja').removeClass('active');
            that.find('#licrho').removeClass('active');
            that.find('#liliho').removeClass('active');
            that.find('#liesta').removeClass('active');
            that.find('#liconf').removeClass('active');
            that.find('#liperf').removeClass('active');
            that.find('#lihoja').attr("aria-expanded", "false");
            that.find('#liejer').attr("aria-expanded", "false");
            that.find('#liconf').attr("aria-expanded", "false");
            that.find('ul#hojas').removeClass("show");
            that.find('ul#ejercicios').removeClass("show");
            that.find('ul#configurar').removeClass("show");
            break;
    }

    

    $("#principal").click(function(){
        
        sessionStorage.setItem("dondeEstoy", "principal");
        sessionStorage.removeItem("editar_id_hoja");
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
        
        sessionStorage.setItem("dondeEstoy", "adm-hojas-crear-hoja");
        sessionStorage.removeItem("editar_id_hoja");
        $('.principal').hide();
        $('.adm-hojas').show();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
       
        $('.crear-hoja').show();
        $('.editar-hoja').hide();
        $('.lista-hoja').hide();
        
        var that = $(this);
        console.log(that);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });

    $("#lista_hoja").click(function(){
        sessionStorage.setItem("dondeEstoy", "adm-hojas-lista-hojas");
        sessionStorage.removeItem("editar_id_hoja");
        $('.principal').hide();
        $('.adm-hojas').show();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        
        $('.crear-hoja').hide();
        $('.editar-hoja').hide();
        $('.lista-hoja').show();
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });

	/*--------------Ejercicios----------------*/

    $("#crear_ejercicio").click(function(){
        
        sessionStorage.setItem("dondeEstoy", "adm-ejercicios-crear-ejercicio");
        sessionStorage.removeItem("editar_id_hoja");
        $('.principal').hide();
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-estadisticas').hide();
        $('.adm-ejercicios').show();
        $('.adm-tablas').hide();
        
        $('.crear-ejercicio').show();
        $('.editar-ejercicio').hide();
        $('.lista-ejercicio').hide();
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
    
    $("#lista_ejercicio").click(function(){

        sessionStorage.setItem("dondeEstoy", "adm-ejercicios-lista-ejercicios");
        sessionStorage.removeItem("editar_id_hoja");

        $('.principal').hide();
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        $('.adm-ejercicios').show();
       
        $('.crear-ejercicio').hide();
        $('.editar-ejercicio').hide();
        $('.lista-ejercicio').show();
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
        // $( "#agregarEjerAHoja" ).trigger( "click" );
    });
  
  
    $("#perfil").click(function(){
        
        sessionStorage.setItem("dondeEstoy", "configuracion");
        sessionStorage.removeItem("editar_id_hoja");
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
        sessionStorage.setItem("dondeEstoy", "adm-estadisticas");
        sessionStorage.removeItem("editar_id_hoja");

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
        that.find('ul#hojas').removeClass("show");
        that.find('ul#ejercicios').removeClass("show");
        that.find('ul#configurar').removeClass("show");
    });

    /*---------------Tablas-------------------*/
    $("#adjuntar_tabla").click(function(){
        sessionStorage.setItem("dondeEstoy", "adm-tablas-adjuntar-tablas");
        sessionStorage.removeItem("editar_id_hoja");
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




    /***BUSQUEDA AVANZADA*****/

    $('.busqueda_avanzada').hide();

    $('.filtrar').click(function(){
        
        $('.busqueda_avanzada').show();
    });

    $("#cerrar").click(function(){
       
        $('.busqueda_avanzada').toggle("slow");
    });
 

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

    var editar_id_hoja = sessionStorage.getItem("editar_id_hoja");
    var lugar = sessionStorage.getItem("dondeEstoy");
    if(lugar === "adm-hojas-editar-hoja" && editar_id_hoja !== null ){

       $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getEditarHojaEjercicio.php",
            data: { id: editar_id_hoja },
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
                        $("#editarHojaEjercicio").show();
                        $("#listarHojaEjercicios").hide();

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
        // sessionStorage.removeItem("editar_id_hoja");
    }

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

    $('.boton_borrar_ejercicio').click(function(){      
        var mi_id = $(this).attr("data-number");

        var r = confirm("¿Estás seguro de querer borrar el ejercicio?");
        if (r == true){
            $.ajax({
                method: "POST",
                url: "../templates/adm_profesor/getBorrarEjercicio.php",
                data: { id: mi_id },
                success: function(response)
                {
                    // *********************
                    location.reload();
                    // *********************
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
       if ($('input[type=checkbox]:checked').length > 10) {
            $(this).prop('checked', false);
            alert("Máximo 10 ejercicios");
       }
    });

    $('input[id=checkbox-editar-hoja] ').change(function(e){
        
       if (($('input[type=checkbox]:checked').length + numEjerHoja) > 10) {
            $(this).prop('checked', false);
            alert("Máximo 10 ejercicios");
       }
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
                    $("#modalVerEejercicio").modal('show');
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
        });
    });

    $(this).on("click", "#rowVerEjerAgregar", function(){
        var mi_id = $(this).attr("data-number");
        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getVerEjercicio.php",
            data: { id: mi_id },
            success: function(response){
                var resultado = response.substring(23);
                var res = JSON.parse(resultado);

                if(response !== null){
                    $("#modalAgregarEjerAHoja").modal('hide');
                    $("#modalVerEejercicioAgregar").modal('show');
                    //$("#verANombre").text("Ejercicio "+res.nombre);
                    $("#verADueno").text(res.dueno);
                    $("#verATablas").text(res.tablas);
                    $("#verACategoria").text(res.categoria);
                    $("#verANivel").text(res.nivel);
                    if(res.deshabilitar === "0"){
                        $("#verADeshabilitar").text("Habilitado");
                    }else{
                        $("#verADeshabilitar").text("Deshabilitado");
                    }
                    $("#verADescripcion").text(res.descripcion);
                    $("#verAEnunciado").text(res.enunciado);
                    $("#verASolucion").text(res.solucion);
                }
            }
        });
    });


    $(this).on("click", "#volverAlModal", function(){
         // $("#modalAgregarEjerAHoja").modal('show');
         $( "#agregarEjerAHoja" ).trigger( "click" );
     });
    
    $(this).on("click", "#rowEditarEjer", function(){
        var mi_id = $(this).attr("data-number");
        // console.log(mi_id);
        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getEditarEjercicio.php",
            data: { id: mi_id },
            success: function(response){
                var resultado = response.substring(23);
                var res = JSON.parse(resultado);

                if(response !== null){
                    $("#editarEjercicio").show();
                    $("#listarEjercicios").hide();
                    
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

    $(this).on("click", "#rowEditarHoja", function(){
        sessionStorage.setItem("dondeEstoy", "adm-hojas-editar-hoja");
        
        var mi_id = $(this).attr("data-number");
        sessionStorage.setItem("editar_id_hoja",mi_id);
        
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
                        $("#editarHojaEjercicio").show();
                        $("#listarHojaEjercicios").hide();

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
    });

    $('#borrarEjerDeHoja').click(function(){
        sessionStorage.setItem("dondeEstoy", "adm-hojas-editar-hoja");
        var hoja = sessionStorage.getItem("editar_id_hoja");
        var selected = [];
        var i=0;
        $('#tabla_editar_hoja_ejercicios input[type=checkbox]').each(function(){
            if(this.checked){
                selected[i] = $(this).val();
                i++;
            }
        });
                    console.log(selected.length);
        if(selected.length != 0){
            $.ajax({
                method: "GET",
                url: "../templates/adm_profesor/getBorrarEjerdeHojaEjercicio.php",
                data: { seleccionado: selected, id_hoja: hoja },
                success: function(response){

                    var resultado = response.substring(23);
                    var res = JSON.parse(resultado);
                    console.log(response);
                    if(response !== null){
                        $("#editarHojaEjercicio").show();
                        $("#listarHojaEjercicios").hide();

                        $("#editaHojaId").val(res[0]["id_hoja"]);
                        $("#editaHojaNombre").val(res[0]["nombre_hoja"]);
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
                        
                    }
                }
            });
        }
    });

    $('#agregarEjerAHoja').click(function(){
        sessionStorage.setItem("dondeEstoy", "adm-hojas-editar-hoja");
        $("input[id=checkbox-editar-hoja]").prop('checked', false);
        $("#modalAgregarEjerAHoja").modal('show');
    });

    $('#cancelar-editar-hoja').click(function(){
        sessionStorage.setItem("dondeEstoy", "adm-hojas-lista-hojas");
        location.reload();
    });

    $(this).on("click", "#rowInfoHoja", function(){
        var mi_id = $(this).attr("data-number");
        console.log(mi_id);
        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getEditarHojaEjercicio.php",
            data: { id: mi_id },
            success: function(response){
                console.log(response);
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
                        $("#modalInfoHoja").modal('show');
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
                        $("#modalInfoHoja").modal('show');
                        $("#infoHojaId").val(id_hoja);
                        $("#infoHojaNombre").val(nombre_hoja);
                        $("#tabla_info_hoja_ejercicios > tbody").empty();
                    }
                }
            }
        });
    });

    $(this).on("click", "#rowVerEjerInfo", function(){
        var mi_id = $(this).attr("data-number");

        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getVerEjercicio.php",
            data: { id: mi_id },
            success: function(response){
                var resultado = response.substring(23);
                var res = JSON.parse(resultado);
                console.log(res);
                if(response !== null){
                    $("#modalInfoHoja").modal('hide');
                    $("#modalVerEjercicioInfo").modal('show');

                    $("#verIDueno").text(res.dueno);
                    $("#verITablas").text(res.tablas);
                    $("#verICategoria").text(res.categoria);
                    $("#verINivel").text(res.nivel);
                    if(res.deshabilitar === "0"){
                        $("#verIDeshabilitar").text("Habilitado");
                    }else{
                        $("#verIDeshabilitar").text("Deshabilitado");
                    }
                    $("#verIDescripcion").text(res.descripcion);
                    $("#verIEnunciado").text(res.enunciado);
                    $("#verISolucion").text(res.solucion);
                }
            }
        });
    });

    $(this).on("click", "#volverAlModalI", function(){
        $("#modalInfoHoja").modal('show');
        // $( "#rowInfoHoja" ).trigger( "click" );
     });

    $(this).on("click", "#rowBorrarHoja", function(){
        var mi_id = $(this).attr("data-number");

        var r = confirm("Vas a eliminar la hoja.¿Estás seguro?");
        if (r == true){
            $.ajax({
                method: "POST",
                url: "../templates/adm_profesor/getBorrarHoja.php",
                data: { id: mi_id },
                success: function(response)
                {
                    // *********************
                    location.reload();
                    // *********************
                }
            });
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

    $(".nombreProfListar").click(function(){
        //console.log(ordenarCreadorHojaListar);
        if (ordenarCreadorHojaListar === 1){
            ordenarCreadorHojaListar = 2;
        } else{
            ordenarCreadorHojaListar = 1;
        }
        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getListarHojas.php",
            data: { orden: ordenarCreadorHojaListar },
            success: function(response){
                var resultado = response.substring(23);
                if(response !== null){

                    $("#table-listar-hojas > tbody").empty();
                    $("#table-listar-hojas > tbody").append(resultado);

                }
            }
        });
    });

    $(".nivelAgregarEjer").click(function(){
        if(ordenarNivelAgregarEjerAHoja === 1){
            ordenarNivelAgregarEjerAHoja = 2;
        }else{
            ordenarNivelAgregarEjerAHoja = 1;
        }
        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getEjerciciosParaAgregar.php",
            data: { orden: ordenarNivelAgregarEjerAHoja },
            success: function(response){
                
                var resultado = response.substring(23);
                if(response !== null){

                    $("#tabla_agregar_ejer_hoja_ejercicios > tbody").empty();
                    $("#tabla_agregar_ejer_hoja_ejercicios > tbody").append(resultado);

                }
            }
        });
    });

    $(".tipoAgregarEjer").click(function(){
        if(ordenarTipoAgregarEjerAHoja === 3){
            ordenarTipoAgregarEjerAHoja = 4;
        }else{
            ordenarTipoAgregarEjerAHoja = 3;
        }
        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getEjerciciosParaAgregar.php",
            data: { orden: ordenarTipoAgregarEjerAHoja },
            success: function(response){
                var resultado = response.substring(23);
                console.log(resultado);
                if(response !== null){

                    $("#tabla_agregar_ejer_hoja_ejercicios > tbody").empty();
                    $("#tabla_agregar_ejer_hoja_ejercicios > tbody").append(resultado);

                }
            }
        });
    });

    $(".creadorAgregarEjer").click(function(){
        if(ordenarCreadorAgregarEjerAHoja === 5){
            ordenarCreadorAgregarEjerAHoja = 6;
        }else{
            ordenarCreadorAgregarEjerAHoja = 5;
        }
        $.ajax({
            method: "GET",
            url: "../templates/adm_profesor/getEjerciciosParaAgregar.php",
            data: { orden: ordenarCreadorAgregarEjerAHoja },
            success: function(response){
                var resultado = response.substring(23);
                if(response !== null){

                    $("#tabla_agregar_ejer_hoja_ejercicios > tbody").empty();
                    $("#tabla_agregar_ejer_hoja_ejercicios > tbody").append(resultado);

                }
            }
        });
    });
    
    /** SELECT USER DE GESTION DE EJERCICIOS **/
    $.ajax({
        type: "POST",
        url: "../templates/adm_profesor/getUser.php",
        success: function(response)
        {
            $(".selector-user-gestion select").html(response).fadeIn();
        }
    });

    $(".selector-user-gestion select").change(function() {
        var form_data = {
                is_ajax: 1,
                dueno: $(".selector-user-gestion select option:checked").val(),
                cambio: true
        };
        $.ajax({
                type: "POST",
                url: "../templates/adm_profesor/getGestionarEjerciciosProfesor.php",
                data: form_data,
                success: function(response)
                {   
                    //$('.selector-tabla select').html(response).fadeIn();
                }
        });
    });
    /** FIN SELECT USER DE GESTION DE EJERCICIOS **/


    
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
        console.log("ESTOY EN MARCAR TODOS LEIDOS");
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


/*** ESTADISTICAS ***/
    //Rellenar el select con sus valores

    $("#headingOne").click(function(){
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getSelectEstadisticas.php",
            data: { caso: 1 },
            success: function(response)
            {
                location.reload();
            }
        });
    }); 

    $("#headingTwo").click(function(){
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getSelectEstadisticas.php",
            data: { caso: 2 },
            success: function(response)
            {
                location.reload();
            }
        });
    });

    $("#headingThree").click(function(){
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getSelectEstadisticas.php",
            data: { caso: 3 },
            success: function(response)
            {
                location.reload();
            }
        });
    });

    $("#headingFour").click(function(){
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getSelectEstadisticas.php",
            data: { caso: 4 },
            success: function(response)
            {
                location.reload();
            }
        });
    });

    $("#headingFive").click(function(){
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getSelectEstadisticas.php",
            data: { caso: 5 },
            success: function(response)
            {
                location.reload();
            }
        });
    });


});