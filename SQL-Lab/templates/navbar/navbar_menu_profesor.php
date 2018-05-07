<header>
	<nav class="navbar navbar-expand-md navbar-dark bg-tertiary">
	    <a href="#" class="navbar-brand">SQLab</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrincipal_Profesor">
	        <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="navbar-collapse collapse justify-content-stretch" id="navbarPrincipal_Profesor">
	        <ul class="navbar-nav ml-auto">
	            <li>
	                <div class="dropdown">
	                    <a class="nav-link dropdown-toggle " id="dropdownMenuButton_Profesor" data-toggle="dropdown" aria-haspopup="true" href="#"><?php echo trad('Modo Profesor',$lang) ?></a> 
	                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton_Profesor">                   
	                        <a class="dropdown-item " href="#"><?php echo trad('Modo Alumno',$lang) ?></a> 
	                    </div>
	                </div>
	            </li> 
	            <li>
	                <div class="dropdown">
	                    <a class="nav-link dropdown-toggle " id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" href="#"><?php echo trad('Idioma',$lang) ?></a> 
	                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">                   
	                        <a class="dropdown-item " href="index_profesor.php?lang=es"><img src="../img/bandera/espana.png" class="img-fluid" alt="Responsive image" /> <?php echo trad('Español',$lang) ?></a>
	                        <div class="dropdown-divider"></div>
	                        <a class="dropdown-item " href="index_profesor.php?lang=en"><img src="../img/bandera/reino-unido.png" class="img-fluid" alt="Responsive image" /> <?php echo trad('Inglés',$lang) ?></a>
	                    </div>
	                </div>
	            </li> 
	            <li>
	                <a class="nav-link" data-toggle="modal" href="#myMoCerrar"><?php echo trad('Salir',$lang) ?></a> 
	            </li>
	        </ul>
	    </div>
	</nav>
</header>