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
    <label><?php if($_SESSION['rol']==1 || $_SESSION['modo']==0){ ?><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang);?> </a><?php }else {?><a class="enlance" href="configuration.php" ><?php echo trad('Modo Profesor',$lang)?> </a><?php } ?> > <a class="enlance" href="profile.php" > <?php echo trad('Perfil',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Perfil',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="col-md-8">
            <p><?php echo trad('Muestra los datos personales, puedes editar algunos campos y ver una tabla según tus ejercicios realizados.',$lang) ?></p>
        </div>
    </div>
    <div class = "jumbotron-propio ">
        <div class = "row">
            <div class = "col-md-3 pl-4">
                <label for = "name" ><strong><?php echo trad('Nombre',$lang) ?> </strong></label>
            </div>
            <div class = "col-md-3 ">
                <p> <?php echo $_SESSION['name'];
                                                                            ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Apellidos',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['apellidos']; ?> </p>
            </div>
        </div>
        <div class="row">	
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Nombre de usuario',$lang) ?> </strong></label>	
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['user']; ?> </p>
            </div>	
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong><?php echo trad('Email',$lang) ?> </strong></label>
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['email']; ?> </p>
            </div>
        </div>
        <?php if($_SESSION['rol'] == 0 && $_SESSION['modo'] == 1) { ?>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong><?php echo trad('Autorizo',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <?php if ($_SESSION['autoriza'] == "1") { ?>
                    <p><?php echo trad('Si',$lang) ?></p>
                <?php } else if ($_SESSION['autoriza'] == "0") { ?>
                    <p> <?php echo trad('No',$lang) ?></p>
                <?php } ?>
            </div>
        </div> 
        <?php } ?>
        <div Class="row">
            <a class="btn btn-primary mt-5 pl-5 pr-5" href="edit_profile.php"><?php echo trad('Editar Perfil',$lang) ?></a>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
