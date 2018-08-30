<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<img class="img_perfil" src="../img/img_perfil.jpeg"> 
<div class="container contenedor-perfil pt-4">
    <?php
    include_once '../inc/ejercicio.php';
    include_once '../inc/tablas.php';
    $ejer = new Ejercicio();
    ?>
    <label><a class="enlance" href="configuration.php" >Configuración </a> > <a class="enlance" href="configuration_profile.php" > Perfil</a> </label>
    <h2><strong>Perfil</strong></h2>
    <div class="row mb-150">
        <div class="col-md-8">
            <p>Muestra los datos personales, puedes editar algunos campos y ver una tabla según tus ejercicios realizados...</p>
        </div>
        <div class="col-md-4 p-0">
            <a class="btn btn-primary pl-5 pr-5" href="edit_profile.php">Editar Perfil</a>
            <!-- Button trigger modal -->
            
        </div>
    </div>
    <div class = "jumbotron-propio ">
        <div class = "row">
            <div class = "col-md-3 pl-4">
                <label for = "name" ><strong>Nombre </strong></label>
            </div>
            <div class = "col-md-3 ">
                <p> <?php echo $_SESSION['name'];
                                                                            ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong>Apellidos </strong></label>		
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['apellidos']; ?> </p>
            </div>
        </div>
        <div class="row">	
            <div class="col-md-3 pl-4">
                <label for="name" ><strong>Nombre de usuario </strong></label>	
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['user']; ?> </p>
            </div>	
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong>Email </strong></label>
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['email']; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong> Contraseña</strong></label>	

            </div>
            <div class="col-md-3 ">
                <p> **************** </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong>Autorizo </strong></label>		
            </div>
            <div class="col-md-3 ">
                <?php if ($_SESSION['autoriza'] == "1") { ?>
                    <p> Sí</p>
                <?php } else if ($_SESSION['autoriza'] == "0") { ?>
                    <p> No</p>
                <?php } ?>
            </div>
        </div>       
    </div>
</div>
<?php include("footer.php"); ?>
