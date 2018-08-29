<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_exercises.php" > Ejercicios</a> > <a class="enlace" href="configuration_new_exercises.php" > Nuevo Ejercicio</a></label>
    <h2 id="userPrincipal" data-name="<?php echo $_SESSION['user']; ?>"><strong>Nuevo Ejercicio</strong></h2>
    <div class="row mb-5">
        <div class="col-md-12">
            <p>Añade, un nuevo ejercicio a la lista...</p>
        </div>
    </div>  


    <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="new_sheets" method="post" action="../handler/validate_new_exercises.php">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-exercisesD-tab" data-toggle="tab" href="#nav-new-exercises" role="tab" aria-controls="nav-new-exercises" aria-selected="true">Nuevo Ejercicio</a>
                                <a class="nav-item nav-link" id="nav-exercisesT-tab" data-toggle="tab" href="#nav-exercisesT" role="tab" aria-controls="nav-new-table" aria-selected="false">Añadir Tablas</a>
                                <a class="nav-item nav-link" id="nav-exercisesE-tab" data-toggle="tab" href="#nav-exercisesE" role="tab" aria-controls="nav-enun-sol" aria-selected="false">Enunciado/Solución</a>

                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active mt-3 pl-4" id="nav-new-exercises" role="tabpanel" aria-labelledby="nav-exercisesD-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name" ><strong>Descripción <span class="red"> *</span></strong></label>                                    
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong>Nivel <span class="red"> *</span></strong></label>                                    
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" ><strong>Categoría <span class="red"> *</span></strong></label>               
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong>Vista <span class="red"> *</span></strong></label>               
                                    </div>                                   
                                </div>
                                <!--<hr class="hrr">-->
                                <?php
                                include_once '../inc/ejercicio.php';
                                include_once '../inc/tablas.php';
                                $ejer = new Ejercicio();
                                $tabla = new Tablas();
                                ?>
                                <div class="row">
                                    <div class="col-md-4">                                    

                                        <?php if (isset($_SESSION['guardarDatos'])) { ?>
                                            <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" maxlength="50" required value="<?php echo $_SESSION['guardarDatos'][4] ?>" />
                                        <?php } else {?>
                                            <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" maxlength="50" required />
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-2">

                                        <select type="text" id="nivel" name="nivel" class="custom-select form-control-sm " title="Selecciona" required>
                                            <?php if (isset($_SESSION['guardarDatos'])) { 
                                                if( $_SESSION['guardarDatos'][2] === "facil"){ ?>
                                                    <option value="facil" selected="selected"><?php echo trad('Principiante',$lang) ?></option>
                                                    <option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
                                                    <option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
                                            <?php } else if( $_SESSION['guardarDatos'][2] === "medio"){ ?>
                                                    <option value="facil"><?php echo trad('Principiante',$lang) ?></option>
                                                    <option value="medio" selected="selected"><?php echo trad('Intermedio',$lang) ?></option>
                                                    <option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
                                            <?php } else if( $_SESSION['guardarDatos'][2] === "dificil"){ ?>
                                                    <option value="facil"><?php echo trad('Principiante',$lang) ?></option>
                                                    <option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
                                                    <option value="dificil" selected="selected"><?php echo trad('Avanzado',$lang) ?></option>
                                            <?php } 
                                            }else { ?>
                                                <option value="facil"><?php echo trad('Principiante',$lang) ?></option>
                                                <option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
                                                <option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
                                            <?php   } ?>                
                                        </select>

                                    </div>
                                    <div class="col-md-3">

                                        <select type="text" id="categoria" name="categoria" class="custom-select form-control-sm " title="Selecciona" required>
                                            <?php 
                                                include_once '../inc/ejercicio.php';
                                                $ejer = new Ejercicio();
                                                $resultado = $ejer->getCategorias();
                                                foreach ($resultado as $key => $value) { 
                                                    $newKey = "c".($key+1);
                                                    if (isset($_SESSION['guardarDatos'])) {
                                                        if($newKey === $_SESSION['guardarDatos'][1]){ ?>
                                                            <option value=<?php echo $newKey ?> selected="selected"> <?php echo $value ?> </option>
                                                        <?php } else{ ?>
                                                            <option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
                                                        <?php } 
                                                    } else { ?>
                                                        <option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
                                                    <?php } 
                                                } ?> 
                                        </select>

                                    </div>
                                    <div class="col-md-2">

                                        <select type="text" id="deshabilitar" name="deshabilitar" class="custom-select form-control-sm" title="Selecciona" required>
                                            <?php if (isset($_SESSION['guardarDatos'])) { 
                                                if( intval($_SESSION['guardarDatos'][3]) === 0){ ?>
                                                    <option value="0" selected="selected"><?php echo trad('Habilitado',$lang) ?></option>
                                                    <option value="1"><?php echo trad('Deshabilitado',$lang) ?></option>
                                            <?php } else { ?>
                                                    <option value="0"><?php echo trad('Habilitado',$lang) ?></option>
                                                    <option value="1" selected="selected"><?php echo trad('Deshabilitado',$lang) ?></option>
                                            <?php }
                                            } else { ?>
                                                <option value="0"><?php echo trad('Habilitado',$lang) ?></option>
                                                <option value="1"><?php echo trad('Deshabilitado',$lang) ?></option>
                                            <?php } ?>
                                            
                                        </select>

                                    </div>

                                </div>

                            </div>
                            <div class="tab-pane fade mt-3 pl-4" id="nav-exercisesE" role="tabpanel" aria-labelledby="nav-exercisesE-tab">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong>Enunciado <span class="red"> *</span></strong></label>

                                        <?php if (isset($_SESSION['guardarDatos'])) { ?>
                                            <textarea  id="enunciado" name="enunciado" class="form-control" rows="10" required><?php echo $_SESSION['guardarDatos'][5] ?></textarea>
                                        <?php } else { ?>
                                            <textarea  id="enunciado" name="enunciado" class="form-control" rows="10" required></textarea>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>Solución <span class="red"> *</span></strong></label>
                                        <?php if (isset($_SESSION['guardarDatos'])) { ?>
                                            <textarea  id="solucion" name="solucion" class="form-control" rows="10" required><?php echo $_SESSION['guardarDatos'][6] ?></textarea>
                                        <?php }else { ?>
                                            <textarea  id="solucion" name="solucion" class="form-control" rows="10" required></textarea>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 offset-10">
                                    <button class="btn btn-primary pl-4 pr-4 mt-4" name="new_exercise" type="submit">Crear Ejercicio</button>
                                </div>
                            </div>
                            <div class="tab-pane fade mt-3 pl-4" id="nav-exercisesT" role="tabpanel" aria-labelledby="nav-exercisesT-tab">
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><strong>Creador Tablas <span class="red"> *</span></strong></label>
                                        <div class=" selector-user" >
                                            <select name="user_tablas" class=" custom-select form-control-sm" id="user_tablas" title="Selecciona" required>                                    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><strong>Información Tablas</strong></label>
                                        <div class=" selector-tabla" >
                                            <select type="text" id="tablas" name="tablas" class="custom-select form-control-sm">                                               
                                            </select>				  				 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><strong>Información Campos</strong></label>
                                        <!--<table id="columnas" class="form-control" size="2" ></table>-->
                                        <div class=" columnas-tabla" >
                                            <table id="columnas" class="form-control" ><tbody></tbody></table>				  				 
                                        </div>
                                    </div>
                                </div>
                            </div>
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
</div>
</section>
   
<?php include("footer.php"); ?> 
