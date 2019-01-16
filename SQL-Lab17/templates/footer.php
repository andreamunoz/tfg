
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
        $('.table-sortable tbody').sortable({
//            update: function (event, ui){
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
//                            data: { id: id, id_hoja: id_hoja, positions: positions}
//                        });
//                    }
//                });
//            }
        });
//        $( '.table-sortable tbody' ).disableSelection();
    });  
    </script>
</html>

