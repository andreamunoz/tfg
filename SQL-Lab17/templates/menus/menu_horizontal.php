<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php">SQLab</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Idioma
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#"><img class="pr-3" src="../img/bandera/espana.png" /> Español</a>
                    <a class="dropdown-item" href="#"><img class="pr-3" src="../img/bandera/reino-unido.png" /> Inglés</a>
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bienvenido <?php echo $_SESSION['user'] ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                    <a class="dropdown-item" href="profile.php"><i class="fas fa-user-edit pr-3"></i> Perfil</a>
                    <a class="dropdown-item" href="login/login.php"><i class="fas fa-power-off pr-3"></i> Salir</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

