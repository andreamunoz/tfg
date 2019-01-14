<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<img class="img_perfil" src="../img/img_perfil.jpeg"> 
<div class="container contenedor-perfil pt-4">
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="profile.php" > <?php echo trad('Perfil',$lang) ?></a> > <a class="enlance" href="edit_profile.php" > <?php echo trad('Editar Perfil',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Editar Perfil',$lang) ?></strong></h2>
    
    <form method="post" action="../handler/validate_edit_profile.php" class="jumbotron-propio" >
        <div class="row mb-150">
        <div class="col-md-8">
            <p><?php echo trad('Edita el perfil en los campos que se pueden rellenar y pincha en guardar pefil para que se guarden los resultados.',$lang) ?></p>
        </div>
    </div>
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Nombre',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <input type="text" maxlength="60" id="edit_nombre" name="edit_nombre" value="<?php echo $_SESSION['name'] ?>" class="form-control form-control-sm" required/>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Apellidos',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <input type="text" id="edit_apellido" maxlength="70" name="edit_apellidos" value="<?php echo $_SESSION['apellidos'] ?>" class="form-control form-control-sm" required/>
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
         <?php if($_SESSION['rol'] == 0 && $_SESSION['modo'] == 1) { ?>
        <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name"><strong><?php echo trad('Autorizo',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="materialChecked" name="check" value="1" <?php if($_SESSION['autoriza']==1){ 
                    ?> checked <?php } ?> >
                    <label class="form-check-label" for="materialChecked"><?php echo trad('Si',$lang) ?></label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="materialChecked" name="check" value="0" <?php if($_SESSION['autoriza']==0){
                        ?> checked <?php } ?> >
                    <label class="form-check-label" for="materialChecked"><?php echo trad('No',$lang) ?></label>
                </div>
            </div>
        </div> 
        <?php } ?>
        <?php 
        include_once '../inc/user.php';
        $us = new User();
        $profesores = $us->getAllProfesores();
        ?>
        <?php if($_SESSION['asociado'] != "") { ?>
            <div class="row mb-2">
            <div class="col-md-3 pl-4">
                <label for="name"><strong><?php echo trad('Profesor Asociado',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <select type="text" id="asociado_profesor" name="asociado_profesor" class="form-control form-control-sm" style="display: inline-block;">
                    <?php while ($prof = mysqli_fetch_array($profesores)) { 
                        $nombreCompleto = $prof['nombre'].' '.$prof['apellidos'];
                        if($_SESSION['asociado'] == $nombreCompleto) { ?>
                            <option value="<?php echo $_SESSION['asociado']?>" selected><?php echo $_SESSION['asociado']?></option>
                        <?php }else { ?>
                            <option value="<?php echo $prof['nombre'].' '.$prof['apellidos']?>"><?php echo $prof['nombre'].' '.$prof['apellidos']?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div> 
        <?php } ?>
        <div class="row mt-5 mb-2">
            <button class="btn btn-primary pl-5 pr-5" name="editar" type="submit"><?php echo trad('Guardar Perfil',$lang) ?></button>
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
