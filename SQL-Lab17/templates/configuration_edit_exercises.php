<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php 
    include_once '../inc/ejercicio.php';
    include_once '../inc/tablas.php';
    include_once '../inc/usa.php';
    $ejer = new Ejercicio();
    $id_ejer = $_GET['exercise'];
    $des = $ejer->getDescripcionEjercicio($id_ejer);
    if(isset($_SESSION['guardarDatosEditar'])){
        if($_SESSION['guardarDatosEditar'][7] !== $id_ejer){
            unset($_SESSION['guardarDatosEditar']);
        }
    }    


    ?>
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_exercises.php" > <?php echo trad('Ejercicios',$lang) ?></a> > <a class="enlace" href="configuration_edit_exercises.php?exercise=<?php echo $id_ejer ?>" > <?php echo trad('Editar Ejercicio',$lang) ?></a></label>
    <h2 id="userPrincipal" data-name="<?php echo $_SESSION['user']; ?>"><strong><?php echo trad('Editar Ejercicio',$lang) ?> | <?php echo $des ?></strong></h2>
    <!-- <div class="row mb-5">
        <div class="col-md-12">
            <p><?php //echo trad('Edite el ejercicio cambiando los cambios que necesites.',$lang) ?></p>
        </div>
    </div>  -->
    <section id="tabs">
        <div class="">
            <div class="row mt-5">
                <div class="col-md-12 ">
                    <form id="new_sheets" method="post" action="../handler/validate_edit_exercises.php?exercise=<?php echo $id_ejer ?>">

                                <div class="row">
                                    <div class="offset-md-10 col-md-2">
                                        <div class="form-group text-right">
                                            <button class="btn btn-primary pl-3 pr-3 mt-1 mb-3" name="new_exercise" type="submit"><?php echo trad('Actualizar Ejercicio',$lang) ?></button>
                                        </div>
                                    </div>
                                </div>
                        
                                <?php
                                $tabla = new Tablas();
                                $ejercicioId = $ejer->getEjercicioById($id_ejer);
                                $_SESSION['user_tablas'] = $ejercicioId['dueño_tablas'];
                                ?>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label><strong><?php echo trad('Creador Tablas',$lang) ?></strong></label>
                                        <div class=" selector-user-edit" >
                                            <select class=" custom-select form-control-sm" id="user_tablas" name="user_tablas" title="Selecciona" disabled>
                                                <option value="<?php echo $ejercicioId['dueño_tablas']?>" selected="selected">
                                                    <?php 
                                                    $nombreCompleto = $ejer->getNombreYApellidos($ejercicioId['dueño_tablas']);
                                                    echo $nombreCompleto["nombre"]." ".$nombreCompleto["apellidos"];
                                                    ?>  

                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label><strong><?php echo trad('Información Tablas',$lang) ?></strong></label>
                                        <div class=" sel-tab-show" >
                                            <select type="text" id="tablas" name="tablas" class="custom-select form-control-sm">
                                                <option value="">Selecciona Tabla</option>
                                                <?php 
                                                    
                                                    $nombre_tablas = $tabla->getTablasByProfesor($ejercicioId['dueño_tablas']);
                                                    while ($nameTable = mysqli_fetch_array($nombre_tablas)) {
                                                    
                                                        $quitar = $ejercicioId['dueño_tablas'] . "_";
                                                        $onlyName = explode($quitar, $nameTable['nombre']);
                                                        
                                                        echo "<option value='".$nameTable['nombre']."'>".$onlyName[1]."</option>"; 
                                                      
                                                    }
                                                ?> -->
                                            </select>                                
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" col-tab-show" >
                                            <table id="structure_table" class="">
                                                <thead class="light-style">
                                                
                                                </thead>
                                                <tbody class="body-tablas-style">

                                                </tbody>
                                            </table>                                                             
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="name" ><strong><?php echo trad('Descripción',$lang) ?> <span class="red"> *</span></strong></label>
                                        <?php if (isset($_SESSION['guardarDatosEditar'])) { ?>
                                            <input type="text" id="descripcion" name="descripcion" maxlength="50" value="<?php echo $_SESSION['guardarDatosEditar'][4] ?>" class="form-control form-control-sm" required>
                                        <?php } else { ?>             
                                            <input type="text" id="descripcion" name="descripcion" maxlength="50" value="<?php echo $ejercicioId['descripcion'] ?>" class="form-control form-control-sm" required>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong><?php echo trad('Nivel',$lang) ?><span class="red"> *</span></strong></label> 
                                        <select name="nivel" class="custom-select form-control-sm " title="Selecciona" id="nivel">
                                            <?php if (isset($_SESSION['guardarDatosEditar'])) { 
                                                    if( $_SESSION['guardarDatosEditar'][2] === "Principiante"){ ?>
                                                        <option value="Principiante" selected="selected"><?php echo trad('Principiante',$lang) ?></option>
                                                        <option value="Intermedio"><?php echo trad('Intermedio',$lang) ?></option>
                                                        <option value="Avanzado"><?php echo trad('Avanzado',$lang) ?></option>
                                                <?php } else if( $_SESSION['guardarDatosEditar'][2] === "Intermedio"){ ?>
                                                        <option value="Principiante"><?php echo trad('Principiante',$lang) ?></option>
                                                        <option value="Intermedio" selected="selected"><?php echo trad('Intermedio',$lang) ?></option>
                                                        <option value="Avanzado"><?php echo trad('Avanzado',$lang) ?></option>
                                                <?php } else if( $_SESSION['guardarDatosEditar'][2] === "Avanzado"){ ?>
                                                        <option value="Principiante"><?php echo trad('Principiante',$lang) ?></option>
                                                        <option value="Intermedio"><?php echo trad('Intermedio',$lang) ?></option>
                                                        <option value="Avanzado" selected="selected"><?php echo trad('Avanzado',$lang) ?></option>


                                               <?php } ?>
                                            
                                            <?php } else { ?>
                                                <?php
                                                $niveles = array("Principiante","Intermedio","Avanzado");
                                                for ($i=0; $i < count($niveles); $i++) { 
                                                                                              
                                                    var_dump($niveles[$i]);
                                                    if ($ejercicioId['nivel'] === $niveles[$i]){                                                   
                                                        echo "<option value=".$niveles[$i]." selected>".$niveles[$i]." </option>";
                                                    } else {
                                                        echo "<option value=".$niveles[$i]." >".$niveles[$i]." </option>";
                                                    }
                                                }   
                                                ?> 
                                            <?php } ?>             
                                        </select>                                        
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" ><strong><?php echo trad('Categoría',$lang) ?><span class="red"> *</span></strong></label>
                                        <select name="categoria" class="custom-select form-control-sm " title="Selecciona" id="categoria">
                                             <?php 
                                                include_once '../inc/ejercicio.php';
                                                $ejer = new Ejercicio();
                                                $resultado = $ejer->getCategorias();
                                                foreach ($resultado as $key => $value) { 
                                                    $newKey = "c".($key+1);
                                                    if (isset($_SESSION['guardarDatosEditar'])) {
                                                        if($newKey === $_SESSION['guardarDatosEditar'][1]){ ?>
                                                            <option value=<?php echo $newKey ?> selected="selected"> <?php echo $value ?> </option>
                                                        <?php } else{ ?>
                                                            <option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
                                                        <?php } 
                                                    } else { 
                                                        if($value === $ejercicioId['tipo']){ ?>
                                                            <option value=<?php echo $newKey ?> selected="selected"> <?php echo $value ?> </option>
                                                        <?php } else{ ?>
                                                        <option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
                                                    <?php }
                                                    } 
                                                } ?> 

                                        </select> 
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong><?php echo trad('Vista',$lang) ?> <span class="red"> *</span></strong></label> 
                                        <select name="habdes" class="custom-select form-control-sm " title="Selecciona" id="select_habilitar">

                                            <?php if (isset($_SESSION['guardarDatosEditar'])) {
                                                if($_SESSION['guardarDatosEditar'][3] == 1){?>
                                                    <option value="1" selected=''><?php echo trad('Deshabilitado',$lang) ?></option>
                                                    <option value="0" ><?php echo trad('Habilitado',$lang) ?></option>
                                                <?php }else{ ?>
                                                    <option value="1" ><?php echo trad('Deshabilitado',$lang) ?></option>
                                                    <option value="0" selected=''><?php echo trad('Habilitado',$lang) ?></option>
                                                <?php }
                                            }else{
                                                if($ejercicioId['deshabilitar'] == 1){?>
                                                    <option value="1" selected=''><?php echo trad('Deshabilitado',$lang) ?></option>
                                                    <option value="0" ><?php echo trad('Habilitado',$lang) ?></option>
                                                <?php }else{ ?>
                                                    <option value="1" ><?php echo trad('Deshabilitado',$lang) ?></option>
                                                    <option value="0" selected=''><?php echo trad('Habilitado',$lang) ?></option>
                                                <?php } 
                                            } ?>
                                            
                                        </select>
                                    </div>

                                </div>

                                <div class="row  mb-150">
                                    <div class="col-md-6">
                                        <label><strong><?php echo trad('Enunciado',$lang) ?> <span class="red"> *</span></strong></label>
                                        <?php if (isset($_SESSION['guardarDatosEditar'])) { ?>
                                            <textarea maxlength="300" id="enunciado" name="enunciado" class="form-control" rows="10" required="" ><?php echo $_SESSION['guardarDatosEditar'][5] ?></textarea>
                                        <?php }else{ ?>
                                            <textarea maxlength="300" id="enunciado" name="enunciado" class="form-control" rows="10" required="" ><?php echo $ejercicioId['enunciado'] ?></textarea>

                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong><?php echo trad('Solución',$lang) ?> <span class="red"> *</span></strong></label>
                                        <?php if (isset($_SESSION['guardarDatosEditar'])) { ?>
                                            <textarea maxlength="300" id="solucion" name="solucion" class="form-control" rows="10" required=""><?php echo $_SESSION['guardarDatosEditar'][6] ?></textarea>
                                        <?php }else{ ?>
                                            <textarea maxlength="300" id="solucion" name="solucion" class="form-control" rows="10" required=""><?php echo $ejercicioId['solucion'] ?></textarea>
                                        <?php } ?>
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
