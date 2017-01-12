
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';




if (isset($_POST['forgotpsw']) and isset($_POST['fpusername']) and isset($_POST['fputype']))
{
  $fpusername = trim($_POST['fpusername']);
  $fpsecret = trim($_POST['fpsecret']);
  $fpphone = trim($_POST['fpphone']);
  $fpzipcode = trim($_POST['fpzipcode']);
  $fputype = trim($_POST['fputype']);


//Check if user exist in the database. If doesn't exist redirect to login page
  function UserExists($u, $ut)
  {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
    try
    {
      $sql = "SELECT COUNT(*) FROM $ut WHERE username = :u";
      $s = $pdo->prepare($sql);
      $s->bindValue(':u', $u);
      $s->execute();
    }
    catch (PDOException $e)
    {
      return 'UserExists system error. Try again';
    }


    if ($s.rowCount > 0)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  if (UserExists($fpusername,$fputype) == FALSE) //always redirecting even though this is not correct
  {
    header('Location:login.php?error=Username not found. Sign Up Now if not yet a user');
  }
  elseif (UserExists($fpusername,$fputype) != TRUE AND UserExists($fpusername,$fputype) != FALSE)
  {
    $error = UserExists($fpusername,$fputype);
    header("Location:signup.php?error=$error");
  }

  else
  {
    try
    {
      $sql = "SELECT username, secret, phone, zipcode FROM $utype WHERE username = $fpusername";
      $row = $pdo->query($sql);

    }
    catch (Exception $e)
    {
      header('Location:login.php?error=Select username failed. Sign Up Now if not yet a user');
    }

  }



  try
  {
    $sql = "INSERT INTO $suutype(username, psw, sfirstname, slastname, phone, street, city, state, zipcode, secret, verified)
    VALUES('$suusername','$supswhash','$sfirstname','$slastname','$phone','$street','$city','$state','$zipcode', '$secret', 1)";

    $result = $pdo->query($sql);

  }
  catch (PDOException $e)
  {
    $error = 'Error inserting your information to the database: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  header('Location: login.php');

}


?>

</body>
</html>
