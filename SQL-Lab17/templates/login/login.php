<?php
session_start();
?>
<!DOCTYPE html>
<?php
require('../languages.php');
$lang = 'es';

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/index.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
        <script src="../../js/functions.js"></script>
        <title></title>
    </head>
    <body >
        <div class="row">
            
            <img class="img_login">
            <div class="col-md-6 contenedor-login">
                <h1>SQLab</h1>
                <p><?php echo trad('Siéntate y comienza a pensar',$lang)."." ?></p>
            </div>
            <div class="col-md-6 center">
                <form method="post" action="../../handler/validate_login.php">
                    <div class="offset-md-3 col-md-7 ">
                        <h3><strong><?php echo trad('Iniciar Sesión',$lang)?></strong></h3>
                        <p><?php echo trad('Introduzca sus datos de correo electrónico y contraseña para acceder a la web de SQLab.',$lang)?></p>
                    </div>
                    <div class="offset-md-3 col-md-7 pt-5">
                        <div class="form-group">
                            <label for="inputEmail"><?php echo trad('Correo Electrónico',$lang)?></label>  
                            <input type="email" name="email" id="inputEmail" class="form-control form-control-sm" placeholder='<?php echo trad('Correo Electrónico',$lang)?>' required/>
                        </div>
                        
                    </div>
                    <div class="offset-md-3 col-md-7">
                        <div class="form-group ">
                            <label for="inputPassword"><?php echo trad('Contraseña',$lang)?></label>
                            <input type="password" name="password" id="inputPassword" class="form-control form-control-sm" placeholder='<?php echo trad('Contraseña',$lang)?>' required />
                        </div>
                        
                    </div>
                    <div class="offset-md-6 col-md-5 pl-1">
                        <a class="enlace-login" href="#"><?php echo trad('¿Has olvidado la contraseña?',$lang)?></a>
                    </div>
                    <div class="offset-md-8 col-md-3 pl-3">
                        <a class="enlace-login" href="new_register.php"><?php echo trad('¡Regístrate!',$lang)?></a>
                    </div>
                    <div class="offset-md-5 col-md-7 pl-5 mt-5">
                        <button  type="submit" class="col-md-4 btn btn-primary"><?php echo trad('Entrar',$lang)?></button>
                    </div>
                    <?php
                    if(isset($_SESSION['msg_login'])){
                        echo $_SESSION['msg_login'];
                        unset($_SESSION['msg_login']);
                    }
                    ?>
                </form>
                
            </div>

        </div>
    </body>
    
</html>

