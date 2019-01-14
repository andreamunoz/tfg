<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<?php unset($_SESSION['select_p']); unset($_SESSION['select_n']); unset($_SESSION['select_t']); unset($_SESSION['value_cab']); unset($_SESSION['select_cab']); $_SESSION['showNumber']="";?>
<div class="container-tabla pt-4">
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="configuration.php" > <?php echo trad('Modo Profesor',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Modo Profesor',$lang) ?></strong></h2>
    <p><?php echo trad('En esta página encontrarás los enlaces para realizar la funcionalidad propia del profesor.<br>Podrás acceder a la gestión de las tablas, a la gestión de las hojas de ejercicios, a la gestión de los ejercicios, a unas estadísticas específicas y a su perfil.',$lang) ?></p>
    <div class="row pt-5">   
        <a href="configuration_tables.php" class="col-md-3 configuration text-conf ">
            <img class="img_icon mb-3" src="../img/icon_tiposDocumentos.svg">
            <p><strong><?php echo trad('Gestionar Tablas',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Edita las tablas y los campos que van a tener los ejercicios, pulsa aquí.',$lang) ?></label>
        </a>
        <a href="configuration_exercises.php" class="col-md-3 configuration text-conf">
            <img class="img_icon mb-3" src="../img/icon_LOPD.svg"> 
            <p><strong><?php echo trad('Gestionar Ejercicios',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Crea, edita y habilita o deshabilita los ejercicios, pulsa aquí.',$lang) ?></label>
        </a>
        <a href="configuration_sheets.php" class="col-md-3 configuration text-conf ">
            <img class="img_icon mb-3" src="../img/documentos.svg">
            <p><strong><?php echo trad('Gestionar Hojas de Ejercicio',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Crea, edita y elimina las hojas de ejercicio, pulsa aquí.',$lang) ?></label>
        </a>
        <a href="configuration_stadistics_exercises.php" class="col-md-3 configuration text-conf">
            <img class="img_icon mb-3" src="../img/grafico-de-barras.svg">
            <p><strong><?php echo trad('Estadísticas',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Ver las estadísticas del profesor y de los alumnos, pulsa aquí.',$lang) ?></label>
        </a>     
    </div>
</div>

<?php include("footer.php"); ?>
