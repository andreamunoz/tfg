<?php
session_start();
?>
<!DOCTYPE html>
<?php
require('../languages.php');
$lang = 'en';

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/index.css">
        <title></title>
    </head>
    <body>
        <div class="row">
            
            <img class="img_login" src="../../img/img_login.jpg">
            <div class="col-md-6 contenedor-login">
                <h1>SQLab</h1>
                <p><?php echo trad('Siéntate y comienza a pensar',$lang) ?></p>
            </div>
            <div class=" col-md-6 center">          
                <form method="post" action="../../handler/validate_register.php">
                    <div class="form-row">
                        <div class="form-group offset-md-2 col-md-8 ">
                            <h3><strong><?php echo trad('Regístrate',$lang) ?></strong></h3>
                            <p><?php echo trad('Rellene el formulario con sus datos personales para acceder a la página web y poder realizar los ejercicio de SQLab.',$lang) ?></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group offset-md-2 col-md-4">
                            <label for="name"><?php echo trad('Nombre',$lang) ?></label>  
                            <input type="text" id="name" name="nombre" class="form-control form-control-sm" required />
                        </div>
                        <div class="form-group col-md-5">
                            <label for="apellido"><?php echo trad('Apellidos',$lang) ?></label> 
                            <input type="text" id="apellido" name="apellidos" class="form-control form-control-sm" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group offset-md-2 col-md-5">
                            <label for="nom_usuario"><?php echo trad('Nombre de usuario',$lang) ?></label> 
                            <input type="text" id="nom_usuario" name="nombre_usuario" class="form-control form-control-sm" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="profe_alumno" required><?php echo trad('Rol',$lang) ?></label> 
                            <select type="text" id="profe_alumno" name="profe_alumno" class="form-control form-control-sm" > <!--onclick="cambiaRol()"-->
                                <option value="alumno"><?php echo trad('Alumno',$lang) ?></option>
                                <option value="profe"><?php echo trad('Profesor',$lang) ?></option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group offset-md-2 col-md-8">
                            <input type="checkbox" id="myCheck" name="checkAutoriza" style="display: none;" value="1">
                            <span id="myCheckText" style="display: none"><?php echo trad('Permito a otros profesores usar las tablas creadas por mí',$lang) ?></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group offset-md-2 col-md-9">
                            <label for="inputEmail"><?php echo trad('Correo Electrónico',$lang) ?></label>
                            <input type="email" id="inputEmail" name="email" class="form-control form-control-sm" required />
                        </div>
                        <div class="form-group offset-md-2 col-md-9">
                            <label for="inputPassword"><?php echo trad('Contraseña',$lang) ?></label>
                            <input type="password" id="inputPassword" name="password" class="form-control form-control-sm" required />
                        </div>
                    </div>
                    <div class="form-row mt-4 offset-md-4">
                        <div class="form-group offset-md-2 col-md-5">
                            <label><?php echo trad('Ya tengo una cuenta ir a',$lang) ?> <a class="enlace-login" href="login.php">Login</a></label>
                        </div>
                        <div class="form-group offset-md-2 col-md-3">
                            <button class="btn btn-primary" type="submit"><?php echo trad('Crear Cuenta',$lang) ?></button>
                        </div>
                    </div>
                    <?php
                    if(isset($_SESSION['msg_new_register'])){
                        echo $_SESSION['msg_new_register'];
                        unset($_SESSION['msg_new_register']);
                    }
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>



