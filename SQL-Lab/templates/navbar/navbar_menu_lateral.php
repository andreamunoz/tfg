<div class="nav-side-menu">   		
    <div class="menu-list">	
        <ul id="menu-content" class="menu-content collapse out">   
            <li data-toggle="collapse" data-target="#prin" class="collapsed">
              <a id="principal" href="#principal"><i class="fa fa-home" aria-hidden="true"></i><?php echo trad('Inicio', $lang) ?> </a>
            </li>  
            <li data-toggle="collapse" data-target="#tablas" class="collapsed">
              <a id="adjuntar_tabla" href="#adjuntar_tabla"><i class="fa fa-table" aria-hidden="true"></i><?php echo trad('Añadir Datos',$lang) ?></a>
            </li>   
            <ul class="sub-menu collapse" id="hojas">
                <li class=""><a id="crear_hoja" href="#"><?php echo trad('Crear Hoja',$lang) ?></a></li>
<!--                 <li class=""><a id="editar_hoja" href="#"><?php echo trad('Editar Hoja',$lang) ?></a></li> -->
                <li class=""><a id="lista_hoja" href="#"><?php echo trad('Listar Hojas',$lang) ?></a></li>    
            </ul>
            <li data-toggle="collapse" data-target="#hojas" class="collapsed">
              <a id="hoja_ejercicio" href="#"><i class="fa fa-files-o" aria-hidden="true"></i><?php echo trad('Hojas de Ejercicios', $lang) ?> <span class="arrow"></span></a>
            </li>           
            <li data-toggle="collapse" data-target="#ejercicios" class="collapsed">
              <a id="ejercicio" href="#"><i class="fa fa-file-o" aria-hidden="true"></i><?php echo trad('Ejercicios',$lang) ?> <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="ejercicios">
              <li class=""><a id="crear_ejercicio" href="#crear"><?php echo trad('Crear Ejercicio',$lang) ?></a></li>
<!--               <li class=""><a id="editar_ejercicio" href="#editar"><?php echo trad('Editar Ejercicio',$lang) ?></a></li> -->
              <li class=""><a id="lista_ejercicio" href="#lista"><?php echo trad('Listar Ejercicios',$lang) ?></a></li>
            </ul>

            <li data-toggle="collapse" data-target="#estadisticas" class="collapsed">
              <a id="estadistic" href="#"><i class="fa fa-signal" aria-hidden="true"></i><?php echo trad('Estadísticas',$lang) ?></a>
            </li>  

            <li data-toggle="collapse" data-target="#configurar" class="collapsed">
              <a id="configuracion" href="#"><i class="fa fa-cogs" aria-hidden="true"></i><?php echo trad('Configuración',$lang) ?> <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="configurar">
              <li class=""><a id="perfil" href="#"><?php echo trad('Perfil',$lang) ?></a></li>
            </ul>  

        </ul>
 	</div>
 </div>