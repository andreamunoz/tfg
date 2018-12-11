<?php if($_SESSION['modo'] == 0 || $_SESSION['modo'] == 2) { ?>
<div id="menu">
   
    <div class="logo-principal">
        <!--<i class="fas fa-align-justify"></i>-->
        <i class="fas fa-angle-right"></i>
        <p class="text-menu text-titulo">SQLab</p>
        <!--<img src="../../img/icon_desplegar.svg"/>-->
        <p class="text-menu text-b"><?php echo trad('Hola',$lang) ?>,</p>
        <p class="text-menu"><?php echo $_SESSION['name']." ".$_SESSION['apellidos'] ?></p>

    </div>
     
    <a class="menu-item" href="index.php"><div id="contenedor-general-espacio" class="contenedor-item">
        <div class="logo-interior">
            <i class="fas fa-home"></i>
        </div>
        <p class="text-menu"><?php echo trad('Inicio',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a  class="menu-item" href="exercises.php"><div id="ejercicio" class="contenedor-item">  
        <div class="logo-interior">
            <i class="fas fa-file-code"></i>
        </div>
        <p class="text-menu"><?php echo trad('Ejercicios',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a  class="menu-item" href="sheets.php"><div id="hojas" class="contenedor-item">   
            <div class="logo-interior">
                <i class="fas fa-copy"></i>
            </div>
            <p class="text-menu"><?php echo trad('Hoja de Ejercicios',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="stadistics_exercises.php"><div class="contenedor-item">  
        <div class="logo-interior">
            <i class="far fa-chart-bar"></i>
        </div>
        <p class="text-menu"><?php echo trad('Estadísticas',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="profile.php"> <div class="contenedor-item">  
            <div class="logo-interior">
                <i class="fas fa-user"></i>
            </div>
            <p class="text-menu"><?php echo trad('Perfil',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="help.php"> <div class="contenedor-item">  
            <div class="logo-interior">
                <i class="fas fa-question"></i>
            </div>
            <p class="text-menu"><?php echo trad('Ayuda',$lang) ?></p>
        </div></a>
    <hr class="hrr">
</div>
<?php } else if($_SESSION['modo'] == 1 ) { ?>
<div id="menu">
   
    <div class="logo-principal">
        <!--<i class="fas fa-align-justify"></i>-->
        <i class="fas fa-angle-right"></i>
        <p class="text-menu text-titulo">SQLab</p>
        <!--<img src="../../img/icon_desplegar.svg"/>-->
        <p class="text-menu text-b"><?php echo trad('Hola',$lang) ?>,</p>
        <p class="text-menu"><?php echo $_SESSION['name']." ".$_SESSION['apellidos'] ?></p>

    </div>
     
    <a class="menu-item" href="index.php"><div id="contenedor-general-espacio" class="contenedor-item">
        <div class="logo-interior">
            <i class="fas fa-home"></i>
        </div>
        <p class="text-menu"><?php echo trad('Inicio',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="configuration_tables.php"><div class="contenedor-item">   
            <div class="logo-interior">
                <i class="fas fa-table"></i>
            </div>
            <p class="text-menu"><?php echo trad('Gestión de Tablas',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="configuration_exercises.php"><div class="contenedor-item">  
        <div class="logo-interior">
            <i class="fas fa-file-code"></i>
        </div>
        <p class="text-menu"><?php echo trad('Gestión de Ejercicios',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="configuration_sheets.php"><div class="contenedor-item">  
        <div class="logo-interior">
            <i class="fas fa-copy"></i>
        </div>
        <p class="text-menu"><?php echo trad('Gestión de Hojas',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="configuration_stadistics_exercises.php"><div class="contenedor-item">  
        <div class="logo-interior">
            <i class="far fa-chart-bar"></i>
        </div>
        <p class="text-menu"><?php echo trad('Estadísticas',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="profile.php"> <div class="contenedor-item">  
            <div class="logo-interior">
                <i class="fas fa-user"></i>
            </div>
            <p class="text-menu"><?php echo trad('Perfil',$lang) ?></p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="help.php"> <div class="contenedor-item">  
            <div class="logo-interior">
                <i class="fas fa-question"></i>
            </div>
            <p class="text-menu"><?php echo trad('Ayuda',$lang) ?></p>
        </div></a>
    <hr class="hrr">
</div>
<?php } ?>
