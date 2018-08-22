<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php $id_hoja = $_GET['hoja']; 
    include_once '../inc/hoja_ejercicio.php';
    $hoja = new HojaEjercicio();
    $descripcion = $hoja->getHojaById($id_hoja);
    
    ?>
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_sheets.php" > Hoja de Ejercicios</a> > <a class="enlace" href="configuration_edit_sheets.php" > Editar Hoja</a></label>
    <h2><strong>Editar Hoja | <?php echo $descripcion ?></strong> </h2>
    <div class="row mb-5">
        <div class="col-md-12">
            <p>Añade, una nueva hoja de ejercicios...</p>
        </div>
    </div>  


    <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="new_sheets" method="post" action="../handler/validate_new_sheets.php">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-sheets-tab" data-toggle="tab" href="#nav-new-sheets" role="tab" aria-controls="nav-home" aria-selected="true">Nueva Hoja</a>
                                <a class="nav-item nav-link" id="nav-exercises-tab" data-toggle="tab" href="#nav-exercises" role="tab" aria-controls="nav-profile" aria-selected="false">Añadir Ejercicios</a>
                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active mt-3 pl-4" id="nav-new-sheets" role="tabpanel" aria-labelledby="nav-sheets-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" ><strong>Nombre </strong></label>                                    
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" ><strong>Profesor </strong></label>                                    
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" ><strong>N.Ejercicios </strong></label>               
                                    </div>
                                </div>
                                <!--<hr class="hrr">-->
                                <div class="row">
                                    <div class="col-md-3">                                    
                                        <input type="text" id="new_name_sheet" name="new_name_sheet" value="<?php echo $descripcion ?>" class="form-control form-control-sm" required/>
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
                                                        <th style="width:10%;">Nombre Ejercicio</th>
                                                        <th style="width:10%;">Nivel</th>
                                                        <th style="width:20%;">Tipo</th>
                                                        <th style="width:10%;">Profesor</th>
                                                        <th style="width:10%; text-align: center">Añadir</th>
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
                                <div class="form-group col-md-2 offset-10">
                                    <button class="btn btn-primary pl-4 pr-4" name="new_sheet" type="submit">Actualizar Hoja</button>
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
