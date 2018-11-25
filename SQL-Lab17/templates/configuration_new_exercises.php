<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_exercises.php" > <?php echo trad('Ejercicios',$lang) ?></a> > <a class="enlace" href="configuration_new_exercises.php" > <?php echo trad('Nuevo Ejercicio',$lang) ?></a></label>
    <h2 id="userPrincipal" data-name="<?php echo $_SESSION['user']; ?>"><strong><?php echo trad('Nuevo Ejercicio',$lang) ?></strong></h2>
    <!-- <div class="row mb-5">
        <div class="col-md-12">
            <p><?php //echo trad('Añade un nuevo ejercicio a la lista.',$lang) ?></p>
        </div>
    </div>  --> 


    <section id="tabs">
        <div class="">
            <div class="row mt-5">
                <div class="col-md-12 ">
                    <form id="new_sheets" method="post" action="../handler/validate_new_exercises.php">
                            
                        <div class="row">
                            <div class="col-md-3">
                                <label><strong><?php echo trad('Creador Tablas',$lang) ?> <span class="red"> *</span></strong></label>
                                <div class=" selector-user" >
                                    <select name="user_tablas" class=" custom-select form-control-sm" id="user_tablas" title="<?php echo trad('Seleccionar',$lang) ?>" required>                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label><strong><?php echo trad('Información Tablas',$lang) ?></strong></label>
                                <div class=" selector-tabla" >
                                    <select type="text" id="tablas" name="tablas" class="custom-select form-control-sm">                                               
                                    </select>                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- <label><strong><?php //echo trad('Información Campos',$lang) ?></strong></label> -->
                                <div class="columnas-tabla" >
                                    <!-- <table id="columnas" class="form-control" ><tbody></tbody></table> -->
                                    <table id="structure_table"> <!-- class="table table-striped table-bordered">   -->
                                            <thead>
                                                
                                            </thead>
                                            <tbody style="border: 1px solid black">
                                                
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="name" ><strong><?php echo trad('Descripción',$lang) ?> <span class="red"> *</span></strong></label>
                                <?php if (isset($_SESSION['guardarDatos'])) { ?>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" maxlength="50" required value="<?php echo $_SESSION['guardarDatos'][4] ?>" />
                                <?php } else {?>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" maxlength="50" required />
                                <?php } ?>
                            </div>
                            <div class="col-md-2">
                                <label for="name" ><strong><?php echo trad('Nivel',$lang) ?> <span class="red"> *</span></strong></label>
                                <select type="text" id="nivel" name="nivel" class="custom-select form-control-sm " title="Selecciona" required>
                                    <?php if (isset($_SESSION['guardarDatos'])) { 
                                        if( $_SESSION['guardarDatos'][2] === "Principiante"){ ?>
                                            <option value="Principiante" selected="selected"><?php echo trad('Principiante',$lang) ?></option>
                                            <option value="Intermedio"><?php echo trad('Intermedio',$lang) ?></option>
                                            <option value="Avanzado"><?php echo trad('Avanzado',$lang) ?></option>
                                    <?php } else if( $_SESSION['guardarDatos'][2] === "Intermedio"){ ?>
                                            <option value="Principiante"><?php echo trad('Principiante',$lang) ?></option>
                                            <option value="Intermedio" selected="selected"><?php echo trad('Intermedio',$lang) ?></option>
                                            <option value="Avanzado"><?php echo trad('Avanzado',$lang) ?></option>
                                    <?php } else if( $_SESSION['guardarDatos'][2] === "Avanzado"){ ?>
                                            <option value="Principiante"><?php echo trad('Principiante',$lang) ?></option>
                                            <option value="Intermedio"><?php echo trad('Intermedio',$lang) ?></option>
                                            <option value="Avanzado" selected="selected"><?php echo trad('Avanzado',$lang) ?></option>
                                    <?php } 
                                    }else { ?>
                                        <option value="Principiante"><?php echo trad('Principiante',$lang) ?></option>
                                        <option value="Intermedio"><?php echo trad('Intermedio',$lang) ?></option>
                                        <option value="Avanzado"><?php echo trad('Avanzado',$lang) ?></option>
                                    <?php   } ?>                
                                </select>                                    
                            </div>
                            <div class="col-md-3">
                                <label for="name" ><strong><?php echo trad('Categoría',$lang) ?> <span class="red"> *</span></strong></label>
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
                                <label for="name" ><strong><?php echo trad('Vista',$lang) ?> <span class="red"> *</span></strong></label>
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

                        <div class="row">
                            <div class="col-md-6">
                                <label><strong><?php echo trad('Enunciado',$lang) ?> <span class="red"> *</span></strong></label>

                                <?php if (isset($_SESSION['guardarDatos'])) { ?>
                                    <textarea  id="enunciado" name="enunciado" class="form-control" rows="10" required><?php echo $_SESSION['guardarDatos'][5] ?></textarea>
                                <?php } else { ?>
                                    <textarea  id="enunciado" name="enunciado" class="form-control" rows="10" required></textarea>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <label><strong><?php echo trad('Solución',$lang) ?> <span class="red"> *</span></strong></label>
                                <?php if (isset($_SESSION['guardarDatos'])) { ?>
                                    <textarea  id="solucion" name="solucion" class="form-control" rows="10" required><?php echo $_SESSION['guardarDatos'][6] ?></textarea>
                                <?php }else { ?>
                                    <textarea  id="solucion" name="solucion" class="form-control" rows="10" required></textarea>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-150">
                            <div class="offset-md-10 col-md-2">
                                <div class="form-group text-right">
                                    <button class="btn btn-primary pl-3 pr-3 mt-5 mb-3" name="new_exercise" type="submit"><?php echo trad('Crear Ejercicio',$lang) ?></button>
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
    </section>
</div>

   
<?php include("footer.php"); ?> 
