<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/projecttest/includes/db.inc.php';
session_start();

if (!isset($_POST['changepsw'])) {
  header("Location: changepsw.php");
}

$cppsw = password_hash(trim($_POST['cppsw']),PASSWORD_DEFAULT);
$fpusername = trim($_POST['fpusername']);
$fputype = trim($_POST['fputype']);

try
{
  $sql = "UPDATE $fputype SET psw=:cppsw";
  $s = $pdo->prepare($sql);
  $s->bindValue(':cppsw', $cppsw);
  $s->execute();
}
catch (PDOException $e)
{
  header('Location:changepsw.php?error=Error updating the database. Try again');
}
if ($fputype == administrator)
{
  header('Location:admin_home.php');
}
else
{
  header('Location:student_home.php');
}
 ?>
