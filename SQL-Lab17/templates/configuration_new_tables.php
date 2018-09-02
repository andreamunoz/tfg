<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Configuración',$lang) ?> </a> > <a class="enlace" href="configuration_tables.php" > <?php echo trad('Tablas',$lang) ?></a> > <a class="enlace" href="configuration_new_tables.php" > <?php echo trad('Nueva Tabla',$lang) ?></a></label>
    <h2><strong><?php echo trad('Nueva Tabla',$lang) ?></strong></h2>
    <div class="row mb-5">
        <div class="col-md-12">
            <p><?php echo trad('En esta página puedes ejecutar las sentencias para crear nuevas tablas (CREATE TABLE), modificar la estructura de la tabla si no ha sido ya utilizada (ALTER TABLE), borrar alguna tabla si tampoco ha sido usada todavía (DROP TABLE) y añadir nuevos datos a la tabla (INSERT INTO). Recuerda que solo puedes modificar las tablas que hayas creado tú.',$lang) ?></p>
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
