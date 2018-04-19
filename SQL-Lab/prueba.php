<html>
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="css/index.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<?php include("inc/ejercicio.php"); ?>
		<title>SQLab</title>
	</head>	
	<body>
		<?php 
			$ejercicio = new Ejercicio();
			
			
			
			
		?>

		
	</body>
</html>

<!-- 

Devuelve un array de ejercicio por el usuario
------------------------------------------
$arrayEjercicios = $ejercicio->getEjercicioById(4);
			$cont = count($arrayEjercicios);
			for ($row = 0; $row < $cont; $row++) {
				for ($col = 0; $col < 8; $col++) {
					echo "-".$arrayEjercicios[$row][$col]."-";
					print("<br>");
				}
			}

Devuelve un array de ejercicio por el usuario
------------------------------------------
$arrayEjercicios = $ejercicio->getEjercicioByUser("rober");
			$cont = count($arrayEjercicios);
			for ($row = 0; $row < $cont; $row++) {
				for ($col = 0; $col < 8; $col++) {
					echo "-".$arrayEjercicios[$row][$col]."-";
					print("<br>");
				}
			}

Devuelve un array de ejercicio por el tipo
------------------------------------------
$arrayEjercicios = $ejercicio->getEjercicioByTipo("2.Select-Join");
$cont = count($arrayEjercicios);
for ($row = 0; $row < $cont; $row++) {
		for ($col = 0; $col < 8; $col++) {
		echo "-".$arrayEjercicios[$row][$col]."-";
		print("<br>");
		}
}

Devuelve un array de ejercicio por el nivel
--------------------------------------------
$arrayEjercicios = $ejercicio->getEjercicioByNivel("facil");
$cont = count($arrayEjercicios);
for ($row = 0; $row < $cont; $row++) {
		for ($col = 0; $col < 8; $col++) {
		echo "-".$arrayEjercicios[$row][$col]."-";
		print("<br>");
		}
}

Crear en la tabla un nuevo ejercicio
------------------------------------------
$ejercicio->create("Intermedio","selecciona tu .....","tabla coches",0,"1.Select-Basico","rober","Select *");

Crear en la tabla un nuevo ejercicio
------------------------------------------
$ejercicio->update(4,"medio","selecciona tu .....","tabla marcas",1,"2.Select-Join","Select * from usuario");

-->