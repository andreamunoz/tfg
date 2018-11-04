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
    <div id="accordion" class="col-md-2 pr-1 float-right">
        <div class="card">  
            <div class="table-responsive line-left">                
                <table id="employee" class="table table-striped-config table-bordered cambio-cabecera"> 
                    <thead>
                        <tr>
                            <th style="width:10%;"><?php echo trad('Nivel', $lang).":" ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <td > <?php echo $ejercicioId['nivel']; ?> </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="accordion" class="col-md-3 pr-1 float-right">
        <div class="card">  
            <div class="table-responsive line-left">                
                <table id="employee" class="table table-striped-config table-bordered cambio-cabecera"> 
                    <thead>
                        <tr>
                            <th style="width:20%;"><?php echo trad('Tipo', $lang).":" ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <td> <?php echo $ejercicioId['tipo']; ?> </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="accordion" class="col-md-3 pr-1 float-right">
        <div class="card">  
            <div class="table-responsive line-left">                
                <table id="employee" class="table table-striped-config table-bordered cambio-cabecera"> 
                    <thead>
                        <tr>
                            <th style="width:20%"><?php echo trad('Descripción', $lang).":" ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <td > <?php echo $ejercicioId['descripcion']; ?> </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8 pr-1 float-right" id="accordion">
        <div class="card">  
            <div class="table-responsive line-left">                
                <table id="employee" class="table table-striped-config table-bordered cambio-cabecera"> 
                    <thead>
                        <tr>
                            <th style="width:20%;"><?php echo trad('Enunciado', $lang).":" ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                    <td> <?php echo $ejercicioId['enunciado']; ?> </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8 pr-1 float-right" id="accordion ">
        <div class="card">  
            <div class="table-responsive line-left">                
                <table id="employee" class="table table-striped-config table-bordered cambio-cabecera"> 
                    <thead>
                        <tr>
                            <th style="width:20%;"><?php echo trad('Solución', $lang).":" ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                    <td > <?php echo $ejercicioId['solucion'] ?> </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4 pr-4" id="accordion ">
        <div class="card">  
            <div class="table-responsive line-left">                
                <table id="employee_table_hoja" class="table table-striped-config table-bordered cambio-cabecera"> 
                    <thead>
                        <tr>
                            <th><?php echo trad('Tablas', $lang).":"?><p id="small"> <?php echo '('.trad('Pulsa cada tabla para ver sus campos', $lang).')'; ?> </p></th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $usa = new Usa();
                        $nombre_tablas = $usa->getNombreById($id_ejer);
                        $cont = 0;
                        while ($nameTable = mysqli_fetch_array($nombre_tablas)) {
                            ?>
                            <tr>
                                <?php
                                $arrayTablas[$cont] = $nameTable['nombre'];
                                $cont = $cont + 1;
                                $quitar = $nameTable['schema_prof'] . "_";
                                $onlyName = explode($quitar, $nameTable['nombre']);
                                ?>
                                <td class="addFields" data-name="<?php echo $nameTable["nombre"]?>" > <?php echo $onlyName[1]; ?> </td>
                            </tr>    
                        <?php } ?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4 pr-4" id="accordion ">
        <div class="card">  
            <div class="table-responsive line-left">                
                <table id="employee-fields" class="table table-striped-config table-bordered cambio-cabecera"> 
                    <thead>
                        <tr>
                            <th><?php echo trad('Campos', $lang).":" ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?> 
