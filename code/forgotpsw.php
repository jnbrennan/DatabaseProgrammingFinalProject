<!DOCTYPE html>
<html>
<head>
   <title>SignUp</title>
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
<h3>Forgot Password Form</h3>
<form action="forgotpswp.php" method="post">
 <div>
   <label for="fpusername"><b>Username:</b></label>
   <input type="text" placeholder="Enter Username" id="fpusername" name="fpusername" required><br>

   <label for="fpsecret"><b>Secret:</b></label>
   <input type="password" placeholder="Enter account recovery phrase" id="fpsecret" name="fpsecret"
   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Account recovery phrase contain at least;&#13; *one number&#13; *one uppercase&#13; *lowercase letter&#13; *minimum 8 characters" required><br>

   <label for="fpphone"><b>Phone: </b></label>
   <input type="number" placeholder="Enter your phone number" id="fpphone" name="fpphone"
   pattern=".{10}" title="Phone number must have ten digits" required><br>

   <label for="fpzipcode"><b>Zipcode: </b></label>
   <input type="number" placeholder="Enter your zipcode eg 12345, 56789" id="fpzipcode" name="fpzipcode"
   pattern=".{5}" title="Zipcode need to have five digits" required><br>
   <br>
   <!--utype is for usertype(i.e administrator or student) -->
   <input type="radio" name="fputype" id="fputypes" value="student" checked>
   <label for="utypes">Student</label>
   <input type="radio" name="fputype" id="fputypea" value="administrator">
   <label for="utypea">Administrator</label>

   <br><br>

   <div>
     <input type="button" id="fpback" name="fpback" value="back"
     onclick="window.location.href='login.php'"> &emsp;

     <input type="submit" name="forgotpsw" id="forgotpsw" value="recover account"><br><br>

   </div>
 </div>

</form>
<?php include_once "googletranslator.php"; ?>
</center>
</body>
</html>
