
$(document).ready(function()
{
  /*--------------Hoja de Ejercicios----------------*/
 
    $('.lista-hoja').hide();
    $('.editar-hoja').hide();
    $('.adm-ejercicios').hide();
    $('.adm-estadisticas').hide();
    $('.adm-tablas').hide();
    $('.configuracion').hide();

    $("#crear_hoja").click(function(){
        
        $('.adm-hojas').show();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
       
        $('.crear-hoja').show("slow");
        $('.editar-hoja').hide();
        $('.lista-hoja').hide();
        
        var that = $(this);
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
    $("#editar_hoja").click(function(){
        
        $('.adm-hojas').show();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
                  
        $('.crear-hoja').hide("linear");
        $('.editar-hoja').show();
        $('.lista-hoja').hide("linear");
        
        var that = $(this);
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
    $("#lista_hoja").click(function(){
       
        $('.adm-hojas').show();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        
        $('.crear-hoja').hide("linear");
        $('.editar-hoja').hide();
        $('.lista-hoja').show("swing");
        
        var that = $(this);
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });

	/*--------------Ejercicios----------------*/

    $("#crear_ejercicio").click(function(){
        
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-estadisticas').hide();
        $('.adm-ejercicios').show();
        $('.adm-tablas').hide();
        
        $('.crear-ejercicio').show("slow");
        $('.editar-ejercicio').hide();
        $('.lista-ejercicio').hide();
        
        var that = $(this);
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
    $("#editar_ejercicio").click(function(){
       
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-estadisticas').hide();
        $('.adm-ejercicios').show();
        $('.adm-tablas').hide();
                 
        $('.crear-ejercicio').hide("linear");
        $('.editar-ejercicio').show();
        $('.lista-ejercicio').hide("linear");
        
        var that = $(this);
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
    $("#lista_ejercicio").click(function(){
        
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        $('.adm-ejercicios').show();
       
        $('.crear-ejercicio').hide("linear");
        $('.editar-ejercicio').hide();
        $('.lista-ejercicio').show("swing");
        
        var that = $(this);
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
    });
  
  
/*--------------Configuracion-----------------*/
  $("#perfil").click(function(){
        
        $('.configuracion').show();
        $('.adm-hojas').hide();
        $('.adm-ejercicios').hide();
        $('.adm-estadisticas').hide();
        $('.adm-tablas').hide();
        
        var that = $(this);
        that.closest('.sub-menu').find('li.active').removeClass('active');
        that.parent().addClass('active');
  });

  /*---------------Estadisticas-------------------*/
  $("#estadistic").click(function(){
        
        $('.adm-hojas').hide();
        $('.configuracion').hide();
        $('.adm-ejercicios').hide();
        $('.adm-tablas').hide();
        $('.adm-estadisticas').show();
  });

  /*---------------Tablas-------------------*/
  $("#adjuntar_tabla").click(function(){
        
      $('.adm-hojas').hide();
      $('.configuracion').hide();
      $('.adm-ejercicios').hide();
      $('.adm-estadisticas').hide();
      $('.adm-tablas').show(); 

      $('.adjuntar-tablas').show();
      $('.mostrar-tablas').hide("linear");

      var that = $(this);
      that.closest('.sub-menu').find('li.active').removeClass('active');
      that.parent().addClass('active');
  });

  $("#mostrar-tablas").click(function(){
        
      $('.adm-hojas').hide();
      $('.configuracion').hide();
      $('.adm-ejercicios').hide();
      $('.adm-estadisticas').hide();
      $('.adm-tablas').show(); 

      $('.mostrar-tablas').show();
      $('.adjuntar-tablas').hide("linear");

      var that = $(this);
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