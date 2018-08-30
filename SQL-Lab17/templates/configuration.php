<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<div class="container-tabla pt-4">
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="configuration.php" > <?php echo trad('Configuración',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Configuración',$lang) ?></strong></h2>
    <p><?php echo trad('Texto a añadir aquí...',$lang) ?></p>
    <div class="row pt-4">   
        <a href="configuration_tables.php" class="col-md-3 configuration text-conf ">
            <img class="img_icon mb-3" src="../img/icon_tiposDocumentos.svg">
            <p><strong><?php echo trad('Tablas',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Edita las tablas y los campos que van a tener los ejercicios, pulsa aquí.',$lang) ?></label>
        </a>
        <a href="configuration_sheets.php" class="col-md-3 configuration text-conf ">
            <img class="img_icon mb-3" src="../img/documentos.svg">
            <p><strong><?php echo trad('Hojas de ejercicio',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Crea, edita y elimina las hojas de ejercicio, pulsa aquí.',$lang) ?></label>
        </a>
        <a href="configuration_exercises.php" class="col-md-3 configuration text-conf">
            <img class="img_icon mb-3" src="../img/icon_LOPD.svg"> 
            <p><strong><?php echo trad('Ejercicios',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Crea, edita y habilita o deshabilita los ejercicios, pulsa aquí.',$lang) ?></label>
        </a>
        <a href="configuration_stadistics_exercises.php" class="col-md-3 configuration text-conf">
            <img class="img_icon mb-3" src="../img/grafico-de-barras.svg">
            <p><strong><?php echo trad('Estadísticas',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Ver las estadísticas del profesor y de los alumnos, pulsa aquí.',$lang) ?></label>
        </a>     
    </div>
    <div class="row mt-4"> 
        <a href="profile.php" class="col-md-3 configuration text-conf ">
            <img class="img_icon mb-3" src="../img/icon_usuarios.svg">
            <p><strong><?php echo trad('Perfil',$lang) ?></strong></p>
            <label class="cursor" for="name" ><?php echo trad('Muestra y edita tu perfil, también puedes ver los resultados obtenidos, pulsa aquí.',$lang) ?></label>
        </a>       
    </div>

</div>

<?php include("footer.php"); ?>
