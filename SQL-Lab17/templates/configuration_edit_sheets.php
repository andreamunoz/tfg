<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php
    $id_hoja = $_GET['hoja'];
    include_once '../inc/hoja_ejercicio.php';
    $hoja = new HojaEjercicio();
    $descripcion = $hoja->getHojaById($id_hoja);
    ?>
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor', $lang) ?> </a> > <a class="enlace" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios', $lang) ?></a> > <a class="enlace" href="configuration_edit_sheets.php?hoja=<?php echo $id_hoja ?> " > <?php echo trad('Editar Hoja', $lang) ?></a></label>
    <h2><strong><?php echo trad('Editar Hoja', $lang) ?> | <?php echo $descripcion ?></strong> </h2>
    <div class="row">
        <div class="col-md-12">
            <p><?php echo trad('Edita la hoja de ejercicios seleccionada y puede añadir o eliminar los ejercicios.', $lang) ?></p>
        </div>
    </div>
    <section id="tabs">
        <div class="">
            <div class="row">
                <div class="col-md-12 ">
                    <!--<form id="edit_sheets" method="post" action="#">-->
                        <div class="form-group text-right">
                            <button class="btn btn-primary pl-5 pr-5 mt-1 updateSheet" name="<?php echo $id_hoja ?>" ><?php echo trad('Actualizar Hoja', $lang) ?></button>
                        </div>
                        <?php if(isset($_SESSION['message_edit_sheets'])){
                                echo $_SESSION['message_edit_sheets'];
                                unset($_SESSION['message_edit_sheets']);
                        } ?>
                        <div class="row">
                            <div class="col-md-3 p-0">
                                <p for="name" ><strong><?php echo trad('Nombre', $lang) ?> </strong></p>                                    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 p-0">                                    
                                <input type="text" id="edit_name_sheet" name="edit_name_sheet" value="<?php echo $descripcion ?>" class="form-control form-control-sm" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 p-0 pt-4">
                                <p for="name" ><strong><?php echo trad('Ejercicios Seleccionados', $lang) ?> </strong></p>                                    
                            </div>
                        </div>
                        <div id="accordion ">
                            <div class="card">  
                                <div class="table-responsive">  
                                    <table id="employee_table_hoja" class="table table-striped-conf table-bordered table-sortable">  
                                        <thead>
                                            <tr>                                                      
                                                <th style="width:20%;"><?php echo trad('Descripción', $lang) ?></th>
                                                <th style="width:10%;"><?php echo trad('Profesor', $lang) ?></th>
                                                <th style="width:10%;"><?php echo trad('Nivel', $lang) ?></th>
                                                <th style="width:15%;"><?php echo trad('Tipo', $lang) ?></th>
                                                <th style="width:10%; text-align: center"><?php echo trad('Seleccionados', $lang) ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once '../inc/ejercicio.php';
                                            $ejer = new Ejercicio();
                                            include_once '../inc/solucion.php';
                                            $sol = new Solucion();
                                            include_once '../inc/ejercicio.php';
                                            $result = $ejer->getAllEjerciciosHabilitadosOrden($id_hoja);
                                            while ($fila = mysqli_fetch_array($result)) {
                                                $id = $fila['id_ejercicio'];
                                                $solucion = $sol->getAllEjerciciosByName($id);
                                                $ejercicios_hoja = $ejer->getExistEjerciciosHoja($id_hoja, $id);
                                                ?>
                                                <?php if ($ejercicios_hoja == 1) { ?>
                                                <tr class="del" data-index="<?php echo $fila['id_ejercicio']?>" data-index-sheet="<?php echo $id_hoja?>" data-position="<?php echo $fila['orden']?>">
                                                    <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['nombre'].' '.$fila['apellidos'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                                    <?php echo '<td style="text-align: center"><i id='.$id_hoja.' value=' . $fila["id_ejercicio"] . ' class="deleteExercise fas fa-trash mr-3" style="color:black; opacity:0.9;" title="Eliminar"> </i></td>' ?>
                                                </tr>
                                            <?php } }?>
                                        </tbody>
                                    </table>
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 p-0 pt-4">
                                <p for="name" ><strong><?php echo trad('Añadir Ejercicios', $lang) ?> </strong></p>                                    
                            </div>
                        </div>
                        <div id="accordion ">
                            <div class="card">  
                                <div class="table-responsive no-buscar">  
                                    <table id="employee_data" class="table table-striped-conf table-bordered añadir">  
                                        <thead>
                                            <tr>                                                      
                                                <th style="width:20%;"><?php echo trad('Descripción', $lang) ?></th>
                                                <th style="width:10%;"><?php echo trad('Profesor', $lang) ?></th>
                                                <th style="width:10%;"><?php echo trad('Nivel', $lang) ?></th>
                                                <th style="width:15%;"><?php echo trad('Tipo', $lang) ?></th>
                                                <th style="width:10%; text-align: center"><?php echo trad('Añadir', $lang) ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once '../inc/ejercicio.php';
                                            $ejer = new Ejercicio();
                                            include_once '../inc/solucion.php';
                                            $sol = new Solucion();
                                            include_once '../inc/hoja_ejercicio.php';
                                            $hojaejer = new HojaEjercicio();
                                            $res= $ejer->getAllNiveles();
                                            $resC = $ejer->getAllCategorias();
                                            $resP = $ejer->getCreadorEjercicio();
                                            if (isset($res) && isset($resC) && isset($resP)) {
                                                echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_profe" title="Selecciona Profesor" id="select_hoja">';
                                                echo "<option name='' apellido1='' apellido2=''>Todos Profesores </option>";
                                                while ($row_profe = mysqli_fetch_array($resP)) {
                                                    $apellidos = explode(" ",$row_profe['apellidos']);
                                                    echo "<option name=". $row_profe['nombre']." apellido1=".$apellidos[0]." apellido2=".$apellidos[1].">" . $row_profe['nombre'].' '.$row_profe['apellidos'] . " </option>";
                                                }
                                                echo '</select>';
                                                echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_nivel" title="Selecciona Nivel" id="select_hoja">';
                                                echo "<option value=". $row_nivel['nivel'] .">Todos Niveles </option>";
                                                
                                                    echo "<option value='Principiante'>Principiante</option>";
                                                    echo "<option value='Intermadio'>Intermedio</option>";
                                                    echo "<option value='Avanzado'>Avanzado</option>";

                                                echo '</select>';
                                                echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_tipo" title="Selecciona Categoria" id="select_hoja">';
                                                echo "<option value=''>Todas Categorías</option>";
                                                while ($row_tipo = mysqli_fetch_array($resC)) {
                                                    echo "<option value=" . $row_tipo['tipo'] . ">" . $row_tipo['tipo'] . " </option>";
                                                }
                                                echo '</select>';
                                                
                                            $result = $ejer->getAllEjerciciosHabilitados($_SESSION['user']);
                                            while ($fila = mysqli_fetch_array($result)) {
                                                $id = $fila['id_ejercicio'];
                                                $solucion = $sol->getAllEjerciciosByName($id);
                                                $ejercicios_hoja = $ejer->getExistEjerciciosHoja($id_hoja, $id);
                                                ?>
                                                <?php if ($ejercicios_hoja != 1) { ?>
                                                <tr class="add" data-index="<?php echo $fila['id_ejercicio']?>" data-index-sheet="<?php echo $id_hoja?>" data-position="">
                                                    <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['nombre'].' '.$fila['apellidos'] . '</td>'; ?> 
                                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                                    <?php echo '<td style="text-align: center"><input type="checkbox" class="checkbox-add-ejer" id='.$id_hoja.' name="seleccionados[]" value=' . $fila["id_ejercicio"] . ' data-name='.$descripcion.'></td>' ?>
                                                </tr>
                                            <?php } } }?>
                                        </tbody>
                                    </table>
                                </div>  
                            </div>
                        </div>
                        
                        <?php
                        if (isset($_SESSION['message_sheets'])) {
                            echo $_SESSION['message_sheets'];
                            unset($_SESSION['message_sheets']);
                        }
                        ?>
                    <!--</form>-->
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    /*function checkDes(id){
        var id_ejer = $('td').find("input[id="+id+"]").attr("value");
        alert(id_ejer);
        var name = $('td').find("input[id="+id+"]").closest('.del').find('td').eq(0).html();
        var nivel = $('td').find("input[id="+id+"]").closest('.del').find('td').eq(1).html();
        var tipo = $('td').find("input[id="+id+"]").closest('.del').find('td').eq(2).html();
        var profe = $('td').find("input[id="+id+"]").closest('.del').find('td').eq(3).html();
        
        var tr = '<tr class="add ui-sortable-handle" data-index='+id_ejer+' data-index-sheet="49" data-position=""><td>'+name+'</td><td>'+nivel+'</td><td>'+tipo+'</td><td>'+profe+'</td><td style="text-align: center"><input class="checkbox-add-ejer" id='+id_ejer+' name="seleccionados[]" value='+id_ejer+' onclick="checkAdd('+id_ejer+')" type="checkbox"></td></tr>';
        $(tr).click();    
        console.log(tr);
        var table = $('#employee_data').DataTable({
            paging:   true,
            destroy: true,
            searching: true
        });
        table.row.add($(tr)).draw(false);
        $('td').find("input[id="+id+"]").closest('tr').hide();
    }
    
    function checkAdd(id){
        var id_ejer = $('td').find("input[id="+id+"]").attr("value");
        alert(id_ejer);
        var name = $('td').find("input[id="+id+"]").closest('.add').find('td').eq(0).html();
        var nivel = $('td').find("input[id="+id+"]").closest('.add').find('td').eq(1).html();
        var tipo = $('td').find("input[id="+id+"]").closest('.add').find('td').eq(2).html();
        var profe = $('td').find("input[id="+id+"]").closest('.add').find('td').eq(3).html();
        
        var tr = '<tr class="del ui-sortable-handle" data-index='+id_ejer+' data-index-sheet="49" data-position=""><td>'+name+'</td><td>'+nivel+'</td><td>'+tipo+'</td><td>'+profe+'</td><td style="text-align: center"><input class="checkbox-add-ejer" id='+id_ejer+' name="seleccionados[]" value='+id_ejer+' onclick="checkDel('+id_ejer+')" type="checkbox" checked></td></tr>';
        $(tr).click();    
        console.log(tr);
        var table = $('#employee_table_hoja').DataTable({
            paging:   true,
            destroy: true,
            searching: true
        });
        table.row.add($(tr)).draw(false);
        $('td').find("input[id="+id+"]").closest('tr').hide();
    }*/
//function checkAdd(element){
        //$('.checkbox-add-ejer').click(function(){
//        alert(document.getElementsByTagName("input").item(0));
//        var id_ejer = $(this).attr("value");
//        var id_hoja = $('.checkbox-add-ejer').attr("49");
//        alert(id_hoja);
//        var name = $('.checkbox-add-ejer').closest('.add').find('td').eq(0).html();
//        var nivel = $('.checkbox-add-ejer').closest('.add').find('td').eq(1).html();
//        var tipo = $('.checkbox-add-ejer').closest('.add').find('td').eq(2).html();
//        var profe = $('.checkbox-add-ejer').closest('.add').find('td').eq(3).html();
//        
//        var tr = '<tr class="add"><td>'+name+'</td><td>'+nivel+'</td><td>'+tipo+'</td><td>'+profe+'</td><td style="text-align: center"><input class="checkbox-select-ejer" id='+id_hoja+' name="seleccionados[]" value='+id_ejer+' checked="" type="checkbox"></td></tr>';
//        $(tr).click();
//        console.log(tr);
//        var table = $('#employee_data').DataTable();
//        table.row.add($(tr)).draw(false);
//        $('.checkbox-select-ejer').closest('.add').hide();
    //});
//    }
</script>
<?php include("footer.php"); ?> 
