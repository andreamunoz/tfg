
    </body>
    <script
            src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script
			  src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
			  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
			  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="../js/functions.js"></script>
    <script src="../js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function(){
        
        $('.contenedor-item').click(function(){
            $('.contenedor-item').removeClass('active');
            $(this).addClass('active');
            //alert("hola");
        });
    });
    </script>
    <script>
    $(document).ready(function () {
        $('#employee_data').DataTable();
    });
    $(document).ready(function () {
        $('#employee_prueba').DataTable();
    });
    $(document).ready(function () {
        $('#employee_table').DataTable();
    });
    $(document).ready(function () {
        $('#employee_table_hoja').DataTable();
    });
    $(document).ready(function () {
        $('#employee_list').DataTable();
    });
    $(document).ready(function () {
        $('.table-sortable tbody').sortable();
        
    });
    $(document).ready(function () {
        $('#employee_table_hoja > tbody').sortable({           
            update: function (event, ui){
                var table = $('#employee_table_hoja').DataTable(); 
                var tablaPrueba = $('#employee_prueba').DataTable();
                $(this).children().each(function (index){
                    if($(this).attr('data-position') != (index)){
                        $(this).attr('data-position',(index)).addClass('updated');
                    }
                });
//                var longitud = $('#employee_table_hoja').find('tr').length - 1;
                var position=0;
                $('#employee_table_hoja').find('tr').each(function(){ 
//                    if(position!=0){
                        tablaPrueba.row.add(this);
//                    }
                    position++;
                }); 
                var position=0;
                $('#employee_prueba').find('tr').each(function(){
                    console.log(table.row(position).data());
                    position++;
                });
//                table.draw();
                //tablaPrueba.draw();
//                table.clear().draw();
                var position=0;
                $('#employee_prueba').find('tr').each(function(){
                    if(position!=0){
                        table.row(position).data( tablaPrueba.row(position).data());
                    }
                    position++;
                });
                
                table.draw();
                tablaPrueba.clear();
                tablaPrueba.draw();
                
//                alert(table.page.info());
//                tablaPrueba.rows().remove().draw();
//                    var index = table.row(this).index();
//                    if(index+1 <= longitud){
//                        var tdVista = $(this).find('td:first-child').text(); //td:vista
//                        var tdTabla = table.row(position).data()[0];
//                        if(tdVista !== tdTabla){
//                            var data = table.row(position).data();
//                            var dataSiguiente = table.row(position+1).data();
//                        }
//                        alert('No');
//                    }
                      
//                    var tr = $('#employee_table_hoja').find('tr');
//                    var index = table.row(tr).index();
//                    alert(index);
//
//                    var data = table.row(index).data();
//                    for(i=index-1; i>=0; i--){
//                        var data2 = table.row(i).data();
//                        table.row(i+1).data(data2);
//                    }
//                    table.row(0).data(data).draw();
                  
                    
                        
                        
//                });
//                $('#employee_table_hoja').find('tr').each(function(){
                        
//                        table.page(0).draw(false);
//                        }
//                        var data = table2.row(2).data();
////                        if(table.row(this).index() > position){
////                        index2 = position;
//                        var data2 = table2.row(0).data();
//                        var data1 = table2.row(1).data();
//
//                        table2.row(0).data(data);
//                        table2.row(1).data(data2);
//                        table2.row(2).data(data1);
//                        
//                        table2.page(0).draw(false);
//                    id = $(this).find('td:last-child').text();
//                    id_hoja = $(this).closest('table').attr('value');
//                    if($(this).attr('data-position')!=null){
//                        positions[i] = $(this).find('td:last-child').text();
//                        i++;
//                    }
//                    
//                });
//                alert(positions);
//                $.ajax({
//                    method: "POST",
//                    url: "../templates/adm_profesor/getActualizarOrden.php",
//                    data: { id: id, id_hoja: id_hoja, positions: positions},
//                    success: function(positions)
//                    {
//                        alert(positions);
//                    }
//                });
                
//                $(this).children().each(function (index){
//                    
//                    if($(this).attr('data-position') != (index+1)){
//                        $(this).attr('data-position',(index+1)).addClass('updated');
//                        var id = $(this).attr('data-index');
//                        var id_hoja = $(this).attr('data-index-sheet');
//                        var positions = $(this).attr('data-position');
//                        $.ajax({
//                            method: "POST",
//                            url: "../templates/adm_profesor/getActualizarOrden.php",
//                            data: { id: id, id_hoja: id_hoja, positions: positions},
////                            success: function(response)
////                            {
////                                alert(response);
////                            }
//                        });
//                    }
//                });
            }
        });
        
    });  
    </script>
</html>

