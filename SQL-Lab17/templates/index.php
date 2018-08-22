<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<img class="img_index" src="../img/img_index.png"/>
<div class='contenedor'>
    <h1>Bienvenido <?php echo $_SESSION['user']; ?>!</h1>
    <p>caf af g dsgsd gs gsd gsdgsd gs gsd gs s g gsdgsd</p>
</div>
<?php

if (isset($_SESSION['msg_congratulations'])) {
    echo $_SESSION['msg_congratulations'];
    unset($_SESSION['msg_congratulations']);
}
?>

<?php include("footer.php"); ?>
