<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<img class="img_perfil" src="../img/img_perfil.jpeg"> 
<div class="container contenedor-perfil pt-4">
    <?php
    include_once '../inc/ejercicio.php';
    include_once '../inc/tablas.php';
    $ejer = new Ejercicio();
    ?>
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="profile.php" > <?php echo trad('Perfil',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Perfil',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="col-md-8">
            <p><?php echo trad('Muestra los datos personales, puedes editar algunos campos y ver una tabla según tus ejercicios realizados.',$lang) ?></p>
        </div>
        <div class="col-md-4 p-0">
            <a class="btn btn-primary pl-5 pr-5" href="edit_profile.php"><?php echo trad('Editar Perfil',$lang) ?></a>
            <!-- Button trigger modal -->
            <?php if($_SESSION['rol'] == true){ ?>
            <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#exampleModalResul">
                <?php echo trad('Resultados',$lang) ?>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalResul" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-xlg" role="document">
                    <div class="modal-content color-white text-white">
                        <div class="modal-header border-bottom">
                            <h2 class="mt-4 pl-5 " ><?php echo trad('Resultados',$lang) ?></h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <img class="img_icon_cerrar cerrar" src="../img/icon_cerrarPanel.svg"/></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <section id="tabs">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <nav>
                                                <div class="nav nav-tabs nav-fill" id="nav-tablas" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-t" data-toggle="tab" href="#nav-tab" role="tab" aria-controls="nav-tab" aria-selected="true"><?php echo trad('Niveles',$lang) ?></a>
                                                    <a class="nav-item nav-link" id="nav-tab-camp" data-toggle="tab" href="#nav-tab-campos" role="tab" aria-controls="nav-tab-campos" aria-selected="false"><?php echo trad('Categorías',$lang) ?></a>
                                                </div>
                                            </nav>
                                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-ta">
                                                <div class="tab-pane fade show active mt-3 pl-4" id="nav-tab" role="tabpanel" aria-labelledby="nav-ta">
                                                    <div id="accordion ">
                                                        <div class="card">  
                                                            <div class="table-responsive">                
                                                                <table id="employee" class="table table-striped table-bordered"> 
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <?php
                                                                            $niveles = $ejer->getAllNiveles();
                                                                            while ($nivel = mysqli_fetch_array($niveles)) {
                                                                                echo '<th style="text-align:center;">'.$nivel['nivel'].'</th>';
                                                                            }
                                                                            ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        <?php
                                                                        include_once '../inc/estadisticas.php';
                                                                        $user = $_SESSION['user'];
                                                                        $estadisticas = new Estadisticas();
                                                                        $resul = $estadisticas->getStadisticNivel();
                                                                        ?>
                                                                        <tr>
                                                                            <th><?php echo trad('Ejercicios Realizados',$lang) ?></th>
                                                                            <?php while($col = mysqli_fetch_array($resul)){
                                                                                $nIntentF = $estadisticas->getStadisticNoIntentadosNivel($col['nivel'], $user);
                                                                                $noIntentadosF = mysqli_fetch_array($nIntentF);
                                                                                $intentF = $estadisticas->getStadisticIntentadosNivel($col['nivel'],$user);
                                                                                $intentadosF = mysqli_fetch_array($intentF);
                                                                                
                                                                                echo '<td style="text-align:center;">'.$intentadosF['intentados'].' / '.$noIntentadosF['noIntentados'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><?php echo trad('Ejercicios Acertados',$lang) ?></th>
                                                                            <?php $result = $estadisticas->getStadisticNivel();
                                                                            while($col = mysqli_fetch_array($result)){
                                                                                $vFT = $estadisticas->getStadisticNivelVeredictoTrue($col['nivel'], $user);
                                                                                $veredictoFT = mysqli_fetch_array($vFT);                                                                          
                                                                                echo '<td style="text-align:center;">'.$veredictoFT['veredicto'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "tab-pane fade mt-3 pl-4" id = "nav-tab-campos" role = "tabpanel" aria-labelledby = "nav-tab-camp">
                                                    <div id = "accordion ">
                                                        <div class = "card">
                                                            <div class = "table-responsive">
                                                                <table id = "employee-data" class = "table table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <?php
                                                                            $categorias = $ejer->getAllCategorias();
                                                                            while ($categoria = mysqli_fetch_array($categorias)) {
                                                                                echo '<th style="vertical-align:middle;">'.$categoria['tipo'].'</th>';
                                                                            }
                                                                            ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        <tr>
                                                                            <th><?php echo trad('Ejercicios Realizados',$lang) ?></th>
                                                                            <?php $resulta = $estadisticas->getStadisticTipo();
                                                                            while($col = mysqli_fetch_array($resulta)){
                                                                                $nIntentSB = $estadisticas->getStadisticNoIntentadosTipo($col['tipo'], $user);
                                                                                $noIntentadosSB = mysqli_fetch_array($nIntentSB);
                                                                                $intentSB = $estadisticas->getStadisticIntentadosTipo($col['tipo'], $user);
                                                                                $intentadosSB = mysqli_fetch_array($intentSB);
                                                                                
                                                                                echo '<td style="vertical-align:middle; text-align:center">'.$intentadosSB['intentados'].' / '.$noIntentadosSB['noIntentados'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><?php echo trad('Ejercicios Acertados',$lang) ?></th>
                                                                            <?php $resultado = $estadisticas->getStadisticTipo();
                                                                            while($col = mysqli_fetch_array($resultado)){
                                                                                $vSBT = $estadisticas->getStadisticTipoVeredictoTrue($col['tipo'], $user);
                                                                                $veredictoSBT = mysqli_fetch_array($vSBT);                                                                          
                                                                                echo '<td style="vertical-align:middle; text-align:center">'.$veredictoSBT['veredicto'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <?php }else { ?>
            <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#exampleModalResul">
                <?php echo trad('Resultados',$lang) ?>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalResul" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-xlg" role="document">
                    <div class="modal-content color-white text-white">
                        <div class="modal-header border-bottom">
                            <h2 class="mt-4 pl-5 " ><?php echo trad('Resultados',$lang) ?></h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <img class="img_icon_cerrar cerrar" src="../img/icon_cerrarPanel.svg"/></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <section id="tabs">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <nav>
                                                <div class="nav nav-tabs nav-fill" id="nav-tablas" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-t" data-toggle="tab" href="#nav-tab" role="tab" aria-controls="nav-tab" aria-selected="true"><?php echo trad('Niveles',$lang) ?></a>
                                                    <a class="nav-item nav-link" id="nav-tab-camp" data-toggle="tab" href="#nav-tab-campos" role="tab" aria-controls="nav-tab-campos" aria-selected="false"><?php echo trad('Categorías',$lang) ?></a>
                                                </div>
                                            </nav>
                                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-ta">
                                                <div class="tab-pane fade show active mt-3 pl-4" id="nav-tab" role="tabpanel" aria-labelledby="nav-ta">
                                                    <div id="accordion ">
                                                        <div class="card">  
                                                            <div class="table-responsive">                
                                                                <table id="employee" class="table table-striped table-bordered"> 
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <?php
                                                                            $niveles = $ejer->getAllNiveles();
                                                                            while ($nivel = mysqli_fetch_array($niveles)) {
                                                                                echo '<th style="text-align:center;">'.$nivel['nivel'].'</th>';
                                                                            }
                                                                            ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        <?php
                                                                        include_once '../inc/estadisticas.php';
                                                                        $user = $_SESSION['user'];
                                                                        $estadisticas = new Estadisticas();
                                                                        $resul = $estadisticas->getStadisticNivel();
                                                                        ?>
                                                                        <tr>
                                                                            <th><?php echo trad('Ejercicios Propuestos',$lang) ?></th>
                                                                            <?php $resultNP = $estadisticas->getStadisticNivel();
                                                                            while($col = mysqli_fetch_array($resultNP)){
                                                                                $vN = $estadisticas->getStadisticNivelPropuestos($col['nivel'], $user);
                                                                                $ejerNPropuestos = mysqli_fetch_array($vN);                                                                          
                                                                                echo '<td style="text-align:center;">'.$ejerNPropuestos['propuestos'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><?php echo trad('Ejercicios Deshabilitados',$lang) ?></th>
                                                                            <?php $resultDesP = $estadisticas->getStadisticNivel();
                                                                            while($col = mysqli_fetch_array($resultDesP)){
                                                                                $vDesN = $estadisticas->getStadisticNivelDeshabilitados($col['nivel'], $user);
                                                                                $ejerNDesPropuestos = mysqli_fetch_array($vDesN);                                                                          
                                                                                echo '<td style="vertical-align:middle; text-align:center;">'.$ejerNDesPropuestos['propuestos'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "tab-pane fade mt-3 pl-4" id = "nav-tab-campos" role = "tabpanel" aria-labelledby = "nav-tab-camp">
                                                    <div id = "accordion ">
                                                        <div class = "card">
                                                            <div class = "table-responsive">
                                                                <table id = "employee-data" class = "table table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <?php
                                                                            $categorias = $ejer->getAllCategorias();
                                                                            while ($categoria = mysqli_fetch_array($categorias)) {
                                                                                echo '<th style="vertical-align:middle;">'.$categoria['tipo'].'</th>';
                                                                            }
                                                                            ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        <tr>
                                                                            <th><?php echo trad('Ejercicios Propuestos',$lang) ?></th>
                                                                            <?php $resultTP = $estadisticas->getStadisticTipo();
                                                                            while($col = mysqli_fetch_array($resultTP)){
                                                                                $vT = $estadisticas->getStadisticTipoPropuestos($col['tipo'], $user);
                                                                                $ejerTPropuestos = mysqli_fetch_array($vT);                                                                          
                                                                                echo '<td style="text-align:center;">'.$ejerTPropuestos['propuestos'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><?php echo trad('Ejercicios Deshabilitados',$lang) ?></th>
                                                                            <?php $resultDesPT = $estadisticas->getStadisticTipo();
                                                                            while($col = mysqli_fetch_array($resultDesPT)){
                                                                                $vDesT = $estadisticas->getStadisticTipoDeshabilitados($col['tipo'], $user);
                                                                                $ejerTDesPropuestos = mysqli_fetch_array($vDesT);                                                                          
                                                                                echo '<td style="vertical-align:middle; text-align:center;">'.$ejerTDesPropuestos['propuestos'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?> 
        </div>
    </div>
    <div class = "jumbotron-propio ">
        <div class = "row">
            <div class = "col-md-3 pl-4">
                <label for = "name" ><strong><?php echo trad('Nombre',$lang) ?> </strong></label>
            </div>
            <div class = "col-md-3 ">
                <p> <?php echo $_SESSION['name'];
                                                                            ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Apellidos',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['apellidos']; ?> </p>
            </div>
        </div>
        <div class="row">	
            <div class="col-md-3 pl-4">
                <label for="name" ><strong><?php echo trad('Nombre de usuario',$lang) ?> </strong></label>	
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['user']; ?> </p>
            </div>	
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong><?php echo trad('Email',$lang) ?> </strong></label>
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['email']; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong> <?php echo trad('Contraseña',$lang) ?></strong></label>	

            </div>
            <div class="col-md-3 ">
                <p> **************** </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong><?php echo trad('Autorizo',$lang) ?> </strong></label>		
            </div>
            <div class="col-md-3 ">
                <?php if ($_SESSION['autoriza'] == "1") { ?>
                    <p> Sí</p>
                <?php } else if ($_SESSION['autoriza'] == "0") { ?>
                    <p> No</p>
                <?php } ?>
            </div>
        </div>       
    </div>
</div>
<?php include("footer.php"); ?>
