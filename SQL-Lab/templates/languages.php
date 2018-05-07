<?php 
function trad($str, $lang = null){

	if ($lang != null) {
		if(file_exists('language_'.$lang.'.php')){
			include ('language_'.$lang.'.php');
			if(isset($texts[$str])){
				$str = $texts[$str];
			}
		}
	}
	return $str;
}
?>