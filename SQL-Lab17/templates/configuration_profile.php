<?php
session_start();
?>
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
    <label><a class="enlance" href="configuration.php" >Configuración </a> > <a class="enlance" href="configuration_profile.php" > Perfil</a> </label>
    <h2><strong>Perfil</strong></h2>
    <div class="row mb-150">
        <div class="col-md-8">
            <p>Muestra los datos personales, puedes editar algunos campos y ver una tabla según tus ejercicios realizados...</p>
        </div>
        <div class="col-md-4 p-0">
            <a class="btn btn-primary pl-5 pr-5" href="edit_profile.php">Editar Perfil</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#exampleModalResul">
                Resultados
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalResul" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-xlg" role="document">
                    <div class="modal-content color-white text-white">
                        <div class="modal-header border-bottom">
                            <h2 class="mt-4 pl-5 " >Resultados</h2>
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
                                                    <a class="nav-item nav-link active" id="nav-t" data-toggle="tab" href="#nav-tab" role="tab" aria-controls="nav-tab" aria-selected="true">Niveles</a>
                                                    <a class="nav-item nav-link" id="nav-tab-camp" data-toggle="tab" href="#nav-tab-campos" role="tab" aria-controls="nav-tab-campos" aria-selected="false">Categorías</a>
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
                                                                            <th>Ejercicios Propuestos</th>
                                                                            <?php $resultNP = $estadisticas->getStadisticNivel();
                                                                            while($col = mysqli_fetch_array($resultNP)){
                                                                                $vN = $estadisticas->getStadisticNivelPropuestos($col['nivel'], $user);
                                                                                $ejerNPropuestos = mysqli_fetch_array($vN);                                                                          
                                                                                echo '<td style="text-align:center;">'.$ejerNPropuestos['propuestos'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Ejercicios Deshabilitados</th>
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
                                                                            <th>Ejercicios Propuestos</th>
                                                                            <?php $resultTP = $estadisticas->getStadisticTipo();
                                                                            while($col = mysqli_fetch_array($resultTP)){
                                                                                $vT = $estadisticas->getStadisticTipoPropuestos($col['tipo'], $user);
                                                                                $ejerTPropuestos = mysqli_fetch_array($vT);                                                                          
                                                                                echo '<td style="text-align:center;">'.$ejerTPropuestos['propuestos'].' </td>';
                                                                            } ?>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Ejercicios Deshabilitados</th>
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
        </div>
    </div>
    <div class = "jumbotron-propio ">
        <div class = "row">
            <div class = "col-md-3 pl-4">
                <label for = "name" ><strong>Nombre </strong></label>
            </div>
            <div class = "col-md-3 ">
                <p> <?php echo $_SESSION['name'];
                                                                            ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name" ><strong>Apellidos </strong></label>		
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['apellidos']; ?> </p>
            </div>
        </div>
        <div class="row">	
            <div class="col-md-3 pl-4">
                <label for="name" ><strong>Nombre de usuario </strong></label>	
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['user']; ?> </p>
            </div>	
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong>Email </strong></label>
            </div>
            <div class="col-md-3 ">
                <p> <?php echo $_SESSION['email']; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong> Contraseña</strong></label>	

            </div>
            <div class="col-md-3 ">
                <p> **************** </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pl-4">
                <label for="name"><strong>Autorizo </strong></label>		
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
