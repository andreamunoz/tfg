<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<img class="img_perfil" src="../img/img_perfil.jpeg"> 
<div class="container contenedor-perfil pt-4">
    <label><a class="enlance" href="index.php" >Inicio </a> > <a class="enlance" href="profile.php" > Perfil</a> > <a class="enlance" href="edit_profile.php" > Editar Perfil</a> </label>
    <h2>Perfil</h2>
    <p>Texto a añadir aquí...</p>
    <div class="hrr mb-5"></div>
    <form method="post" action="../handler/validate_edit_profile.php" class="jumbotron-propio" >
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong>Nombre </strong></label>		
            </div>
            <div class="col-md-3 ">
                <input type="text" id="edit_nombre" name="edit_nombre" value="<?php echo $_SESSION['name'] ?>" class="form-control form-control-sm" required/>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong>Apellidos </strong></label>		
            </div>
            <div class="col-md-3 ">
                <input type="text" id="edit_apellido" name="edit_apellidos" value="<?php echo $_SESSION['apellidos'] ?>" class="form-control form-control-sm" required/>
            </div>
        </div>
        <div class="row mb-2">	
            <div class="col-md-3 pl-4">
                <label for="name" ><strong>Nombre de usuario </strong></label>	
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
                <label for="pass"><strong>Contraseña</strong></label>	
            </div>
            <div class="col-md-3 ">
                <p><?php echo $_SESSION['password']; ?></p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name"><strong>Autorizo </strong></label>		
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
        <div class="row">	
            <div class="col-md-2 offset-9 ">
                <button class="btn btn-primary pl-5 pr-5" name="editar" type="submit">Guardar Perfil</button>
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
