<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-tertiary">
        <a href="/" class="navbar-brand">SQLab</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-stretch" id="navbarPrincipal">
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle " id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" href="#"><?php echo trad('Idioma',$lang) ?></a> 
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">     
                            <a class="dropdown-item " href="index.php?lang=es"><img src="../img/bandera/espana.png" class="img-fluid" alt="Responsive image" /> <?php echo trad('Español',$lang) ?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="index.php?lang=en"><img src="../img/bandera/reino-unido.png" class="img-fluid" alt="Responsive image" /> <?php echo trad('Inglés',$lang) ?></a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" href="#myModal"><?php echo trad('Entrar',$lang) ?></a> 
                </li>  
            </ul>
        </div>
    </nav> 
</header>