<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
     <?php 
    include_once '../inc/hoja_ejercicio.php';
    $hoja = new HojaEjercicio();
    $id_hoja = $_GET['hoja'];
    $descripcion = $hoja->getHojaById($id_hoja);
    ?>
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor', $lang) ?> </a> > <a class="enlace" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios', $lang) ?></a> > <a class="enlace" href="configuration_edits_sheets.php?hoja=<?php echo $id_hoja ?> " > <?php echo trad('Editar Hoja', $lang) ?></a></label>
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
                        <div class="form-group text-right">
                            <button class="btn btn-primary pl-5 pr-5 mt-1 updateSheet" name="<?php echo $id_hoja ?>" ><?php echo trad('Guardar Hoja', $lang) ?></button>
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
                                <input type="text" maxlength="50" id="edit_name_sheet" name="edit_name_sheet" value="<?php echo $descripcion ?>" class="form-control form-control-sm" required/>
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
                                                <th style="width:30%;"><?php echo trad('Descripción', $lang) ?></th>
                                                <th style="width:20%;"><?php echo trad('Profesor', $lang) ?></th>
                                                <th style="width:20%;"><?php echo trad('Nivel', $lang) ?></th>
                                                <th style="width:25%;"><?php echo trad('Tipo', $lang) ?></th>
                                                <th style="width:9%;"><?php echo trad('Seleccionados', $lang) ?></th>
                                                <th style="width:1%;"></th>
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
                                                    <?php echo '<td ><i id='.$id_hoja.' value=' . $fila["id_ejercicio"] . ' class="fas fa-trash mr-3" style="color:black; opacity:0.9;" title="Eliminar"> </i></td>' ?>
                                                    <?php echo '<td><p style="display:none;">' . $fila['id_ejercicio'] . '</p></td>'; ?>
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
                                                <th style="width:30%;"><?php echo trad('Descripción', $lang) ?></th>
                                                <th style="width:20%;"><?php echo trad('Profesor', $lang) ?></th>
                                                <th style="width:20%;"><?php echo trad('Nivel', $lang) ?></th>
                                                <th style="width:20%;"><?php echo trad('Tipo', $lang) ?></th>
                                                <th style="width:9%;"><?php echo trad('Añadir', $lang) ?></th>                                         
                                                <th style="width:1%;"></th>
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
                                            if($_SESSION['showNumber'] != ""){
                                            ?>
                                                <p class="showNumberEntries display-none"><?php echo $_SESSION['showNumber'] ?></p>
                                            <?php } else { ?>
                                                <p class="showNumberEntries display-none">10</p>
                                            <?php } ?>
                                            <?php
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
                                                    <?php echo '<td ><i class="fas fa-arrow-up mr-3" style="color:black; opacity:0.9;" title="Añadir"> </i></td>' ?>
                                                    <?php echo '<td><p style="display:none;">' . $fila['id_ejercicio'] . '</p></td>'; ?>
                                                </tr>
                                            <?php } } }?>
                                        </tbody> 
                                    </table>
                                </div>  
                            </div>
                        </div>
                        <div id="accordion ">
                            <div class="card">  
                                <div class="table-responsive">  
                                    <table id="employee_prueba" class="table table-striped-conf table-bordered table-sortable" value="<?php echo $id_hoja?>">  
                                        <thead>
                                            <th style="width:30%;"><?php echo trad('Descripción', $lang) ?></th>
                                            <th style="width:20%;"><?php echo trad('Profesor', $lang) ?></th>
                                            <th style="width:20%;"><?php echo trad('Nivel', $lang) ?></th>
                                            <th style="width:20%;"><?php echo trad('Tipo', $lang) ?></th>
                                            <th style="width:9%;"><?php echo trad('Añadir', $lang) ?></th>                                         
                                            <th style="width:1%;"></th></thead>
                                    <tbody>
                                        
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
                </div>
            </div>
        </div>
        <div class="modalName modal fade show" id="modal-close" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display:none">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <div class="close" id="close-modal">
                        <i class="fas fa-times" data-dismiss="modal"></i>
                      </div>
                    </div>
                    <div class="modal-body">
                        <h2><strong>¡Error!</strong></h2>
                        <p>Rellene el nombre de la hoja y al menos seleccione un ejercicio.</p>
                    </div>
                </div>
            </div>   
        </div>
    </section>
</div>
<?php include("footer.php"); ?> 
