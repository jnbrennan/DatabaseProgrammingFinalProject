
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/projecttest/includes/db.inc.php';




if (isset($_POST['signup']) and isset($_POST['suusername']) and isset($_POST['suutype']))
{
  $suusername = trim($_POST['suusername']);
  $supswhash = password_hash(trim($_POST['supsw']),PASSWORD_DEFAULT);
  $suutype = trim($_POST['suutype']);
  $psw = trim($_POST['supsw']);
  $sfirstname = trim($_POST['sfirstname']);
  $slastname = trim($_POST['slastname']);
  $phone = trim($_POST['phone']);
  $street = trim($_POST['street']);
  $city = trim($_POST['city']);
  $state = trim($_POST['state']);
  $zipcode = trim($_POST['zipcode']);
  $secret = trim($_POST['secret']);

//Check if user exist in the database. If exist redirect to login page
function UserExists($u, $ut)
{
  include $_SERVER['DOCUMENT_ROOT'] . '/projecttest/includes/db.inc.php';
  try
  {
    $sql = "SELECT COUNT(*) FROM $ut WHERE username = :u";
    $s = $pdo->prepare($sql);
    $s->bindValue(':u', $u);
    $s->execute();
  }
  catch (PDOException $e)
  {
    return 'UserExists system error. Try signing up again';
  }

  $row = $s->fetch();

  if ($row[0] > 0)
  {
    return TRUE;
  }
  else
  {
    return FALSE;
  }
}

if (UserExists($suusername,$suutype) == TRUE)
{
  header('Location:login.php');
}
elseif (UserExists($suusername,$suutype) != TRUE AND UserExists($suusername,$suutype) != FALSE)
{
  $error = UserExists($suusername,$suutype);
  header("Location:signup.php?error=$error");
}



  echo "$suusername\n$supswhash\n$suutype";//for testing purpose. to be deleted later

  try
  {
    $sql = "INSERT INTO $suutype(username, psw, sfirstname, slastname, phone, street, city, state, zipcode, secret, verified)
    VALUES('$suusername','$supswhash','$sfirstname','$slastname','$phone','$street','$city','$state','$zipcode', '$secret', 1)";

    $result = $pdo->query($sql);
    echo "signed up";//for testing purposes. to be deleted later
  }
  catch (PDOException $e)
  {
    $error = 'Error inserting your information to the database: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  header('Location: login.php');

}

/*
//we don't need this since username and password input fileds are required
else
{
  $error = 'Username or password field can not be empty: ';
  include 'error.html.php';
  exit();
}
*/

?>

</body>
</html>
