<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<?php 
//variables-sesion: exercises
unset($_SESSION['select_p']); unset($_SESSION['select_n']); unset($_SESSION['select_t']); unset($_SESSION['value_cab']); unset($_SESSION['select_cab']); $_SESSION['showNumber']=""; 
//variables-sesion: hoja
unset($_SESSION['select_p_h']); unset($_SESSION['select_cab_h']); unset($_SESSION['value_cab_h']); $_SESSION['showNumber_h']=""; 
//variables-sesion: ver hoja
unset($_SESSION['select_p_verh']); unset($_SESSION['select_n_verh']);unset($_SESSION['select_t_verh']); unset($_SESSION['value_cab_verh']); unset($_SESSION['select_cab_verh']); $_SESSION['showNumber_verh']="";
?>
<div class="container-tabla pt-4 pb-5">
    <label><?php if($_SESSION['rol']==1 || $_SESSION['modo']==0){ ?><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang);?> </a><?php }else {?><a class="enlance" href="configuration.php" ><?php echo trad('Modo Profesor',$lang)?> </a><?php } ?> > <a class="enlance" href="help.php" > <?php echo trad('Ayuda',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Ayuda', $lang) ?></strong></h2>
    <p><?php echo trad('Texto a añadir aquí...', $lang) ?></p>    

    <div id="accordion">
        <div class="card">
            <div class="card-header text-right" id="headingOne">
                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <?php echo trad('Gestionar Tablas', $lang) ?>
                </a>
                <i class="fas fa-plus"></i>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p class="pl-5">+ <strong><i><?php echo trad('Crear Tabla', $lang) ?>:</i></strong> <?php echo trad('Añade la consulta para Crear/Update/Drop a la tabla.', $lang) ?> </p>
                    <p class="pl-5">+ <strong><i><?php echo trad('Ver detalles', $lang) ?>:</i></strong></p>
                    <p class="pl-5"><strong><?php echo trad('Estructura', $lang) ?> </strong><?php echo trad('(Puede ver las columnas que tiene la tabla y el tipo al que corresponde dicho campo)', $lang) ?></p>
                    <p class="pl-5"><strong><?php echo trad('Datos', $lang) ?> </strong><?php echo trad('(Puede ver el contenido que tienen los campos de esa tabla)', $lang) ?></p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-right" id="headingTwo">
                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <?php echo trad('Gestionar Ejercicios', $lang) ?>
                </a>
                <i class="fas fa-plus"></i>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <p class="pl-5">+ <strong><i><?php echo trad('Crear ejercicio', $lang) ?>:</i></strong> <?php echo trad('Rellene el nombre y selecciona el nivel, categoría y la vista, después añade las tablas que se usarán en el ejercicio y añade su enunciado y solución.', $lang) ?> </p>
                    <p class="pl-5">+ <strong><i><?php echo trad('Mostrar', $lang) ?>:</i></strong> <?php echo trad('Muestra el ejercicio, solo podrá visualizarlo no realizarlo.', $lang) ?></p>
                    <p class="pl-5">+ <strong><i><?php echo trad('Editar', $lang) ?>:</i></strong> <?php echo trad('Cambie el nombre y selecciona el nivel, categoría y la vista, puede cambiar tambien las tablas que se usarán en el ejercicio y cambie su enunciado y solución.', $lang) ?></p>
                    <p class="pl-5">+ <strong><i><?php echo trad('Habilitar', $lang) ?>/<?php echo trad('Deshabilitar', $lang) ?>:</i></strong> <?php echo trad('Habilite un ejercicio para poder solucionarlo / Deshabilite un ejercicio para que no se pueda solucionar.', $lang) ?> </p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-right" id="headingThree">
                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <?php echo trad('Gestionar Hoja de Ejercicios', $lang) ?>
                </a>
                <i class="fas fa-plus"></i>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <p class="pl-5">+ <strong><i><?php echo trad('Crear Hoja', $lang) ?>:</i></strong> <?php echo trad('Ponle el nombre a la hoja y seleccione los ejercicios que quiere añadir.', $lang) ?> </p>
                    <p class="pl-5">+ <strong><i><?php echo trad('Editar', $lang) ?>:</i></strong> <?php echo trad('Cambie el nombre a la hoja o bien cambie los ejercicios seleccionados por otros.', $lang) ?></p>                           
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-right" id="headingFour">
                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <?php echo trad('Gestionar Estadísticas', $lang) ?>
                </a>
                <i class="fas fa-plus"></i>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                    <p class="pl-5">+ <strong><i><?php echo trad('Primer Select', $lang) ?>:</i></strong> <?php echo trad('Muestra las estadísticas por profesor (conectado) y por alumnos en referencia al nivel o categoría.', $lang) ?> </p>
                    <p class="pl-5">+ <strong><i><?php echo trad('Segundo Select', $lang) ?>:</i></strong> <?php echo trad('Muestra las estadísticas en función del Nivel o Categoría de los ejercicios según el usuario seleccionado.', $lang) ?></p>                          
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?> 
