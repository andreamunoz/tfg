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
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_exercises.php" > <?php echo trad('Ejercicios',$lang) ?></a> > <a class="enlace" href="configuration_edit_exercises.php?exercise=<?php echo $id_ejer ?>" > <?php echo trad('Editar Ejercicio',$lang) ?></a></label>
    <h2 id="userPrincipal" data-name="<?php echo $_SESSION['user']; ?>"><strong><?php echo trad('Editar Ejercicio',$lang) ?> | <?php echo $des ?></strong></h2>
    <!-- <div class="row mb-5">
        <div class="col-md-12">
            <p><?php echo trad('Edite el ejercicio cambiando los cambios que necesites.',$lang) ?></p>
        </div>
    </div>  --> 
    <section id="tabs">
        <div class="">
            <div class="row mt-5">
                <div class="col-md-12 ">
                    <form id="new_sheets" method="post" action="../handler/validate_edit_exercises.php?exercise=<?php echo $id_ejer ?>">
                        
                        
                                <?php
                                $tabla = new Tablas();
                                $ejercicioId = $ejer->getEjercicioById($id_ejer);
                                $_SESSION['user_tablas'] = $ejercicioId['dueño_tablas'];
                                ?>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label><strong><?php echo trad('Creador Tablas',$lang) ?></strong></label>
                                        <div class=" selector-user-edit" >
                                            <select class=" custom-select form-control-sm" id="user_tablas" name="user_tablas" title="Selecciona" disabled>
                                                <option value="<?php echo $ejercicioId['dueño_tablas']?>" selected="selected">
                                                    <?php echo $ejercicioId['dueño_tablas']?>    
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label><strong><?php echo trad('Información Tablas',$lang) ?></strong></label>
                                        <div class=" selector-tabla" >
                                            <select type="text" id="tablas" name="tablas" class="custom-select form-control-sm">
                                            </select>                                
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label><strong><?php echo trad('Información Campos',$lang) ?></strong></label>
                                        <div class=" columnas-tabla" >
                                            <table id="columnas" class="form-control"><tbody></tbody></table>                                                             
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="name" ><strong><?php echo trad('Descripción',$lang) ?> <span class="red"> *</span></strong></label>                                    
                                        <input type="text" id="descripcion" name="descripcion" value="<?php echo $ejercicioId['descripcion'] ?>" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong><?php echo trad('Nivel',$lang) ?><span class="red"> *</span></strong></label> 
                                        <select name="nivel" class="custom-select form-control-sm " title="Selecciona" id="nivel">
                                            <?php
                                            $niveles = array("facil","medio","dificil");
                                            for ($i=0; $i < count($niveles); $i++) { 
                                                                                          
                                                var_dump($niveles[$i]);
                                                if ($ejercicioId['nivel'] === $niveles[$i]){                                                   
                                                    echo "<option value=".$niveles[$i]." selected>".$niveles[$i]." </option>";
                                                } else {
                                                    echo "<option value=".$niveles[$i]." >".$niveles[$i]." </option>";
                                                }
                                            }   
                                            ?>              
                                        </select>                                        
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" ><strong><?php echo trad('Categoría',$lang) ?><span class="red"> *</span></strong></label>
                                        <select name="categoria" class="custom-select form-control-sm " title="Selecciona" id="categoria">
                                            <?php
                                            //$categorias = $ejer->getAllCategorias();
                                            //while ($categoria = mysqli_fetch_array($categorias)) {

                                                //if($ejercicioId['tipo'] == $categoria['tipo'])
                                                    //echo "<option value=" . $categoria['tipo'] . " selected>" . $categoria['tipo'] . " </option>";
                                                //else
                                                    //echo "<option value='" . $categoria['tipo'] . "' >" . $categoria['tipo'] . " </option>";                      
                                            //}
                                            ?>
                                             <?php 
                                                include_once '../inc/ejercicio.php';
                                                $ejer = new Ejercicio();
                                                $resultado = $ejer->getCategorias();
                                                var_dump($ejercicioId);
                                                var_dump("----------------");
                                                var_dump($resultado);
                                                foreach ($resultado as $key => $value) { 
                                                    $newKey = "c".($key+1);
                                                   
                                                    if($value === $ejercicioId['tipo']){ ?>
                                                        <option value=<?php echo $newKey ?> selected="selected"> <?php echo $value ?> </option>
                                                    <?php } else{ ?>
                                                        <option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
                                                    <?php } 
                                                    
                                                } ?> 

                                        </select> 
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" ><strong><?php echo trad('Vista',$lang) ?> <span class="red"> *</span></strong></label> 
                                        <select name="habdes" class="custom-select form-control-sm " title="Selecciona" id="select_habilitar">
                                            <?php if($ejercicioId['deshabilitar'] == 1){?>
                                                    <option value="1" selected=''><?php echo trad('Deshabilitado',$lang) ?></option>
                                                    <option value="0" ><?php echo trad('Habilitado',$lang) ?></option>
                                            <?php }else{ ?>
                                                    <option value="1" ><?php echo trad('Deshabilitado',$lang) ?></option>
                                                    <option value="0" selected=''><?php echo trad('Habilitado',$lang) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong><?php echo trad('Enunciado',$lang) ?> <span class="red"> *</span></strong></label>
                                        <textarea id="enunciado" name="enunciado" class="form-control" rows="10" required="" ><?php echo $ejercicioId['enunciado'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong><?php echo trad('Solución',$lang) ?> <span class="red"> *</span></strong></label>
                                        <textarea id="solucion" name="solucion" class="form-control" rows="10" required=""><?php echo $ejercicioId['solucion'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-150">
                                    <div class="offset-md-10 col-md-2">
                                        <div class="form-group text-right">
                                            <button class="btn btn-primary pl-3 pr-3 mt-5 mb-3" name="new_exercise" type="submit"><?php echo trad('Actualizar Ejercicio',$lang) ?></button>
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
