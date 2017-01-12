<?php

$psw = password_hash('Administrator1',PASSWORD_DEFAULT);
$utype = 'administrator';
$pswv = password_verify($psw, '$2y$10$6PlP68MHvAs.qoL64XKG5.TGLLpoIUwGdwEoxOZLRyG58kkT885eS');

echo $pswv;
if ($pswv)
{
    if ($utype == 'administrator')
    {
      header('Location:admin_home.php');
    }
    else
    {
      header('Location:student_home.php');
    }
}
else
{
  $error = 'Error validating username or password on the database.';
  include 'error.html.php';
  exit();
}
 ?>
