<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<img class="img_perfil" src="../img/img_perfil.jpeg"> 
<div class="container contenedor-perfil pt-4">
    <label><a class="enlance" href="index.php" >Inicio </a> > <a class="enlance" href="profile.php" > Perfil</a> </label>
    <h2><strong>Perfil</strong></h2>
    <p>Texto a añadir aquí...</p>
    <div class="hrr mb-5"></div>
    <div class="jumbotron-propio ">
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong>Nombre </strong></label>		
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['name']; ?> </p>
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
                <p> <?php echo $_SESSION['password']; ?> </p>
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
    <div class="row">	
        <div class="col-md-2 offset-10 ">
            <a class="btn btn-primary pl-5 pr-5" href="edit_profile.php">Editar Perfil</a>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
