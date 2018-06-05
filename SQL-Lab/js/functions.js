$(document).ready(function(){


    username = $(this).find("#userPrincipal").attr("data-name");

    var dondeEstoy = sessionStorage.getItem("dondeEstoy");

    if(dondeEstoy === null){
        dondeEstoy = "";
    }


    switch(dondeEstoy){
        case "principal":

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

        case "adm-hojas-lista-hojas":
            sessionStorage.setItem("dondeEstoy", "adm-hojas-lista-hojas");
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
    });
  
  
    $("#perfil").click(function(){
        
        sessionStorage.setItem("dondeEstoy", "configuracion");

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

 


    // $('.boton_editar_ejercicio').click(function(){      
    //     var mi_id = $(this).attr("data-number");
        
    //     $.ajax({
            
    //         method: "POST",
    //         url: "../templates/adm_profesor/getEditarEjercicio.php",
    //         data: { id: mi_id },
    //         success: function(response)
    //         {   
    //             location.href = "../templates/adm_profesor/adm_editar_ejercicio.php";
    //         }            
    //     });     
    // });


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
                dueno: $(".selector-user select option:checked").val()
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

        var r = confirm("Vas a eliminar el ejercicio "+mi_id+".¿Estás seguro?");
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
            console.log($(this));
            alert("Máximo 10 ejercicios");
       }
    });

    $('.boton_editar_hojaejercicio').click(function(){ /**NOOOOOOOOOO**/     
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

});