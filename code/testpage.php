<?php

echo insertvalues(6,15,0);

function insertvalues($vb, $ve, $v)
{
  //$vb - start value, $ve - end value, $v - verified value
//this PHP function inserts hard coded values. I have written this for testing purpose.
//only username field is unique so u can change the student# i.e #-put a number
//this can be done to add more administrators too.
//same code when modified, can add books
  include $_SERVER['DOCUMENT_ROOT'] . '/projecttest/includes/db.inc.php';
/*
$suusername = 'student3';
$supsw = 'Student3';
$supswhash = password_hash($supsw,PASSWORD_DEFAULT);
$sfirstname = 'harrison3';
$slastname = 'mbugi3';
$phone = 1234567893;
$street = '25 E Pearson St';
$city = 'Chicago';
$state = 'IL';
$zipcode = 60603;
$secret = 'I am student3';
$verified = 1;
$utype = 'student';
*/
  $count = 0;
  while ($vb <= $ve)
  {
    $suusername = 'student'.$vb;
    $supsw = 'Student'.$vb;
    $supswhash = password_hash($supsw,PASSWORD_DEFAULT);
    $sfirstname = 'harrison'.$vb;
    $slastname = 'mbugi'.$vb;
    $phone = 1234567893;
    $street = '25 E Pearson St';
    $city = 'Chicago';
    $state = 'IL';
    $zipcode = 60603;
    $secret = 'I am student'.$vb;
    $verified = $v;
    $utype = 'student';

    try
    {
      $sql = "INSERT INTO $utype(username, psw, sfirstname, slastname, phone, street, city, state, zipcode, secret, verified)
      VALUES('$suusername','$supswhash','$sfirstname','$slastname','$phone','$street','$city','$state','$zipcode', '$secret', $verified)";

      $result = $pdo->query($sql);
    }
    catch (PDOException $e)
    {
      return "error inserting $vb. " . $e->getMessage();
    }
    $vb += 1;
    $count += 1;

  }
  return "Done. $count inserts";
}
 ?>
