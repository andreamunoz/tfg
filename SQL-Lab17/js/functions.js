
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
        dueno: username,
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
            tabla: $(".selector-tabla select option:checked").val(),
            name: $(".selector-tabla select option:checked").text()
        };
//        console.log(form_data.tabla);
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
            url: "../templates/adm_profesor/getStructure.php",
            data: { tabla: tabla },
            success: function(response)
            {
                var resultado = response.substring(23);
                $('#structure_table tbody').html(resultado).fadeIn();
            }
        });
    });

    $('.addFieldsResol').click(function(){      
        var tabla = $(this).attr("data-name");
        $('tr').removeClass("gradient");
        $(this).closest('tr').addClass("gradient");
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/getStructure.php",
            data: { tabla: tabla },
            success: function(response)
            {
                $('#structure_table thead').html('<tr> <th style="width:30%;">Nombre Columna</th><th style="width:30%;">Tipo Columna</th><th style="width:20%;">Clave</th></tr>');
                var resultado = response.substring(23);
                $('#structure_table tbody').html(resultado).fadeIn();
            }
        });
    });
    
    $('.createSheet').click(function(){
        var table = $('#employee_table_hoja').DataTable();
        var i=0;
        var seleccionados = [];
        $('#employee_table_hoja').find('tr').each(function(){
            if($(this).find('td').eq(5).text()!=""){
                seleccionados[i] = $(this).find('td').eq(5).text();
                i++;
            }
        });
         var name = $('#new_name_sheet').val();
         if(name != ""){  
            if(seleccionados.length != 0){
                $.ajax({
                    method: "POST",
                    url: "../templates/adm_profesor/getAñadirHoja.php",
                    data: {name: name, seleccionados: seleccionados},
                    success: function(seleccionados)
                    {
                       location.assign("../templates/configuration_sheets.php");
                    }
                });
            }else{
            $('.modalName').css("display","block");
        }   
        }else{
            $('.modalName').css("display","block");
        }
    });

    $('.updateSheet').click(function(){
    
        var table = $('#employee_table_hoja').DataTable();
        var i=0;
        var seleccionados = [];
        var hoja = $(this).attr('name');
        $('#employee_table_hoja').find('tr').each(function(){
            if($(this).find('td').eq(5).text()!=""){
                seleccionados[i] = $(this).find('td').eq(5).text();
                i++;
            }
        });
         var name = $('#edit_name_sheet').val();
         if(name != ""){  
            if(seleccionados.length != 0){
                $.ajax({
                    method: "POST",
                    url: "../templates/adm_profesor/getEditarHoja.php",
                    data: {hoja: hoja, name: name, seleccionados: seleccionados},
                    success: function(seleccionados)
                    {
                       location.assign("../templates/configuration_sheets.php");
                    }
                });
            }else{
            $('.modalName').css("display","block");
        }   
        }else{
            $('.modalName').css("display","block");
        }
    });
    
    $('#employee_data tbody').on( 'click', 'i', function () {
        
//        var table = $('#employee_table_hoja').DataTable(); 
        var tablaPrueba = $('#employee_prueba').DataTable();
        var longitud = $('#employee_table_hoja').find('tr').length - 1;
        var i=0; var id_hoja; var id=-1; var positions=[];
        var table = $('#employee_data').DataTable();
	var table2 = $('#employee_table_hoja').DataTable();
        var tr2 = $(this).closest("tr"); 
        var pos=0; var arrayTr = [];
        
        $('#employee_table_hoja i').each(function(){
            
            var tr = $(this).closest("tr");
            arrayTr[pos] = tr;
            tablaPrueba.row.add(tr);
            pos++;
        });
        
        for(var i=0; i < pos; i++){
            table2.row(i).data( tablaPrueba.row(arrayTr[i]).data());
        }
        table.row( tr2 ).data()[4] = "<i class='fas fa-trash mr-3' style='color:black; opacity:0.9;' title='Eliminar'></i>";
        table2.row.add( table.row( tr2 ).data() ).draw();
	table.row(tr2).remove().draw( false );

    } );
    
    $('#employee_table_hoja tbody').on( 'click', 'i', function () {
        var table = $('#employee_data').DataTable();
        var table2 = $('#employee_table_hoja').DataTable();
        var tablaPrueba = $('#employee_prueba').DataTable();
        
        var pos = $('#employee_table_hoja').find('tr').length - 1;
        var index = $(this).parents('tr').index();
        var tr2 = $(this).parents('tr');
        tr2.find("td i").addClass('fa-plus-circle');
        tr2.find("td i").removeClass('fa-trash');
        tr2.find("td i").attr('title','Añadir');

        table.row.add(tr2).draw();
        table2.row(index).remove().draw();
        
    });
    
    $('#employee_table_hoja').DataTable({
            paging:   false,
            lengthChange: false,
            responsive: true,
            destroy: false,
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
//        console.log(tr);
        var table = $('#employee_data').DataTable();
        table.row.add($(tr)).draw(false);
        $(this).closest('tr').hide();
    });
    
    $('.select_profe option').click(function(){
        var name = $(this).attr("name");
        var apellido1 = $(this).attr("apellido1");
        var apellido2 = $(this).attr("apellido2");
        var profe = name + ' ' + apellido1 + ' ' + apellido2;
        var table = $('#employee_data').DataTable();
        table.columns(1).search(profe).draw(false);
    });
    
    $('.select_profesor option').click(function(){
        var name = $(this).attr("value");
        var profe = name.replace(/-/g,' ');
        var table = $('#employee_data').DataTable();
        table.columns(1).search(profe).draw(false);
        var sitio = $(this).closest('.select_profesor').attr("name");
//        alert(sitio);
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/select/getSelectProfesor.php",
            data: {name:name, sitio:sitio},
            success: function(response)
            {

            }
        });
        
    });

    $('.select_nivel option').click(function(){
        
        var nivel = $(this).attr("value");
        var table = $('#employee_data').DataTable();
        table.columns(2).search(nivel).draw(false);
        var sitio = $(this).closest('.select_nivel').attr("name");
//        alert(sitio);
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/select/getSelectNivel.php",
            data: {nivel:nivel, sitio:sitio},
            success: function(response)
            {
                
            }
        });
    });
    
    $('.select_tipo option').click(function(){
        var tipo = $(this).attr("value");
        var table = $('#employee_data').DataTable();
        table.columns(3).search(tipo).draw(false);
        var sitio = $(this).closest('.select_tipo').attr("name");
//        alert(sitio);
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/select/getSelectTipo.php",
            data: {tipo:tipo, sitio:sitio},
            success: function(response)
            {
                //location.assign("../templates/configuration_new_exercises.php");
            }
        });
    });
    //Pulsa la cabecera para guardarla en sesión
    $('#employee_data th').on('click', function(){
        var nameCabecera = $(this).text();
        var ordenCabecera = $(this).attr('class').substr(8,11);
        var sitio = $(this).closest("table").attr('name');
//        alert(sitio);
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/select/getCabecera.php",
            data: {nameCabecera:nameCabecera, ordenCabecera:ordenCabecera, sitio:sitio},
            success: function(response)
            {
                //location.assign("../templates/configuration_new_exercises.php");
            }
        });
    });

    $('.dataTables_length select').on('change',function(){
        
        var showNumber = $(this).val();
        var sitio = $('#select_cab').attr('name');
        $.ajax({
            method: "POST",
            url: "../templates/adm_profesor/select/getShowNumber.php",
            data: {showNumber:showNumber, sitio:sitio},
            success: function(response)
            {
                //location.assign("../templates/configuration_new_exercises.php");
            }
        });
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

    $('#tablaEjerResolver').on("click", "#resolverEjer", function(){
        var id_ejercicio = $(this).attr("data-number");
        $.ajax({
            method: "POST",
            data: { id_ejercicio: id_ejercicio},
            url: "../templates/adm_profesor/getBorrarDatosResolverEjercicio.php",
            success: function(response)
            {
                location.assign(response);
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

    $(".sel-tab-show select ").change(function(){
        
        var form_data = {
            is_ajax: 1,
            tabla: $(".sel-tab-show select option:checked").val(),
            name: $(".sel-tab-show select option:checked").text()
        };
        if (form_data.tabla !== ""){
            
            $.ajax({
                type: "POST",
                url: "adm_profesor/getStructure.php",
                data: form_data,
                success: function(response)
                {   
                    $('.col-tab-show thead').html('<tr> <th style="width:30%;">Nombre Columna</th><th style="width:30%;">Tipo Columna</th><th style="width:20%;">Clave</th></tr>');
                    $('.col-tab-show tbody').html(response).fadeIn();
                }
            });

        }else{
            $('.structure_table tbody').html("").fadeIn();
        }
    });
    
    $("#nav-exercisesE-tab").click(function(){
        $.ajax({
            type: "POST",
            data: {sujeto: "Profesor"},
            url: "adm_profesor/getResultadoSolucionProfesor.php",
            success: function(response)
            {   
                var resultado = response.substring(23);
                $('.profesorResultadoSolucion table').html(response).fadeIn();
            }
        });
        $.ajax({
            type: "POST",
            data:{sujeto: "Alumno"},
            url: "adm_profesor/getResultadoSolucionProfesor.php",
            success: function(response)
            {   
                var resultado = response.substring(23);
                $('.alumnoResultadoSolucion table').html(response).fadeIn();
            }
        });
    });

    $(".solucionPropuesta").click(function(){
        // var sol_propuesta = $(this).children('td').eq(3).html();
        var sol_propuesta = $(this).find("td:eq(3)").text();

        solucion = sol_propuesta.trim();

        $('.sol_message .modal-body p').html(solucion);
        $('.sol_message').css("visibility", "visible");
        $('.sol_message').css("display", "block");
        
        //$('.nav-tabs a[href="#nav-new-exercises"]').tab('show');
        //$('#solucion').val(solucion);
    });

    $(".sol_close").click(function(){
        $('.sol_message').css("display", "none")
        $('.sol_message').css("visibility", "hidden");
        // $('#modal-close').hide();
    });
    
    $(".select-graficos i").click(function(){
        var grafico = $(this).attr('id');
        
        $.ajax({
            type: "POST",
            data:{grafico: grafico},
            url: "adm_profesor/getSelectGraficos.php",
            success: function(response)
            {   
                location.reload();
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

function selects(){
    
    var profe = $('#select_pro').find(":selected").text();
    if(profe === "Todos Profesores ")
        profe = '';

    var table = $('#employee_data').DataTable();
    table.columns(1).search(profe).draw(false);
    
    var nivel = $('#select_niv').find(":selected").text();
    if(nivel === "Todos Niveles ")
        nivel = '';

    var table = $('#employee_data').DataTable();
    table.columns(2).search(nivel).draw(false);
    
    var tipo = $('#select_tip').find(":selected").text();
    if(tipo === "Todas Categorías ")
        tipo = '';
    
    var table = $('#employee_data').DataTable();
    table.columns(3).search(tipo).draw(false);
    
    var cabeCer = $('#select_cab').find(":selected").text();
    var ord = $('#select_cab').find(":selected").val();
    //Cabecera de ejercicios
    if(cabeCer.trim() === "Descripción" || cabeCer.trim() === "Description" ){
        table.order([0, ord]).draw(false);
    }else if(cabeCer.trim() === 'Profesor' || cabeCer.trim() === "Teacher"){
        table.order([1, ord]).draw(false);
    }else if(cabeCer.trim() === 'Nivel' || cabeCer.trim() === "Level"){
        table.order([2, ord]).draw(false);
    }else if(cabeCer.trim() === 'Tipo' || cabeCer.trim() === "Category"){
        table.order([3, ord]).draw(false);
    }else if(cabeCer.trim() === 'N. Intentos' || cabeCer.trim() === "Num. Intent"){
        table.order([4, ord]).draw(false);
    }
    //
    if(cabeCer.trim() === "Nº de intento" || cabeCer.trim() === "Nº de intento" ){
        table.order([0, ord]).draw(false);
    }else if(cabeCer.trim() === "Fecha y hora" || cabeCer.trim() === "Description" ){
        table.order([0, ord]).draw(false);
    }else if(cabeCer.trim() === "Veredicto" || cabeCer.trim() === "Description" ){
        table.order([0, ord]).draw(false);
    }else if(cabeCer.trim() === "Solución" || cabeCer.trim() === "Description" ){
        table.order([0, ord]).draw(false);
    }
    //Cabecera de Hoja
    if(cabeCer.trim() === "Nombre Hoja" || cabeCer.trim() === "Name Sheet" ){
        table.order([0, ord]).draw(false);
    }else if(cabeCer.trim() === "Nombre Profesor" || cabeCer.trim() === "Name Teacher" ){
        table.order([1, ord]).draw(false);
    }else if(cabeCer.trim() === "N. Ejercicios" || cabeCer.trim() === "Num. of exercises" ){
        table.order([2, ord]).draw(false);
    }else if(cabeCer.trim() === "N. Ejercicios Resueltos" || cabeCer.trim() === "Num. of exercises solved" ){
        table.order([3, ord]).draw(false);
    }else if(cabeCer.trim() === "N. Ejercicios Intentados" || cabeCer.trim() === "Num. of exercises attempted" ){
        table.order([4, ord]).draw(false);
    }
    
    var show = $('.showNumberEntries').text();
    table.page.len( show ).draw(false);
}

function resolverTablas(){
    
    var form_data = {
        is_ajax: 1,
        tabla: $(".sel-tab-show select option:checked").val(),
        name: $(".sel-tab-show select option:checked").text()
    };
    if (form_data.tabla !== ""){

        $.ajax({
            type: "POST",
            url: "adm_profesor/getStructure.php",
            data: form_data,
            success: function(response)
            {   
                $('.col-tab-show thead').html('<tr> <th style="width:30%;">Nombre Columna</th><th style="width:30%;">Tipo Columna</th><th style="width:20%;">Clave</th></tr>');
                $('.col-tab-show tbody').html(response).fadeIn();
            }
        });

    }else{
        $('.structure_table tbody').html("").fadeIn();
    }
}

function newTablas(){
//    var form_data = {
//            is_ajax: 1,
//            tabla: $(".selector-tabla select option:checked").val()
//        };
//        $.ajax({
//            type: "POST",
//            url: "adm_profesor/getColumns.php",
//            data: form_data,
//            success: function(response)
//            {   
//                $('.columnas-tabla #columnas tbody').html(response).fadeIn();
//            }
//        });
    //    alert($(".selector-tabla select option:checked").val());
    //    var form_data = {
    //        is_ajax: 1,
    //        tabla: $(".selector-tabla select option:checked").val(),
    //        name: $(".selector-tabla select option:checked").text()
    //    };
    //    
    //    if (form_data.tabla !== ""){
    //        $('#structure_table thead').html('<tr> <th style="width:30%;">Nombre Columna</th><th style="width:30%;">Tipo Columna</th><th style="width:20%;">Clave</th></tr>');
    //
    //        $.ajax({
    //            type: "POST",
    //            url: "adm_profesor/getStructure.php",
    //            data: form_data, 
    //            success: function(response)
    //            {   
    //                $('#structure_table tbody').html(response).fadeIn();
    //            }
    //        });
    //    }else{
    //        $('.structure-table tbody').html("").fadeIn();
    //    }
}

$( window ).on( "load", function() {    
    cargar();
    selects();
    resolverTablas();
    newTablas();
});

