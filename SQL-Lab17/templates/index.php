<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<?php 
//variables-sesion: exercises
unset($_SESSION['select_p']); unset($_SESSION['select_n']); unset($_SESSION['select_t']); unset($_SESSION['value_cab']); unset($_SESSION['select_cab']); $_SESSION['showNumber']=""; 
//variables-sesion: hoja
unset($_SESSION['select_p_h']); unset($_SESSION['select_cab_h']); unset($_SESSION['value_cab_h']); $_SESSION['showNumber_h']=""; 
//variables-sesion: ver hoja
unset($_SESSION['select_p_verh']); unset($_SESSION['select_n_verh']);unset($_SESSION['select_t_verh']); unset($_SESSION['value_cab_verh']); unset($_SESSION['select_cab_verh']); $_SESSION['showNumber_verh']="";
$_SESSION['grafico']="circular";
?>
<img class="img_index" src="../img/img_index.png"/>
<div class='contenedor'>
    <h1 class="left_title"><?php echo trad('Hola', $lang) ?> <?php echo $_SESSION['name']; ?>!</h1>
    
    <div class="margin-ok">	
        <p class="p_ind"><?php echo trad('<b>SQL-Lab</b> es una aplicación que le permitirá aprender las sentencias básicas de MySQL.', $lang) ?></p>
        <p class="p_ind"><?php echo trad('Existen distintos tipos de ejercicios y dentro de cada tipo los hay de distinta complejidad. Le recomendamos empezar por los ejercicios de tipo Select Básico que son los más sencillos para luego incrementar la complejidad añadiendo elementos que agreguen funcionalidad a las sentencias como la clausula "Having", la clausula "Group By" o la clausula "Join."', $lang) ?></p>
        <p class="p_ind"><?php echo trad('También tiene la opción de resolver ejercicios de una hoja que ha sido creada por un profesor y puede estar dedicada a un tipo concreto de sentencias o pueden usar todos los ejercicios las mismas tablas.', $lang) ?></p>
        <p class="p_ind"><?php echo trad('También dispone de un apartado donde consultar en unos gráficos sus avances y otro apartado donde encontrará sus datos de usuario.', $lang) ?></p>
        <p class="p_ind"><?php echo trad('En el menú lateral le mostramos todas las opciones para comenzar.', $lang) ?></p>
        <?php if($_SESSION['modo'] == 1) {?>
            <a class="btn btn-primary mt-2 pl-5 pr-5" href="configuration.php"><?php echo trad('Comenzar Ahora',$lang) ?></a>
        <?php } ?>
    	
        <?php
        if ($_SESSION['rol'] == 0 and $_SESSION['modo'] == 1) {
            include_once '../inc/user.php';
            $user = $_SESSION['user'];
            $us = new User();
            $mensajes = $us->getAvisosNoLeidos($user);
            if (count($mensajes) != 0) {
                ?>
                <div class="pt-5" id="avisos">
                    <h5>AVISOS</h5>

                    <?php for ($i = 0; $i < count($mensajes); $i++) { ?>
                        <div class="aviso"><?php echo $mensajes[$i]; ?></div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-6 marcarLeidos" data-name="<?php echo $_SESSION['user']; ?>">Marcar estos avisos como leídos</div>
                        <div class="col-md-6 mostrarTodos" data-name="<?php echo $_SESSION['user']; ?>">Mostrar todos los avisos</div>
                    </div>
                </div>
            <?php
            }
        }
        ?>
    </div>
</div>

<?php
if (isset($_SESSION['msg_congratulations'])) {
    echo $_SESSION['msg_congratulations'];
    unset($_SESSION['msg_congratulations']);
}
?>

<?php include("footer.php"); ?>
