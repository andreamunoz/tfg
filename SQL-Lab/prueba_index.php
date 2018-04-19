
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="css/prueba.css" rel="stylesheet" type="text/css">
		
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<title>SQLab</title>
	</head>	
	<body>
    <!-- MODAL INICIAR SESION-->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title" id="myModalLabel">Iniciar Sesión</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail">Correo Electrónico</label>  
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required></input>
                </div>
                <div class="form-group col-md-12">
                  <label for="inputPassword">Contraseña</label>
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required></input>
                </div>
              </div>
              <div class="form-row">
                <a class="col-md-12 text-right" href="#myMoReg" data-toggle="modal">¿Has olvidado la contraseña?</a>
              </div>
              <div class="form-row">
                <a class="col-md-12 text-right" href="#myMoReg" data-toggle="modal">Registrate</a>
              </div>
              <div class="form-row">
                <button class="col-md-4 btn btn-log btn-primary btn-block" type="submit" onclick="location.href='index_profesor.php'">Sign in</button>
              </div>
            </form>
        </div>
          
      </div>
    </div>
  </div>
  <!-- MODAL REGISTRO USUARIO-->
  <div class="modal fade" id="myMoReg" tabindex="-1" role="dialog" aria-labelledby="myModalRegLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalRegLabel" >Registro de usuario</h4>
        </div>
        <div class="modal-body">
          <form >
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="name">Nombre</label>  
                  <input type="text" id="name" class="form-control" required></input>
              </div>
              <div class="form-group col-md-7">
                  <label for="apellido">Apellidos</label> 
                  <input type="text" id="apellido" class="form-control" required></input>
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="dire">Dirección</label> 
                  <input type="text" id="dire" class="form-control" required></input>
              </div>
              <div class="form-group col-md-4">
                  <label for="codPostal">Código Postal</label>  
                  <input type="text" id="codPostal" class="form-control" required></input>
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail">Correo Electrónico</label>
                  <input type="email" id="inputEmail" class="form-control" required></input>
                </div>
                <div class="form-group col-md-12">
                  <label for="inputPassword">Contraseña</label>
                  <input type="password" id="inputPassword" class="form-control" required></input>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                <button class="btn btn-log btn-primary btn-block" data-dismiss="modal" >Cancelar</button>
              </div>
              <div class="form-group col-md-6">
                  <button class="btn btn-log btn-primary btn-block" type="submit" onclick="location.href='index_profesor.php'">Crear Cuenta</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>


		<?php include("navbar_menu.php"); ?>

		<main role="main">

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1" class=""></li>
          <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item">
            <img class="first-slide" src="img/img1_carrusel.jpg" width="100%" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item active">
            <img class="second-slide" src="img/img2_carrusel.jpg" alt="Second slide">
            <div class="container">
              <div class="carousel-caption">
                <h1>Another example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="img/img1_carrusel.jpg" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>One more for good measure.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">
      	<h3 class="text-center mb-5" >PROFESORES</h3>
        <!-- Three columns of text below the carousel -->
        <div class="row">

          <div class="col-lg-3">

            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>HOJAS DE EJERCICIOS</h2>
            <p>Los profesores pueden crear nuevas hojas de ejercicios, introduciendo ejercicios que estén ya creados.</p>
            <!--<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>-->
          </div>
          <div class="col-lg-3">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <!--<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>-->
          </div>
          <div class="col-lg-3">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <!--<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>-->
          </div>
          <div class="col-lg-3">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <!--<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>-->
          </div>
        </div>

        <hr class="featurette-divider">

		<h3 class="text-center mb-5" >ALUMNOS</h3>
        <!-- Three columns of text below the carousel -->
        <div class="row">

          <div class="col-lg-3">

            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>HOJAS DE EJERCICIOS</h2>
            <p>Los alumnos pueden crear nuevas hojas de ejercicios, introduciendo ejercicios que estén ya creados.</p>
            <!--<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>-->
          </div>
          <div class="col-lg-3">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <!--<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>-->
          </div>
          <div class="col-lg-3">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <!--<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>-->
          </div>
          <div class="col-lg-3">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <!--<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>-->
          </div>
        </div>
        </main>
	</body>
	<footer class="footer py-3 text-center">
		© 2018 <a id="pie" href="prueba_index.php">Sqlab</a> 
	</footer>
</html>

