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
    $hojaparameter = $_SESSION['HOJA_VISTA'];
    $nombreHoja = $_SESSION['HOJA_VISTA_NOMBRE'];
    if($_SESSION['HOJA_EXE']== 0){
    ?>
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor', $lang) ?> </a> > <a class="enlace" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios', $lang) ?></a> > <a class="enlance" href="configuration_show_sheet.php?hoja=<?php echo $hojaparameter ?>" ><?php echo $nombreHoja ?></a> > <a class="enlace" href="configuration_show_exercises.php?exercise=<?php echo $id_ejer ?>" > <?php echo trad('Ver Ejercicio', $lang) ?></a></label>
    <?php } else{ ?>
        <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor', $lang) ?> </a> > <a class="enlace" href="configuration_exercises.php" > <?php echo trad('Ejercicios', $lang) ?></a> > <a class="enlace" href="configuration_show_exercises.php?exercise=<?php echo $id_ejer ?>" > <?php echo trad('Ver Ejercicio', $lang) ?></a></label>
    <?php } ?>
    <h2><strong><?php echo trad('Ver Ejercicio', $lang) ?> | <?php echo $des ?></strong></h2>
    <div class="row mb-5">
        <?php
        $tabla = new Tablas();
        $ejercicioId = $ejer->getEjercicioById($id_ejer);
        $dueño = $ejercicioId['dueño_tablas'];
        $tab = $tabla->getTablasByProfesor($dueño);
        ?>
        <div class="col-md-10">
            <p><?php echo trad('Muestra el ejercicio con todos sus campos que se encuentran en la BBDD.', $lang) ?></p>
        </div>
    </div> 
    <div class="row mt-5">
        <div class="col-md-12 ">
            <div class="row">
                <!-- <div class="col-md-4">
                    <label><strong><?php echo trad('Creador Tablas',$lang) ?> <span class="red"> *</span></strong></label>
                    <div class=" selector-user" >
                        <table id="columnas" class="form-control" ><tbody></tbody></table>
                                            
                    </div>
                </div> -->
                <div class="col-md-4">
                    <label><strong><?php echo trad('Tablas',$lang) ?></strong></label>
                    <div class="selector-tabla-show" >
                        <select type="text" name="tablas" class="custom-select form-control-sm"> 
                            <option value="">Selecciona Tabla</option>
                        <?php 
                            $usa = new Usa();
                            $nombre_tablas = $usa->getNombreById($id_ejer);
                            while ($nameTable = mysqli_fetch_array($nombre_tablas)) {
                            
                                $quitar = $nameTable['schema_prof'] . "_";
                                $onlyName = explode($quitar, $nameTable['nombre']);
                                
                                echo "<option value='".$nameTable['nombre']."'>".$onlyName[1]."</option>"; 
                              
                            }
                         ?>
                        </select>                               
                    </div>
                </div>
                <div class="col-md-4">
                    <label><strong><?php echo trad('Campos',$lang) ?></strong></label>
                    <div class="columnas-tabla-show" >
                        <table id="columnas" class="form-control" ><tbody></tbody></table>                               
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-5">
                    <label for="name" ><strong><?php echo trad('Descripción',$lang) ?> </strong></label>
                    <table class="form-control">
                        <tbody>
                            <tr><td> <?php echo $ejercicioId['descripcion']; ?> </td></tr>
                        </tbody>
                    </table> 
                </div>
                <div class="col-md-2">
                    <label for="name" ><strong><?php echo trad('Nivel',$lang) ?></strong></label>
                    <table class="form-control">
                        <tbody>
                            <tr><td> <?php echo $ejercicioId['nivel']; ?> </td></tr>
                        </tbody>
                    </table>                                
                </div>
                <div class="col-md-3">
                    <label for="name" ><strong><?php echo trad('Categoría',$lang) ?></strong></label>
                    <table class="form-control">
                        <tbody>
                            <tr><td> <?php echo $ejercicioId['tipo']; ?> </td></tr>
                        </tbody>
                    </table>          
                </div>
                <div class="col-md-2">
                    <label for="name" ><strong><?php echo trad('Vista',$lang) ?></strong></label>
                    <table class="form-control">
                        <tbody>
                            <tr><td> 
                                <?php if (!$ejercicioId['deshabilitar']){ 
                                        echo trad("Habilitado", $lang);
                                    } else {
                                        echo trad("Deshabilitado", $lang);
                                    } ?> 
                            </td></tr>
                        </tbody>
                    </table>            
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <label><strong><?php echo trad('Enunciado',$lang) ?></strong></label>
                    <table class="form-control">
                        <tbody>
                            <tr><td style="padding-bottom: 25px"> <?php echo $ejercicioId['enunciado']; ?> </td></tr>
                        </tbody>
                    </table>
                    
                </div>
                <div class="col-md-6">
                    <label><strong><?php echo trad('Solución',$lang) ?> </strong></label>
                    <table class="form-control">
                        <tbody>
                            <tr><td style="padding-bottom: 25px"> <?php echo $ejercicioId['solucion']; ?> </td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?> 
