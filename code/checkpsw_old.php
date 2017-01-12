<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//declaring variables
$username = trim($_POST['username']);
$psw = trim($_POST['psw']);
$utype = $_POST['utype'];

//Checking if the administrator table is empty then add the initial administrator account
if ($utype == 'administrator')
{
  try
  {
    $sql = "SELECT COUNT(*) FROM $utype";
    $s = $pdo->query($sql);
  }
  catch (PDOException $e)
  {
    header('Location:login.php?error=Ooppss!! Sorry, login again');
  }

  $row = $s->fetch();

  if ($row[0] < 1)
  {
    $suusername = 'administrator1';
    $supsw = 'Administrator1';
    $supswhash = password_hash($supsw,PASSWORD_DEFAULT);
    $sfirstname = 'harrison';
    $slastname = 'mbugi';
    $phone = 1234567890;
    $street = '25 E Pearson St';
    $city = 'Chicago';
    $state = 'IL';
    $zipcode = 60601;
    $secret = 'I am adminstrator1';

    try
    {
      $sql = "INSERT INTO $utype(username, psw, sfirstname, slastname, phone, street, city, state, zipcode, secret)
      VALUES('$suusername','$supswhash','$sfirstname','$slastname','$phone','$street','$city','$state','$zipcode', '$secret')";

      $result = $pdo->query($sql);
    }
    catch (PDOException $e)
    {
      header('Location:login.php?error=Ooppss!! Sorry, login again');
    }
  }

}//end of checking if the administrator table is empty then add the initial administrator account

//Fetching user information from the database
try
{
  $sql = "SELECT * FROM $utype WHERE username = :username";
  $s = $pdo->prepare($sql);
  $s->bindValue(':username', $username);
  $s->execute();
}
catch (PDOException $e)
{
  header('Location:login.php?error=Error searching for user on the database. Login again');
}

$row = $s->fetch();

//check if user was found in the database. If not prompt for signup
if ($username != $row['username'])
{
  header('Location:signup.php?error=User not in the database');
}

//check if user is verified
if ($utype == 'student' AND $row['verified'] == 0)
{
  $error = 'Verify your account or contact administrator';
  include 'error.html.php';
  exit();
}

//testing. delete the next two lines later
//$dbpsw = $row['psw'];
//echo "$username\n$psw\n$utype";
//if (password_verify($psw, $dbpsw)){echo"True bhana";}
//end of test code

//Verifying entered password with the db stored password
if (password_verify($psw, $row['psw']))
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
  header("Location:login.php?error=$error");
}

 ?>
