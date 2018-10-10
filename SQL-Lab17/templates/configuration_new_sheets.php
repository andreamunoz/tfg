<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a> > <a class="enlace" href="configuration_new_sheets.php" > <?php echo trad('Nueva Hoja',$lang) ?></a></label>
    <h2><strong><?php echo trad('Nueva Hoja',$lang) ?></strong></h2>
    <div class="row">
        <div class="col-md-12">
            <p><?php echo trad('Añade una nueva hoja de ejercicios y también puedes añadir ejercicios a esta hoja.',$lang) ?></p>
        </div>
    </div>  
    <section id="tabs">
        <div class="">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="new_sheets" method="post" action="../handler/validate_new_sheets.php">
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="row">
                                <div class="col-md-3 p-0">
                                    <label for="name" ><strong><?php echo trad('Nombre',$lang) ?> </strong></label>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 p-0">                                    
                                    <input type="text" id="new_name_sheet" name="new_name_sheet" placeholder="Nombre Hoja" class="form-control form-control-sm" required/>
                                </div>
                            </div>
                            <div id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">  
                                        <table id="employee_data" class="table table-striped table-bordered">  
                                            <thead>
                                                <tr>                                                      
                                                    <th style="width:10%;"><?php echo trad('Nombre Ejercicio',$lang) ?></th>
                                                    <th style="width:10%;"><?php echo trad('Nivel',$lang) ?></th>
                                                    <th style="width:20%;"><?php echo trad('Tipo',$lang) ?></th>
                                                    <th style="width:10%;"><?php echo trad('Profesor',$lang) ?></th>
                                                    <th style="width:10%; text-align: center"><?php echo trad('Añadir',$lang) ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include_once '../inc/ejercicio.php';
                                                $ejer = new Ejercicio();
                                                include_once '../inc/solucion.php';
                                                $sol = new Solucion();
                                                $result = $ejer->getAllEjerciciosHabilitados();
                                                while ($fila = mysqli_fetch_array($result)) {
                                                    ?>

                                                    <?php
                                                    $id = $fila['id_ejercicio'];
                                                    $solucion = $sol->getAllEjerciciosByName($id);
                                                    $fila_sol = mysqli_fetch_array($solucion);
                                                    ?>
                                                    <tr>

                                                        <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                                        <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                                        <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                                        <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>

                                                        <?php echo '<td style="text-align: center"><input type="checkbox" id="checkbox-editar-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] .'></td>'?>



                                                    </tr>
                                                    <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>  
                                </div> 
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary pl-5 pr-5 mt-5 mb-5" name="new_sheet" type="submit"><?php echo trad('Crear Hoja',$lang) ?></button>
                            </div>
                        </div>
                        <?php
                        if(isset($_SESSION['message_sheets'])){
                            echo $_SESSION['message_sheets'];
                            unset($_SESSION['message_sheets']);
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>

<?php include("footer.php"); ?> 
