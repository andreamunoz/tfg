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
                    <form id="edit_sheets" method="post" action="../handler/validate_edit_sheets.php?hoja=<?php echo $id_hoja ?>">
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
                                    <table id="employee_table_hoja" class="table table-striped table-bordered">  
                                        <thead>
                                            <tr>                                                      
                                                <th style="width:10%;"><?php echo trad('Nombre Ejercicio', $lang) ?></th>
                                                <th style="width:10%;"><?php echo trad('Nivel', $lang) ?></th>
                                                <th style="width:20%;"><?php echo trad('Tipo', $lang) ?></th>
                                                <th style="width:10%;"><?php echo trad('Profesor', $lang) ?></th>
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
                                            $result = $ejer->getAllEjerciciosHabilitados();
                                            while ($fila = mysqli_fetch_array($result)) {
                                                $id = $fila['id_ejercicio'];
                                                $solucion = $sol->getAllEjerciciosByName($id);
                                                $ejercicios_hoja = $ejer->getExistEjerciciosHoja($id_hoja, $id);
                                                ?>
                                                <?php if ($ejercicios_hoja == 1) { ?>
                                                <tr class="del">
                                                    <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>
                                                    <?php echo '<td style="text-align: center"><input type="checkbox" class="checkbox-select-ejer" id='.$id_hoja.' name="seleccionados[]" value=' . $fila["id_ejercicio"] . ' checked ></td>' ?>
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
                                <div class="table-responsive">  
                                    <table id="employee_data" class="table table-striped table-bordered añadir">  
                                        <thead>
                                            <tr>                                                      
                                                <th style="width:10%;"><?php echo trad('Nombre Ejercicio', $lang) ?></th>
                                                <th style="width:10%;"><?php echo trad('Nivel', $lang) ?></th>
                                                <th style="width:20%;"><?php echo trad('Tipo', $lang) ?></th>
                                                <th style="width:10%;"><?php echo trad('Profesor', $lang) ?></th>
                                                <th style="width:10%; text-align: center"><?php echo trad('Añadir', $lang) ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once '../inc/ejercicio.php';
                                            $ejer = new Ejercicio();
                                            include_once '../inc/solucion.php';
                                            $sol = new Solucion();
                                            include_once '../inc/ejercicio.php';
                                            $result = $ejer->getAllEjerciciosHabilitados();
                                            while ($fila = mysqli_fetch_array($result)) {
                                                $id = $fila['id_ejercicio'];
                                                $solucion = $sol->getAllEjerciciosByName($id);
                                                $ejercicios_hoja = $ejer->getExistEjerciciosHoja($id_hoja, $id);
                                                ?>
                                                <?php if ($ejercicios_hoja != 1) { ?>
                                                <tr class="add">
                                                    <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                                    <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?> 
                                                    <?php echo '<td style="text-align: center"><input type="checkbox" class="checkbox-add-ejer" id='.$id_hoja.' name="seleccionados[]" value=' . $fila["id_ejercicio"] . ' ></td>' ?>
                                                </tr>
                                                <?php } }  ?>
                                        </tbody>
                                    </table>
                                </div>  
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary pl-5 pr-5 mt-5 mb-5" name="new_sheet" type="submit"><?php echo trad('Actualizar Hoja', $lang) ?></button>
                        </div>
                        <?php
                        if (isset($_SESSION['message_sheets'])) {
                            echo $_SESSION['message_sheets'];
                            unset($_SESSION['message_sheets']);
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include("footer.php"); ?> 
