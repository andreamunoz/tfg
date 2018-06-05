<div class="principal"> 
	
	<div class="row ">
		<div class="col-md-11 jumbotron-propio ">
			<h3 id="userPrincipal" data-name="<?php echo $_SESSION['user']; ?>">
				Bienvenid@ <?php echo $_SESSION['user']; ?> 
			</h3>
			<div class="hrr"></div>
			<h4 class="pt-4">
				En el menú lateral le mostramos todas las opciones que puede realizar.
			</h4>
			<div class="pt-5" id="avisos">
				<?php 
				include_once '../inc/usuario.php';
				$user =  $_SESSION['user'];
				$us = new Usuario();
				$mensajes = $us->getAvisosNoLeidos($user); 
				if(count($mensajes) != 0){ ?>
					<h5>AVISOS</h5>
					<?php
					for($i=0; $i<count($mensajes); $i++){
					?>

					<div class="aviso"><?php echo $mensajes[$i];?></div>
					<?php } ?>
					<div class="row">
						<div class="col-md-6 marcarLeidos" data-name="<?php echo $_SESSION['user']; ?>">Marcar estos avisos como leídos</div>
						<div class="col-md-6 mostrarTodos" data-name="<?php echo $_SESSION['user']; ?>">Mostrar todos los avisos</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</div>
</div>	

