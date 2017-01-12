<?php
$name = mysql_escape_string($_POST['name']);
$email = mysql_escape_string($_POST['email']);


if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
    // Return Error - Invalid Email
}else{
    // Return Success - Valid Email
}

?>
