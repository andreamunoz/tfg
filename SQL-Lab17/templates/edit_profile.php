<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<img class="img_perfil" src="../img/img_perfil.jpeg"> 
<div class="container contenedor-perfil pt-4">
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="profile.php" > <?php echo trad('Perfil',$lang) ?></a> > <a class="enlance" href="edit_profile.php" > <?php echo trad('Editar Perfil',$lang) ?></a> </label>
    <h2><?php echo trad('Editar Perfil',$lang) ?></h2>
    <div class="row mb-150">
        <div class="col-md-8">
            <p><?php echo trad('Edita el perfil en los campos que se pueden rellenar y pincha en guardar pefil para que se guarden los resultados.',$lang) ?></p>
        </div>
        <div class="col-md-4 p-0">
            <button class="btn btn-primary pl-5 pr-5" name="editar" type="submit"><?php echo trad('Guardar Perfil',$lang) ?></button>
        </div>
    </div>
    <form method="post" action="../handler/validate_edit_profile.php" class="jumbotron-propio" >
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Nombre',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <input type="text" id="edit_nombre" name="edit_nombre" value="<?php echo $_SESSION['name'] ?>" class="form-control form-control-sm" required/>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Apellidos',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <input type="text" id="edit_apellido" name="edit_apellidos" value="<?php echo $_SESSION['apellidos'] ?>" class="form-control form-control-sm" required/>
            </div>
        </div>
        <div class="row mb-2">	
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Nombre de usuario',$lang) ?> </strong></label>	
            </div>
            <div class="col-md-3 ">
                <p><?php echo $_SESSION['user'] ?></p>
            </div>	
        </div>
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name"><strong>Email </strong></label>
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['email']; ?> </p>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-3 pl-4">
                <label for="pass"><strong><?php echo trad('Contraseña',$lang) ?></strong></label>	
            </div>
            <div class="col-md-3 ">
                <p> **************** </p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name"><strong><?php echo trad('Autorizo',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="materialChecked" name="check" value="1" <?php if($_SESSION['autoriza']==1){ 
                    ?> checked <?php } ?> >
                    <label class="form-check-label" for="materialChecked">Si</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="materialChecked" name="check" value="0" <?php if($_SESSION['autoriza']==0){
                        ?> checked <?php } ?> >
                    <label class="form-check-label" for="materialChecked">No</label>
                </div>
            </div>
        </div>  
        <?php
            if(isset($_SESSION['msg_update_register'])){
                echo $_SESSION['msg_update_register'];
                unset($_SESSION['msg_update_register']);
            }
        ?>
    </form>	
</div>
<?php include("footer.php"); ?>
