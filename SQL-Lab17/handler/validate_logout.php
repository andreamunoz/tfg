<?php

unset($_SESSION["email"]);
unset($_SESSION["password"]);
unset($_SESSION["rol"]);
unset($_SESSION["user"]);
unset($_SESSION["autoriza"]);
unset($_SESSION['msg_congratulations']);
unset($_SESSION['msg_new_register']);

session_destroy();
echo "<meta http-equiv=\"Refresh\" content=\"1;url=login/login.php\">"; 

?>

