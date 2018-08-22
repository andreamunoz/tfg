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
    <div class="hrr mb-5"></div>
    <div class="row">
        <div class="col-md-3 configuration">
            <a href="configuration_tables.php" class="text-conf ">
                <img class="img_icon mb-3" src="../img/icon_tiposDocumentos.svg">
                <p><strong>Tablas</strong></p>
                <label for="name" >Edita las tablas y los campos que van a tener los ejercicios, pulsa aquí...</label>
            </a>
        </div>
        <div class="col-md-3 configuration">
            <a href="configuration_sheets.php" class="text-conf ">
                <img class="img_icon mb-3" src="../img/icon_tiposDocumentos.svg">
                <p><strong>Hojas de ejercicio</strong></p>
                <label for="name" >Edita las hojas de ejercicio, pulsa aquí...</label>
            </a>
        </div>
        <div class="col-md-3 configuration">
            <a href="configuration_exercises.php" class="text-conf">
                <img class="img_icon mb-3" src="../img/icon_LOPD.svg"> 
                <p><strong>Ejercicios</strong></p>
                <label for="name" >Edita los ejercicios, pulsa aquí...</label>
            </a>
        </div>
        <div class="col-md-3 configuration">
            <a href="stadistics_exercises.php" class="text-conf">
                <img class="img_icon mb-3" src="../img/icon_LOPD.svg">
                <p><strong>Estadísticas</strong></p>
                <label for="name" >Ver las estadísticas de los alumnos, pulsa aquí...</label>
            </a>
        </div>
        
    </div>
    <div class="row mt-4">
        <div class="col-md-3 configuration">
            <a href="profile.php" class="text-conf ">
                <img class="img_icon mb-3" src="../img/icon_usuarios.svg">
                <p><strong>Perfil</strong></p>
                <label for="name" >Edita tu perfil, pulsa aquí...</label>
            </a>
        </div>
    </div>

</div>

<?php include("footer.php"); ?>
