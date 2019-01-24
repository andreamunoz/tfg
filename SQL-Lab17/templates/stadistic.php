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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<div class="container-tabla pt-4">
    <label><a class="enlance" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlance" href="configuration_stadistics_exercises.php" > <?php echo trad('Estadísticas',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Estadísticas',$lang) ?></strong></h2>	
    <div class="row mb-150">
        <div class="col-md-10">
            <p><?php echo trad('Muestra las estadisticas por nivel y categoría referenciado a un alumno o a todos.',$lang) ?></p>
        </div>
        
    </div>
    <div class="text-right">
        <label class="circulo-verde"></label><label> Acierto</label>
        <label class="circulo-rojo"></label><label> Fallo</label>
        <label class="circulo-gris"></label><label> No Intentado</label>
    </div>
    <div class="row ">
        <div class="col-md-3 mb-3">
            <select class="custom-select" title="Selecciona" id="mostrar" onclick="mostrarNC()">
                <option value="nivel" selected>Nivel</option>
                <option value="tipo">Categoría</option>
            </select>
        </div>
        <div class="offset-md-3 col-md-6 select-graficos p-0 text-right">
            <?php if($_SESSION['grafico']=='barra'){ ?>
                <i id="circular" class="fas fa-chart-pie icono-graficos" title="circular"></i>
            <?php } else if($_SESSION['grafico']=='circular'){ ?>
                <i id="barra" class="fas fa-chart-bar icono-graficos" title="barra"></i>
            <?php } ?>
        </div>
    </div>
    <?php if($_SESSION['grafico']=='circular'){ ?>
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
            <div class="col-lg-4">
                <p><?php echo $col['nivel'] ?></p>
                <hr>
                
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
                    
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Nivel', 'Resultados'],
                        ['Aciertos', <?php echo $veredictoFT['veredicto'] ?>], 
                        ['Fallos', <?php echo $veredictoFF['veredicto'] ?>],
                        ['No Intentados', <?php echo $resNointentadosF ?>]
                      ]);

                      var options = {
                        is3D: true,
                        legend: 'none',
                        chartArea:{left:90,top:0,width:'50%',height:'80%'},
                        pieSliceTextStyle: {
                                color: 'black',
                                fontSize: 18,
                                position:'center'
                              },
                        slices: {
                            0: {color: 'green',offset: 0.1},
                            1: {color: 'red',offset: 0.1},
                            2: {color: '#d4d4d4',offset: 0.1}
                        },
                      };
                      var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $j ?>'));
                      chart.draw(data, options);
                    }
                </script>
                <div id="piechart<?php echo $j ?>" ></div>
            </div>
            <?php $j = $j + 1; } ?>
        </div>
    </div>
    <div id="tipo" style="display: none; ">
        <div class="row pt-4">
        <?php
            include_once '../inc/estadisticas.php';
            $user = $_SESSION['user'];
            $estadisticas4 = new Estadisticas();
            $result = $estadisticas4->getStadisticTipo();
            $i=1;
            while($fila = mysqli_fetch_array($result)){   
        ?>
            <div class="col-lg-3">
                <p><?php echo $fila['tipo'] ?></p>
                <hr>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
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
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawCharter);
                        function drawCharter() {
                          var data = google.visualization.arrayToDataTable([
                            ['Categoria', 'Resultados'],
                            ['Aciertos', <?php echo $veredictoSBT['veredicto']?>], 
                            ['Fallos', <?php echo $veredictoSBF['veredicto'] ?>],
                            ['No Intentados', <?php echo $resNointentadosSB ?>]
                          ]);

                          var options = {
                            is3D: true,
                            legend: 'none',
                            chartArea:{left:20,top:0,width:'30%',height:'60%'},
                            pieSliceTextStyle: {
                                color: 'black',
                                fontSize: 18,
                              },
                            pieStartAngle: 20,
                            slices: {
                                0: {color: 'green',offset: 0.05},
                                1: {color: 'red',offset: 0.05},
                                2: {color: '#d4d4d4',offset: 0.05}
                            }
                          };
                          var charter = new google.visualization.PieChart(document.getElementById('pies-chart<?php echo $i ?>'));
                          charter.draw(data, options);
                        }
                </script>
                <div id="pies-chart<?php echo $i ?>" ></div>
            </div>
            <?php $i = $i + 1; } ?>
        </div>
    </div>
    <?php } else if($_SESSION['grafico']=='barra'){?>
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
            <div class="col-lg-4">
                <p><?php echo $col['nivel'] ?></p>
                <hr>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                    
                      google.charts.load("current", {packages:['corechart']});
                      google.charts.setOnLoadCallback(drawCharts);
                      function drawCharts() {
                        var data = google.visualization.arrayToDataTable([
                          ["Nivel", "Resultados", { role: "style" } ],
                          ["Acierto", <?php echo $veredictoFT['veredicto'] ?>, "green"],
                          ["Fallo", <?php echo $veredictoFF['veredicto'] ?>, "red"],
                          ["No Intentado", <?php echo $resNointentadosF ?>, "#d4d4d4"]
                        ]);
                        
                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                                         { calc: "stringify",
                                           sourceColumn: 1,
                                           type: "string",
                                           role: "annotation" },
                                         2]);

                        var options = {
//                          title: "Density of Precious Metals, in g/cm^3",
//                          width: 500,
//                          height: 300,
                          bar: {groupWidth: "40%"},
                          legend: { position: "none" },
                          chartArea:{left:50,top:10,width:'70%',height:'100%'},
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values<?php echo $j ?>"));
                        chart.draw(view, options);
                    }
                    </script>
                  <div id="columnchart_values<?php echo $j ?>" ></div>
            </div>
            <?php $j = $j + 1; } ?>
        </div>
    </div>
    <div id="tipo" style="display: none; ">
        <div class="row pt-4">
        <?php
            include_once '../inc/estadisticas.php';
            $user = $_SESSION['user'];
            $estadisticas4 = new Estadisticas();
            $result = $estadisticas4->getStadisticTipo();
            $i=1;
            while($fila = mysqli_fetch_array($result)){   
        ?>
            <div class="col-lg-3">
                <p><?php echo $fila['tipo'] ?></p>
                <hr>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
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
                      google.charts.load("current", {packages:['corechart']});
                      google.charts.setOnLoadCallback(drawCharts2);
                      function drawCharts2() {
                        var data = google.visualization.arrayToDataTable([
                          ["Nivel", "Resultados", { role: "style" } ],
                          ["Acierto", <?php echo $veredictoSBT['veredicto']?>, "green"],
                          ["Fallo", <?php echo $veredictoSBF['veredicto'] ?>, "red"],
                          ["No Intentado", <?php echo $resNointentadosSB ?>, "#d4d4d4"]
                        ]);
                        
                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                                         { calc: "stringify",
                                           sourceColumn: 1,
                                           type: "string",
                                           role: "annotation" },
                                         2]);

                        var options = {
//                          title: "Density of Precious Metals, in g/cm^3",
//                          width: 500,
//                          height: 300,
                          bar: {groupWidth: "30%"},
                          legend: { position: "none" },
                          chartArea:{left:10, top:10,width:'60%',height:'80%'},
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columncharts_values<?php echo $i ?>"));
                        chart.draw(view, options);
                    }
                    </script>
                    <div id="columncharts_values<?php echo $i ?>" class="mb-5"></div>
            </div>
            <?php $i = $i + 1; } ?>
        </div>
    </div>        
    <?php } ?>
</div>


<script>
    function mostrarNC() {
        var nv = document.getElementById("mostrar");
        if (nv.value == "nivel"){
            nivel.style.display = "block";
            tipo.style.display = "none";
        } else {
            nivel.style.display = "none";
            tipo.style.display = "block";
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
