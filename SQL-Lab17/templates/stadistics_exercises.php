<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<?php unset($_SESSION['select_p']); unset($_SESSION['select_n']); unset($_SESSION['select_t']); unset($_SESSION['value_cab']); unset($_SESSION['select_cab']); $_SESSION['showNumber']="";?>
<div class="container-tabla pt-4">
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="stadistics_exercises.php" > <?php echo trad('Estadísticas',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Estadísticas',$lang) ?></strong></h2>
    <p><?php echo trad('Texto a añadir aquí...',$lang) ?></p>
    <div class="row pt-2">
        <div class="offset-9 col-md-3 mb-3">
            <select class="custom-select" title="Selecciona" id="mostrar" onclick="mostrarNC()">
                <option value="nivel" selected><?php echo trad('Nivel',$lang) ?></option>
                <option value="tipo"><?php echo trad('Categoría',$lang) ?></option>
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
            $j=1;
            
            while($col = mysqli_fetch_array($resul)){
                
            ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <div class="col-lg-4">
                <p><?php echo $col['nivel'] ?></p>
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
                            labels: ["<?php echo trad('Aciertos',$lang) ?>", "<?php echo trad('Fallos',$lang) ?>", "<?php echo trad('No intentados',$lang) ?>"],
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
                            labels: ["<?php echo trad('Aciertos',$lang) ?>", "<?php echo trad('Fallos',$lang) ?>", "<?php echo trad('No intentados',$lang) ?>"],
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

<?php include("footer.php"); ?>
