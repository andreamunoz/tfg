<?php  

unset($_SESSION["email"]);
unset($_SESSION["user"]);
unset($_SESSION["password"]);


session_destroy();

echo "<meta http-equiv=\"Refresh\" content=\"1;url=index.php\">"; 

?>
 
        
