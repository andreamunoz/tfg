<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php $id_hoja = $_GET['hoja']; 
    include_once '../inc/hoja_ejercicio.php';
    $hoja = new HojaEjercicio();
    $descripcion = $hoja->getHojaById($id_hoja);
    
    ?>
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Configuración',$lang) ?> </a> > <a class="enlace" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a> > <a class="enlace" href="configuration_edit_sheets.php?hoja=<?php echo $id_hoja ?> " > <?php echo trad('Editar Hoja',$lang) ?></a></label>
    <h2><strong><?php echo trad('Editar Hoja',$lang) ?> | <?php echo $descripcion ?></strong> </h2>
    <div class="row mb-5">
        <div class="col-md-12">
            <p><?php echo trad('Edita la hoja de ejercicios seleccionada y puede añadir o eliminar los ejercicios.',$lang) ?></p>
        </div>
    </div>  


    <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="edit_sheets" method="post" action="../handler/validate_edit_sheets.php?hoja=<?php echo $id_hoja ?>">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-sheets-tab" data-toggle="tab" href="#nav-new-sheets" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo trad('Editar Hoja',$lang) ?></a>
                                <a class="nav-item nav-link" id="nav-exercises-tab" data-toggle="tab" href="#nav-exercises" role="tab" aria-controls="nav-profile" aria-selected="false"><?php echo trad('Añadir Ejercicios',$lang) ?></a>
                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active mt-3 pl-4" id="nav-new-sheets" role="tabpanel" aria-labelledby="nav-sheets-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" ><strong><?php echo trad('Nombre',$lang) ?> </strong></label>                                    
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" ><strong><?php echo trad('Profesor',$lang) ?> </strong></label>                                    
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" ><strong><?php echo trad('N.Ejercicios',$lang) ?> </strong></label>               
                                    </div>
                                </div>
                                <!--<hr class="hrr">-->
                                <div class="row">
                                    <div class="col-md-3">                                    
                                        <input type="text" id="edit_name_sheet" name="edit_name_sheet" value="<?php echo $descripcion ?>" class="form-control form-control-sm" required/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="user_sheet" name="user_sheet" placeholder="<?php echo $_SESSION['user'] ?>" class="form-control form-control-sm" readonly/>
                                    </div>
                                    <div class="col-md-3">
                                        <?php
                                        include_once '../inc/esta_contenido.php';
                                        $number = new EstaContenido();
                                        $row_number = $number->getNumberEjerciciosByHoja($id_hoja);                          
                                        ?>
                                        <input type="text" id="intent" name="intent" placeholder="<?php echo $row_number["COUNT(id_ejercicio)"] ?>" class="form-control form-control-sm" readonly/>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade mt-3 pl-4" id="nav-exercises" role="tabpanel" aria-labelledby="nav-exercises-tab">
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
                                                    include_once '../inc/ejercicio.php';
                                                    $result = $ejer->getAllEjerciciosHabilitados();   
                                                    while ($fila = mysqli_fetch_array($result)) {
                                                        ?>

                                                        <?php
                                                        $id = $fila['id_ejercicio'];
                                                        $solucion = $sol->getAllEjerciciosByName($id);                                                        
                                                        $ejercicios_hoja = $ejer->getExistEjerciciosHoja($id_hoja,$id);
                                                        ?>
                                                        <tr>
                                                            <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                                            <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                                            <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                                            <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>                                                           
                                                            <?php if ($ejercicios_hoja==1){ ?>
                                                            <?php echo '<td style="text-align: center"><input type="checkbox" id="checkbox-editar-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] . ' checked ></td>'?>
                                                            <?php }else {?>
                                                            <?php echo '<td style="text-align: center"><input type="checkbox" id="checkbox-editar-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] . ' ></td>' ?>
                                                            <?php } ?>
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
                                    <button class="btn btn-primary pl-5 pr-5 mt-5 mb-5" name="new_sheet" type="submit"><?php echo trad('Actualizar Hoja',$lang) ?></button>
                                </div>
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
