<?php
session_start();
//deleting Cookies
setcookie($_SESSION['username']," ",time()-3600);
setcookie($_SESSION['utype']," ",time()-3600);
//deleting session variables
unset($_SESSION['username']);
session_destroy();

header("Location: login.php");
?>
