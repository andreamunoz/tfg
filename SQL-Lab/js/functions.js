$(document).ready(function(){


    username = $(this).find("#userPrincipal").attr("data-name");
    var numEjerHoja = 0;
    var ordenarCreadorHojaListar = 1;
    var ordenarNivelAgregarEjerAHoja = 1;
    var ordenarTipoAgregarEjerAHoja = 3;
    var ordenarCreadorAgregarEjerAHoja = 5;
//    var editar_id_hoja = sessionStorage.getItem("editar_id_hoja");

   

    $("#principal").click(function(){
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
        
    });

    $("#crear_hoja").click(function(){
        
        var that = $(this);
        console.log(that);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });

    $("#lista_hoja").click(function(){
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });

	/*--------------Ejercicios----------------*/

    $("#crear_ejercicio").click(function(){
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
    
    $("#lista_ejercicio").click(function(){
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
        // $( "#agregarEjerAHoja" ).trigger( "click" );
    });
  
  
    $("#perfil").click(function(){
        
        var that = $(this);
        that.closest('#menu-content').find('li.active').removeClass('active');
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });

    /*---------------Estadisticas-------------------*/
    $("#estadistic").click(function(){

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

                    $("#modalVerEejercicioAgregar").modal('show');
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

    $('#borrarEjerDeHoja').click(function(){

        var hoja = $(this).attr("data-number");
        var selected = [];
        var i=0;
        $('#tabla_editar_hoja_ejercicios input[type=checkbox]').each(function(){
            if(this.checked){
                selected[i] = $(this).val();
                i++;
            }
        });
                    //console.log(selected.length);
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
        // sessionStorage.setItem("dondeEstoy", "adm-hojas-editar-hoja");
        $("input[id=checkbox-editar-hoja]").prop('checked', false);
        //$("#modalAgregarEjerAHoja").modal('show');
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