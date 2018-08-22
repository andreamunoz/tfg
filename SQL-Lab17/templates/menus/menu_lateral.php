<div id="menu">
   
    <div class="logo-principal">
        <!--<i class="fas fa-align-justify"></i>-->
        <i class="fas fa-angle-right"></i>
        <!--<img src="../../img/icon_desplegar.svg"/>-->
        <p class="text-menu text-b">Bienvenido,</p>
        <p class="text-menu"><?php echo $_SESSION['user'] ?></p>

    </div>
     
    <a class="menu-item" href="index.php"><div id="contenedor-general-espacio" class="contenedor-item">
        <div class="logo-interior">
            <i class="fas fa-home"></i>
        </div>
        <p class="text-menu">Inicio</p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="sheets.php"><div class="contenedor-item">   
            <div class="logo-interior">
                <i class="fas fa-copy"></i>
            </div>
            <p class="text-menu">Hoja de Ejercicios</p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="exercises.php"><div class="contenedor-item">  
        <div class="logo-interior">
            <i class="fas fa-file-code"></i>
        </div>
        <p class="text-menu">Ejercicios</p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="stadistics_exercises.php"><div class="contenedor-item">  
        <div class="logo-interior">
            <i class="far fa-chart-bar"></i>
        </div>
        <p class="text-menu">Estadísticas</p>
        </div></a>
    <hr class="hrr">
    <a class="menu-item" href="profile.php"> <div class="contenedor-item">  
            <div class="logo-interior">
                <i class="fas fa-user"></i>
            </div>
            <p class="text-menu">Perfil</p>
        </div></a>
    <hr class="hrr">
    <?php if ($_SESSION['rol'] == false) { ?>
        <a class="menu-item" href="configuration.php"><div class="contenedor-item">  
            <div class="logo-interior">
                <i class="fas fa-cogs"></i>
            </div>
            <p class="text-menu">Configuración</p>
            </div></a>
            <hr class="hrr">
    <?php } ?>
</div>

