<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<?php 
//variables-sesion: exercises
unset($_SESSION['select_p']); unset($_SESSION['select_n']); unset($_SESSION['select_t']); unset($_SESSION['value_cab']); unset($_SESSION['select_cab']); $_SESSION['showNumber']=""; 
//variables-sesion: hoja
unset($_SESSION['select_p_h']); unset($_SESSION['select_cab_h']); unset($_SESSION['value_cab_h']); $_SESSION['showNumber_h']=""; 
//variables-sesion: ver hoja
unset($_SESSION['select_p_verh']);unset($_SESSION['select_n_verh']);unset($_SESSION['select_t_verh']); unset($_SESSION['value_cab_verh']); unset($_SESSION['select_cab_verh']); $_SESSION['showNumber_verh']="";
?>
<div class="container-tabla pt-4">
    <label><a class="enlance" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlance" href="configuration_stadistics_exercises.php" > <?php echo trad('Estadísticas',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Estadísticas',$lang) ?></strong></h2>	
    <div class="row mb-150">
        <div class="col-md-10">
            <p><?php echo trad('Muestra las estadisticas por nivel y categoría referenciado a un alumno o a todos.',$lang) ?></p>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-3 mb-3">
            <?php 
            include_once '../inc/user.php';
            $usuarios = new User();
            $users = $usuarios->getNombreAlumnos();
            ?>
            <select class="custom-select" title="Selecciona" id="mostraruser" >
                <?php $_SESSION['alumnos'] ?>' = "<script> document.write(selectedOpcion) </script>";
                <?php if (isset($_SESSION['alumnos'])) { ?>
                    <option value="<?php echo $_SESSION['alumnos'] ?>" selected><?php echo $_SESSION['alumnos'] ?></option>
                <?php } else { ?>
                    <option value="<?php echo $_SESSION['user'] ?>" selected><?php echo $_SESSION['user'] ?></option>             
                <?php } ?>
                <?php while ($usuario = mysqli_fetch_array($users)) {
                    echo '<option value='.$usuario['nombre'].' >'.$usuario['nombre'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <select class="custom-select" title="Selecciona" id="mostrar" onclick="mostrarNC()">
                <option value="nivel" selected>Nivel</option>
                <!-- <option value="nivel" selected> <?php //echo trad("Nivel", $lang) ?></option> -->
                <option value="tipo">Categoría</option>
                <!-- <option value="tipo"><?php //echo trad("Categoría", $lang) ?></option> -->
            </select>
        </div>
    </div>	
    <div id="nivel" >
        <div class="row pt-4"> 
            <?php
            include_once '../inc/estadisticas.php';
            $user = $_SESSION['user'];
            $estadisticas = new Estadisticas();
            $resul = $estadisticas->getStadisticNivel();
            if (isset($_SESSION['alumnos'])) { $user = $_SESSION['alumnos']; }
            else { $user = $_SESSION['user']; }
            $j=1;
            
            while($col = mysqli_fetch_array($resul)){
                
            ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <div class="col-lg-4">
                <p><?php echo $col['nivel'] ?></p>
                <!-- <p><?php //echo trad($col['nivel'], $lang) ?></p> -->
                <hr>
                <canvas id="bar-chart-horizontal<?php echo $j ?>" width="700" height="500"></canvas>
                <script type="text/javascript">
                    <?php                   
                    $estadisticas = new Estadisticas();
                    $vFT = $estadisticas->getStadisticNivelVeredictoTrue($col['nivel'], $user);
                    $veredictoFT = mysqli_fetch_array($vFT);
                    $vFF = $estadisticas->getStadisticNivelVeredictoFalse($col['nivel'], $user);
                    $veredictoFF = mysqli_fetch_array($vFF);
                    $nIntentF = $estadisticas->getStadisticNoIntentadosNivel($col['nivel'], $user);
                    $noIntentadosF = mysqli_fetch_array($nIntentF);
                    $intentF = $estadisticas->getStadisticIntentadosNivel($col['nivel'],$user);
                    $intentadosF = mysqli_fetch_array($intentF);
                    $resNointentadosF = $noIntentadosF['noIntentados'] - $intentadosF['intentados'];
                    ?>
                    new Chart(document.getElementById("bar-chart-horizontal<?php echo $j ?>"), {
                            type: 'horizontalBar',
                            data: {
                            labels: ["Aciertos", "Fallos", "No intentados"],
                                    datasets: [
                                    {
                                    backgroundColor: ["rgba(48,48,48,0.8)", "rgba(48,48,48,0.5)", "rgba(48,48,48,0.2)"],
                                            data: [<?php echo $veredictoFT['veredicto'] ?>,<?php echo $veredictoFF['veredicto'] ?>, <?php echo $resNointentadosF ?>]
                                    }
                                    ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                      barPercentage: 0.5,
                                      gridLines: {
                                        display: false
                                      }
                                    }]
                                },
                                legend: { display: false }
                            }
                    }); 
                </script>
            </div>
           <?php $j = $j + 1; } ?>
        </div>
    </div>
    <div id="tipo" style="display: none; width: 100%;">
        
        <div class="row pt-4">   

        <?php
            include_once '../inc/estadisticas.php';
            $user = $_SESSION['user'];
            $estadisticas4 = new Estadisticas();
            $result = $estadisticas4->getStadisticTipo();
            $i=4;
            while($fila = mysqli_fetch_array($result)){
                
            ?>
         
           
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <div class="col-lg-4 mb-5">
                <p><?php echo $fila['tipo'] ?></p>
                <hr>
                <canvas id="bar-chart-horizontal<?php echo $i ?>" width="700" height="500"></canvas>
                <script type="text/javascript">
                    <?php                   
                    $estadisticas4 = new Estadisticas();
                    $vSBT = $estadisticas4->getStadisticTipoVeredictoTrue($fila['tipo'], $user);
                    $veredictoSBT = mysqli_fetch_array($vSBT);
                    $vSBF = $estadisticas4->getStadisticTipoVeredictoFalse($fila['tipo'], $user);
                    $veredictoSBF = mysqli_fetch_array($vSBF);
                    $nIntentSB = $estadisticas4->getStadisticNoIntentadosTipo($fila['tipo'], $user);
                    $noIntentadosSB = mysqli_fetch_array($nIntentSB);
                    $intentSB = $estadisticas4->getStadisticIntentadosTipo($fila['tipo'],$user);
                    $intentadosSB = mysqli_fetch_array($intentSB);
                    $resNointentadosSB = $noIntentadosSB['noIntentados'] - $intentadosSB['intentados'];
                    
                    ?>
                    new Chart(document.getElementById("bar-chart-horizontal<?php echo $i ?>"), {
                            type: 'horizontalBar',
                            data: {
                            labels: ["Aciertos", "Fallos", "No intentados"],
                                    datasets: [
                                    {
                                    backgroundColor: ["rgba(48,48,48,0.8)", "rgba(48,48,48,0.5)", "rgba(48,48,48,0.2)"],
                                            data: [<?php echo $veredictoSBT['veredicto'] ?>,<?php echo $veredictoSBF['veredicto'] ?>, <?php echo $resNointentadosSB ?>]
                                    }
                                    ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                      barPercentage: 0.5,
                                      gridLines: {
                                        display: false
                                      }
                                    }]
                                },
                                legend: { display: false }
                            }
                    }); 
                </script>
            
            </div>
            <?php $i = $i + 1; } ?>
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
<script>
            var select = document.getElementById('mostraruser');
            select.addEventListener('change', function(){
               var selectedOption = this.options[select.selectedIndex]; 
               //location.reload(true);
               return selectedOpcion.value;
            });
</script>

<?php include("footer.php"); ?>
