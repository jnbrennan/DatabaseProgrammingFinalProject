<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/projecttest/includes/db.inc.php';

session_start();

//if login form was not submitted, go to login page
if (!isset($_POST['login']))
{
  header('Location:login.php');
}

//declaring variables
$username = trim($_POST['username']);
$psw = trim($_POST['psw']);
//$psw = password_hash(trim($_POST['psw']),PASSWORD_DEFAULT);
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

//Verifying entered password with the db stored password
if (password_verify($psw, $row['psw']))
{
    //setting session variables
    $_SESSION['username'] = $username;
    $_SESSION['utype'] = $utype;

    //Setting cookies if Stay Signed In was checked on the login form
    if (isset($_POST['ssi']))
    {
      setcookie("username",$username,time()+(365 * 24 * 60 * 60));
      setcookie("utype",$utype,time()+(365 * 24 * 60 * 60));
    }

    //redirecting user to homepage based on the usertype
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
