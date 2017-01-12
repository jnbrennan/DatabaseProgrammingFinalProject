 <!DOCTYPE html>
<html>
<head>
    <title>SignUp</title>
</head>
<body>

<!--
sucls - signup class
suusername - signup username
supsw - signup password
-->
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
  <h3>Sign Up Now</h3>
<form action="signupp.php" method="post">

  <div>
    <label for="suusername"><b>Username:</b></label>
    <input type="text" placeholder="Enter Username" id="suusername" name="suusername" required><br>

    <label for="supsw"><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" id="supsw" name="supsw"
    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least;&#13; *one number&#13; *one uppercase&#13; *lowercase letter&#13; *minimum 8 characters" required><br>

    <label for="secret"><b>Secret:</b></label>
    <input type="password" placeholder="Enter account recovery phrase" id="secret" name="secret"
    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Account recovery phrase contain at least;&#13; *one number&#13; *one uppercase&#13; *lowercase letter&#13; *minimum 8 characters" required><br>

    <label for="sfirstname"><b>Firstname: </b></label>
    <input type="text" placeholder="Enter your first name" id="sfirstname" name="sfirstname" required><br>

    <label for="slastname"><b>Lastname: </b></label>
    <input type="text" placeholder="Enter your last name" id="slastname" name="slastname" required><br>

    <label for="phone"><b>Phone: </b></label>
    <input type="number" placeholder="Enter your phone number" id="phone" name="phone"
    pattern=".{10}" title="Phone number must have ten digits" required><br>

    <label for="street"><b>Street: </b></label>
    <input type="text" placeholder="Enter your street address" id="street" name="street" required><br>

    <label for="city"><b>City: </b></label>
    <input type="text" placeholder="Enter your city" id="city" name="city" required><br>

    <label for="state"><b>State: </b></label>
    <input type="text" placeholder="Enter your state eg. IL, CA" id="state" name="state"
    pattern="[A-Za-z]{2}" title="Two letters for state" required><br>

    <label for="zipcode"><b>Zipcode: </b></label>
    <input type="number" placeholder="Enter your zipcode eg 12345, 56789" id="zipcode" name="zipcode"
    pattern=".{5}" title="Zipcode need to have five digits" required><br>

    <br><br>

    <div>
      <input type="button" id="suback" name="suback" value="back"
      onclick="window.location.href='login.php'"> &emsp;

      <input type="submit" name="signup" id="signup" value="signup"><br><br>

    </div>
  </div>

</form>
<?php include_once "googletranslator.php"; ?>
</center>
</body>
</html>
