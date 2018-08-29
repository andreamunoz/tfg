<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<div class="container-tabla pt-4">
    <label><a class="enlance" href="index.php" >Inicio </a> > <a class="enlance" href="configuration.php" > Configuración</a> </label>
    <h2><strong>Configuración</strong></h2>
    <p>Texto a añadir aquí...</p>
    <div class="row pt-4">   
        <a href="configuration_tables.php" class="col-md-3 configuration text-conf ">
            <img class="img_icon mb-3" src="../img/icon_tiposDocumentos.svg">
            <p><strong>Tablas</strong></p>
            <label class="cursor" for="name" >Edita las tablas y los campos que van a tener los ejercicios, pulsa aquí...</label>
        </a>
        <a href="configuration_sheets.php" class="col-md-3 configuration text-conf ">
            <img class="img_icon mb-3" src="../img/documentos.svg">
            <p><strong>Hojas de ejercicio</strong></p>
            <label class="cursor" for="name" >Edita las hojas de ejercicio, pulsa aquí...</label>
        </a>
        <a href="configuration_exercises.php" class="col-md-3 configuration text-conf">
            <img class="img_icon mb-3" src="../img/icon_LOPD.svg"> 
            <p><strong>Ejercicios</strong></p>
            <label class="cursor" for="name" >Edita los ejercicios, pulsa aquí...</label>
        </a>
        <a href="configuration_stadistics_exercises.php" class="col-md-3 configuration text-conf">
            <img class="img_icon mb-3" src="../img/grafico-de-barras.svg">
            <p><strong>Estadísticas</strong></p>
            <label class="cursor" for="name" >Ver las estadísticas de los alumnos, pulsa aquí...</label>
        </a>     
    </div>
    <div class="row mt-4"> 
        <a href="configuration_profile.php" class="col-md-3 configuration text-conf ">
            <img class="img_icon mb-3" src="../img/icon_usuarios.svg">
            <p><strong>Perfil</strong></p>
            <label class="cursor" for="name" >Edita tu perfil, pulsa aquí...</label>
        </a>       
    </div>

</div>

<?php include("footer.php"); ?>
