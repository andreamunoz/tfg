<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_tables.php" > Tablas</a> > <a class="enlace" href="configuration_new_tables.php" > Nueva Tabla</a></label>
    <h2><strong>Nueva Tabla</strong></h2>
    <div class="row mb-5">
        <div class="col-md-12">
            <p>Introduzca el código para crear las tablas e introducir los datos. Sólo se permiten las sentencias CREATE TABLE, INSERT INTO, DROP TABLE y ALTER TABLE.</p>
        </div>
    </div>  
    <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">

                    <form method="post" action="../handler/validate_create_tables.php">

                        <?php
                            if (isset($_SESSION['guardarDatosTablas'])){ ?>
                            <textarea  id="crea_tabla" name="crea_tabla" class="form-control" rows="10" placeholder="<?php echo trad( "CREATE TABLE coches...", $lang) ?>" required><?php echo $_SESSION['guardarDatosTablas']; ?></textarea>
                        <?php } else { ?> 
                            <textarea  id="crea_tabla" name="crea_tabla" class="form-control" rows="10" placeholder="<?php echo trad( "CREATE TABLE coches...", $lang) ?>" required></textarea>
                        <?php } ?>
                        
                            <div class="form-group text-right">
                                <button class="btn btn-primary pl-5 pr-5 mt-5 mb-5" type="submit"><?php echo trad( "Ejecutar", $lang) ?></button>
                            </div>
                       
                    </form>
                    
                </div>
            </div>
        </div>
</div>
</section>

<?php include("footer.php"); ?> 
