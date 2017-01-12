<?php
include "checkpsw.php";
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
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

  <div class="logincls">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" id="username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="psw" name="psw" required><br>
    <br>
    <!--utype is for usertype(i.e administrator or student) -->
    <input type="radio" name="utype" id="utypes" value="student" checked>
    <label for="utypes">Student</label>
    <input type="radio" name="utype" id="utypea" value="administrator">
    <label for="utypea">Administrator</label>

    <div>
      <br><br>
      <input type="submit" name="login" id="login" value="login"><br><br>
      <a href="signup.php">New User?</a>
    </div>
  </div>

</form>
</center>
</body>
</html>