<?php
session_start();
//Thinking about. delete if idea not used - this will autologin the user if stay signed in was checked on the last login and user never signed out
//setcookie(name,value,expire,path,domain,secure,httponly); eg: setcookie("myCookie", $value, time() + 3600);  expire after 1hr

//If user is already logged in, go to the home page
if(isset($_SESSION['username']) and isset($_SESSION['utype']))
{
   if ($_SESSION['utype'] == 'administrator')
	 {
		 header('Location:admin_home.php');
	 }
	 else
	 {
	 	 header('Location:student_home.php');
	 }

}
/*
if(count($_COOKIE) > 0) {
    echo "Cookies are enabled.";
} else {
    echo "Cookies are disabled.";
}
*/
//Autologin if stay signed in was checked on the last login and user never signed out
if (isset($_COOKIE['username']) and isset($_COOKIE['utype']) and !empty($_COOKIE['username']) and !empty($_COOKIE['utype']))
{
  if ($_COOKIE['utype'] == 'administrator')
  {
    header('Location:admin_home.php');
  }
  else
  {
    header('Location:student_home.php');
  }
}

/*
//combination of both ifs to get intergrated code
if ((isset($_SESSION['username']) and isset($_SESSION['utype'])) or (isset($_COOKIE['username']) and isset($_COOKIE['utype']) and !empty($_COOKIE['username']) and !empty($_COOKIE['utype'])))
{
  if (($_SESSION['utype'] == 'administrator') or ($_COOKIE['utype'] == 'administrator'))
  {
    header('Location:admin_home.php');
  }
  else
  {
    header('Location:student_home.php');
  }
}

*/

 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

  <center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <br>
    <p style="color:red; font-weight: bold">
      <?php
        $lsGet = $_GET;
        if (!isset($lsGet['error']))
        {
          $lsGet['error'] = " ";
        }
        echo $lsGet['error'];
        unset($lsGet['error']);
      ?>
    </p>
    <br><br>
<form action="checkpsw.php" method="post">

  <div class="logincls">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" id="username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="psw" name="psw"
    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
    <br>

    <!--utype is for usertype(i.e administrator or student) -->
    <input type="radio" name="utype" id="utypes" value="student" checked>
    <label for="utypes">Student</label>
    <input type="radio" name="utype" id="utypea" value="administrator">
    <label for="utypea">Administrator</label>



    <div>
      <br><br>
      <!-- Stay Signed In -->
      <input type="checkbox" name="ssi" id="ssi"> Stay Signed In<br>
      <input type="submit" name="login" id="login" value="login"><br><br>
      <a href="signup.php?error= ">New User?</a><br><br>
      <a href="forgotpsw.php">Forgot Password?<a>
    </div>
  </div>

</form>
<?php include_once "googletranslator.php"; ?>
</center>
</body>
</html>
