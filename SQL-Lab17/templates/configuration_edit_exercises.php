<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php 
    include_once '../inc/ejercicio.php';
    include_once '../inc/tablas.php';
    $ejer = new Ejercicio();
    $id_ejer = $_GET['exercise'];
    $des = $ejer->getDescripcionEjercicio($id_ejer);
    ?>
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_exercises.php" > Ejercicios</a> > <a class="enlace" href="configuration_edit_exercises.php?exercise=<?php echo $id_ejer ?>" > Editar Ejercicio</a></label>
    <h2><strong>Editar Ejercicio | <?php echo $des ?></strong></h2>
    <div class="row mb-5">
        <div class="col-md-12">
            <p>Edite el ejercicio...</p>
        </div>
    </div>  
    <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="new_sheets" method="post" action="../handler/validate_edit_exercises.php?exercise=<?php echo $id_ejer ?>">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-exercisesD-tab" data-toggle="tab" href="#nav-new-exercises" role="tab" aria-controls="nav-new-exercises" aria-selected="true">Editar Ejercicio</a>
                                <a class="nav-item nav-link" id="nav-exercisesT-tab" data-toggle="tab" href="#nav-exercisesT" role="tab" aria-controls="nav-new-table" aria-selected="false">Editar Tablas</a>
                                <a class="nav-item nav-link" id="nav-exercisesE-tab" data-toggle="tab" href="#nav-exercisesE" role="tab" aria-controls="nav-enun-sol" aria-selected="false">Enunciado/Solución</a>

                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active mt-3 pl-4" id="nav-new-exercises" role="tabpanel" aria-labelledby="nav-exercisesD-tab">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="name" ><strong>Nombre </strong></label>                                    
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong>Nivel </strong></label>                                    
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" ><strong>Categoría </strong></label>               
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong>Vista </strong></label>               
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong>Profesor </strong></label>               
                                    </div>                                   
                                </div>
                                <!--<hr class="hrr">-->
                                <?php
                                
                                $tabla = new Tablas();
                                $ejercicioId = $ejer->getEjercicioById($id_ejer);
                                ?>
                                <div class="row">
                                    <div class="col-md-2">                                    
                                        <input type="text" id="new_name_sheet" name="edit_name_exercise" value="<?php echo $ejercicioId['descripcion'] ?>" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="niveles" class="custom-select form-control-sm " title="Selecciona" id="select_nivel">
                                            <?php
                                            $niveles = $ejer->getAllNiveles();
                                            while ($nivel = mysqli_fetch_array($niveles)) {                                              
                                                if($ejercicioId['nivel'] == $nivel['nivel'])                                                   
                                                    echo "<option value=" . $nivel['nivel'] . " selected>" . $nivel['nivel'] . " </option>";
                                                else
                                                    echo "<option value=" . $nivel['nivel'] . " >" . $nivel['nivel'] . " </option>";
                                            }   
                                            ?>              
                                        </select>                                        
                                    </div>
                                    <div class="col-md-3">
                                        <select name="categoria" class="custom-select form-control-sm " title="Selecciona" id="select_categoria">
                                            <?php
                                            $categorias = $ejer->getAllCategorias();
                                            while ($categoria = mysqli_fetch_array($categorias)) {
                                                if($ejercicioId['tipo'] == $categoria['tipo'])
                                                    echo "<option value=" . $categoria['tipo'] . " selected>" . $categoria['tipo'] . " </option>";
                                                else
                                                    echo "<option value=" . $categoria['tipo'] . " >" . $categoria['tipo'] . " </option>";                                                                      
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="col-md-2">
                                        <select name="habdes" class="custom-select form-control-sm " title="Selecciona" id="select_categoria">
                                            <?php if($ejercicioId['deshabilitar'] == 1){?>
                                                    <option value="1" selected=''>Habilitar</option>
                                                    <option value="0" >Deshabilitar</option>
                                            <?php }else{ ?>
                                                    <option value="1" >Habilitar</option>
                                                    <option value="0" selected=''>Deshabilitar</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="user_sheet" name="user_sheet" placeholder="<?php echo $_SESSION['user'] ?>" class="form-control form-control-sm" readonly/>
                                    </div>

                                </div>

                            </div>
                            <div class="tab-pane fade mt-3 pl-4" id="nav-exercisesE" role="tabpanel" aria-labelledby="nav-exercisesE-tab">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong>Enunciado</strong></label>
                                        <textarea id="enunciado" name="enunciado" class="form-control" rows="10" required="" ><?php echo $ejercicioId['enunciado'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>Solución</strong></label>
                                        <textarea id="solucion" name="solucion" class="form-control" rows="10" required=""><?php echo $ejercicioId['solucion'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 offset-10">
                                    <button class="btn btn-primary pl-4 pr-4 mt-4" name="new_exercise" type="submit">Actualizar Ejercicio</button>
                                </div>
                            </div>
                            <div class="tab-pane fade mt-3 pl-4" id="nav-exercisesT" role="tabpanel" aria-labelledby="nav-exercisesT-tab">
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><strong>Creador Tablas</strong></label>
                                        <div class=" selector-user" >
                                            <select name="user_tabla" class=" custom-select form-control-sm" id="user_tablas" name="user_tablas" title="Selecciona" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><strong>Tablas</strong></label>
                                        <div class=" selector-tabla" >
                                            <select type="text" id="tablas" name="tablas[]" class="custom-select form-control-sm"></select>				  				 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><strong>Campos</strong></label>
                                        <table id="columnas" class="form-control" ></table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (isset($_SESSION['message_sheets'])) {
                            echo $_SESSION['message_sheets'];
                            unset($_SESSION['message_sheets']);
                        }
                        if (isset($_SESSION['message_edit_sheets'])) {
                            echo $_SESSION['message_edit_sheets'];
                            unset($_SESSION['message_edit_sheets']);
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>

<?php include("footer.php"); ?> 
