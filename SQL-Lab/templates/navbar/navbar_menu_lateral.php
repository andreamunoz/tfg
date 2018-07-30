<div class="nav-side-menu">   		
    <div class="menu-list">	
        <ul id="menu-content" class="menu-content collapse out">   
            <li data-toggle="collapse" data-target="#prin" class="collapsed" id="liprin">
              <a id="principal" href="../templates/index_profesor.php"><i class="fa fa-home" aria-hidden="true"></i><?php echo trad('Inicio', $lang) ?> </a>
            </li>  
            <li data-toggle="collapse" data-target="#tablas" class="collapsed" id="litabl">
              <a id="adjuntar_tabla" href="../templates/prf_tablas.php"><i class="fa fa-table" aria-hidden="true"></i><?php echo trad('Añadir Datos',$lang) ?></a>
            </li>   
            <li data-toggle="collapse" data-target="#ejercicios" class="collapsed" id="liejer">
              <a id="ejercicio" href="#"><i class="fa fa-file-o" aria-hidden="true"></i><?php echo trad('Ejercicios',$lang) ?> <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="ejercicios">
              <li class="" id="licrej"><a id="crear_ejercicio" href="../templates/prf_crear_ejercicio.php"><?php echo trad('Crear Ejercicio',$lang) ?></a></li>
              <li class="" id="liliej"><a id="lista_ejercicio" href="../templates/prf_listar_ejercicios.php"><?php echo trad('Gestión de Ejercicios',$lang) ?></a></li>
            </ul>
            <li data-toggle="collapse" data-target="#hojas" class="collapsed" id="lihoja">
              <a id="hoja_ejercicio" href="#"><i class="fa fa-files-o" aria-hidden="true"></i><?php echo trad('Hojas de Ejercicios', $lang) ?> <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="hojas">
                <li class="" id="licrho"><a id="crear_hoja" href="../templates/prf_crear_hoja.php"><?php echo trad('Crear Hoja',$lang) ?></a></li>
                <li class="" id="liliho"><a id="lista_hoja" href="../templates/prf_listar_hojas.php"><?php echo trad('Gestión de Hojas',$lang) ?></a></li>    
            </ul>         

            <li data-toggle="collapse" data-target="#estadisticas" class="collapsed" id="liesta">
              <a id="estadistic" href="../templates/prf_estadisticas.php"><i class="fa fa-signal" aria-hidden="true"></i><?php echo trad('Estadísticas',$lang) ?></a>
            </li>  

            <li data-toggle="collapse" data-target="#configurar" class="collapsed" id="liconf">
              <a id="configuracion" href="#"><i class="fa fa-cogs" aria-hidden="true"></i><?php echo trad('Configuración',$lang) ?> <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="configurar">
              <li class="" id="liperf"><a id="perfil" href="../templates/prf_configuracion.php"><?php echo trad('Perfil',$lang) ?></a></li>
            </ul>  

        </ul>
 	</div>
 </div>