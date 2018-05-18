<?php 
    require('languages.php');
    session_start();

    $lang = null;
    if(isset($_GET['lang'])){
      $lang = $_GET['lang'];
      $_SESSION['lang'] = $lang;
    }else{
      if(isset($_SESSION['lang'])){
        $lang = $_SESSION['lang'];
      }else{
        $_SESSION['lang'] = null;
      }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		  <link href="../css/prueba.css" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	

	    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	    <!-- <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/all.js"></script>
  		<script defer src="https://use.fontawesome.com/releases/[VERSION]/js/v4-shims.js"></script> -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

		<title>SQLab</title>
	</head>	
	<body>
		<?php include("modals/modals_cerrar_sesion.php"); ?>
		<?php include("navbar/navbar_menu_alumno.php"); ?>
		<div class="container pt-4">
			<h2>Estadísticas</h2>
      <p>Texto a añadir aquí...</p>	
      <div class="hrr mb-2"></div>
        <div class="row pt-3">
          
          <div class="offset-9 col-md-3">
            <select class="custom-select" title="Selecciona" id="mostrar" onclick="mostrarNC()">
              <option value="nivel" selected>Nivel</option>
              <option value="tipo">Categoría</option>
            </select>
            </div>
        </div>	
        <div id="nivel" >
  			<div class="row pt-4"> 
               <?php 
                  include_once '../inc/estadisticas.php';
                  $estadisticas = new Estadisticas();
                ?>
      				<div class="col-lg-4">
                <p>Fácil</p>
                <hr>
                
                <canvas id="doughnut-chart" width="800" height="450"></canvas>    
                <script type="text/javascript">
                  new Chart(document.getElementById("doughnut-chart"), {
                      type: 'doughnut',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vFT = $estadisticas->getStadisticNivelVeredictoTrue("facil","roberdi"); 
                            $veredictoFT = mysqli_fetch_array($vFT);?>
                            <?php $vFF = $estadisticas->getStadisticNivelVeredictoFalse("facil","roberdi"); 
                            $veredictoFF = mysqli_fetch_array($vFF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoFT['veredicto']; ?>,<?php echo $veredictoFF['veredicto'] ?>,2]
                          }
                        ]
                      }
                  });
                </script>
              </div>
              <div class="col-lg-4">
                <p>Intermedio</p>
                <hr>
               
                <canvas id="doughnut-chart2" width="800" height="450"></canvas>
                
                <script type="text/javascript">
                  new Chart(document.getElementById("doughnut-chart2"), {
                      type: 'doughnut',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vMT = $estadisticas->getStadisticNivelVeredictoTrue("medio","roberdi"); 
                            $veredictoMT = mysqli_fetch_array($vMT);?>
                            <?php $vMF = $estadisticas->getStadisticNivelVeredictoFalse("medio","roberdi"); 
                            $veredictoMF = mysqli_fetch_array($vMF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoMT['veredicto']; ?>,<?php echo $veredictoMF['veredicto'] ?>,2]
                          }
                        ]
                      }
                  });
                </script>
              </div>
              <div class="col-lg-4">
                <p>Difícil</p>
                <hr>
                <canvas id="doughnut-chart3" width="800" height="450"></canvas>

                <script type="text/javascript">
                  new Chart(document.getElementById("doughnut-chart3"), {
                      type: 'doughnut',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vDT = $estadisticas->getStadisticNivelVeredictoTrue("dificil","roberdi"); 
                            $veredictoDT = mysqli_fetch_array($vDT);?>
                            <?php $vDF = $estadisticas->getStadisticNivelVeredictoFalse("dificil","roberdi"); 
                            $veredictoDF = mysqli_fetch_array($vDF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoDT['veredicto']; ?>,<?php echo $veredictoDF['veredicto'] ?>,2]
                          }
                        ]
                      }
                  });
                </script>
              </div>
          </div>
          </div>
          <div id="tipo" style="display: none; width: 100%;">
            <div class="row pt-5"> 
              <div class="col-lg-4">
                <p>Select Básico</p>
                <hr>
                <canvas id="bar-chart-horizontal1" width="800" height="350"></canvas>
                <script type="text/javascript">
                  new Chart(document.getElementById("bar-chart-horizontal1"), {
                      type: 'horizontalBar',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vSBT = $estadisticas->getStadisticTipoVeredictoTrue("1.Select-Basico","roberdi"); 
                            $veredictoSBT = mysqli_fetch_array($vSBT);?>
                            <?php $vSBF = $estadisticas->getStadisticNivelVeredictoFalse("1.Select-Basico","roberdi");
                            $veredictoSBF = mysqli_fetch_array($vSBF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoSBT['veredicto']; ?>,<?php echo $veredictoSBF['veredicto'] ?>,2]
                          }
                        ]
                      },
                      options: {
                        legend: { display: false }
                      }
                  });
                </script>
              </div>
              <div class="col-lg-4">
                <p>Select Join</p>
                <hr>
                <canvas id="bar-chart-horizontal2" width="800" height="350"></canvas>
                <script type="text/javascript">
                  new Chart(document.getElementById("bar-chart-horizontal2"), {
                      type: 'horizontalBar',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vSJT = $estadisticas->getStadisticTipoVeredictoTrue("2.Select-Join","roberdi"); 
                            $veredictoSJT = mysqli_fetch_array($vSJT);?>
                            <?php $vSJF = $estadisticas->getStadisticTipoVeredictoFalse("2.Select-Join","roberdi");
                            $veredictoSJF = mysqli_fetch_array($vSJF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoSJT['veredicto']; ?>,<?php echo $veredictoSJF['veredicto'] ?>,2]
                          }
                        ]
                      },
                      options: {
                        legend: { display: false }
                      }
                  });
                </script>
              </div>
              <div class="col-lg-4">
                <p>Select-Group-Básico </p>
                <hr>
                <canvas id="bar-chart-horizontal3" width="800" height="350"></canvas>
                <script type="text/javascript">
                  new Chart(document.getElementById("bar-chart-horizontal3"), {
                      type: 'horizontalBar',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vSGBT = $estadisticas->getStadisticTipoVeredictoTrue("3.Select-Group-Basico","roberdi"); 
                            $veredictoSGBT = mysqli_fetch_array($vSGBT);?>
                            <?php $vSGBF = $estadisticas->getStadisticTipoVeredictoFalse("3.Select-Group-Basico","roberdi");
                            $veredictoSGBF = mysqli_fetch_array($vSGBF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoSGBT['veredicto']; ?>,<?php echo $veredictoSGBF['veredicto'] ?>,2]
                          }
                        ]
                      },
                      options: {
                        legend: { display: false }
                      }
                  });
                </script>
              </div>
            </div>
            <div class="row pt-5 pb-5"> 
              <div class="col-lg-4">
                <p>Select-Group-Having</p>
                <hr>
                <canvas id="bar-chart-horizontal4" width="800" height="350"></canvas>
                <script type="text/javascript">
                  new Chart(document.getElementById("bar-chart-horizontal4"), {
                      type: 'horizontalBar',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vSGHT = $estadisticas->getStadisticTipoVeredictoTrue("4.Select-Group-Having","roberdi"); 
                            $veredictoSGHT = mysqli_fetch_array($vSGHT);?>
                            <?php $vSGHF = $estadisticas->getStadisticTipoVeredictoFalse("4.Select-Group-Having","roberdi");
                            $veredictoSGHF = mysqli_fetch_array($vSGHF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoSGHT['veredicto']; ?>,<?php echo $veredictoSGHF['veredicto'] ?>,2]
                          }
                        ]
                      },
                      options: {
                        legend: { display: false }
                      }
                  });
                </script>
              </div>
              <div class="col-lg-4">
                <p>Subqueries-Valor</p>
                <hr>
                <canvas id="bar-chart-horizontal5" width="800" height="350"></canvas>
                <script type="text/javascript">
                  new Chart(document.getElementById("bar-chart-horizontal5"), {
                      type: 'horizontalBar',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vSVT = $estadisticas->getStadisticTipoVeredictoTrue("5.Subqueries-Valor","roberdi"); 
                            $veredictoSVT = mysqli_fetch_array($vSVT);?>
                            <?php $vSVF = $estadisticas->getStadisticTipoVeredictoFalse("5.Subqueries-Valor","roberdi");
                            $veredictoSVF = mysqli_fetch_array($vSVF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoSVT['veredicto']; ?>,<?php echo $veredictoSVF['veredicto'] ?>,2]
                          }
                        ]
                      },
                      options: {
                        legend: { display: false }
                      }
                  });
                </script>
              </div>
              <div class="col-lg-4 pb-5">
                <p>Subqueries-Conjuntos</p>
                <hr>
                <canvas id="bar-chart-horizontal6" width="800" height="350"></canvas>
                <script type="text/javascript">
                  new Chart(document.getElementById("bar-chart-horizontal6"), {
                      type: 'horizontalBar',
                      data: {
                        labels: ["Aciertos", "Fallos", "No intentados"],
                        datasets: [
                          {
                            <?php $vSCT = $estadisticas->getStadisticTipoVeredictoTrue("6.Subqueries-Conjuntos","roberdi"); 
                            $veredictoSCT = mysqli_fetch_array($vSCT);?>
                            <?php $vSCF = $estadisticas->getStadisticTipoVeredictoFalse("6.Subqueries-Conjuntos","roberdi");
                            $veredictoSCF = mysqli_fetch_array($vSCF);?>
                            backgroundColor: ["green", "red","yellow"],
                            data: [<?php echo $veredictoSCT['veredicto']; ?>,<?php echo $veredictoSCF['veredicto'] ?>,2]
                          }
                        ]
                      },
                      options: {
                        legend: { display: false }
                      }
                  });
                </script>
              </div>
            </div>
  			 </div>	 	
		</div>
    <script>
        function mostrarNC() {
            var nv = document.getElementById("mostrar");
            if (nv.value == "nivel"){
                nivel.style.display = "inline-block";
                tipo.style.display = "none";
            } else {
               nivel.style.display = "none";
               tipo.style.display = "inline-block";
            }
        }
    </script>
	</body>
  <footer class="footer py-3 text-center">
    © 2018 <a id="pie" href="index_profesor.php">Sqlab</a> 
    
  </footer>
</html>