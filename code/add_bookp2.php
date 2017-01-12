<?php
// Start the session
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/projecttest/includes/db.inc.php';

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
}




if (isset($_POST['addbook'])) //checking if the addbook form was submitted
{
  $isbn = trim($_POST['isbn']);
  $title = trim($_POST['title']);
  $afirstname = trim($_POST['afirstname']);
  $alastname = trim($_POST['alastname']);
  $publicationdate = trim($_POST['publicationdate']);
  $borrowed = 0;
  $owner = $_SESSION['username'];

  //Starting transaction
  $pdo->beginTransaction();

  //Check if table book is empty then assign starting AUTO_INCREMENT bookid value
  try
  {
    $sql = "SELECT COUNT(*) FROM book";
    $s = $pdo->query($sql);
  }
  catch (PDOException $e)
  {
    $error = 'Unable to count rows in table book. Try signing up again';
    include 'error.html.php';
    exit();
  }
  $row = $s->fetch();
  if ($row[0] < 1)
  {
    //Book table is empty so we set the initial AUTO_INCREMENT value
    try
    {
      $sql1 = "ALTER TABLE book AUTO_INCREMENT=100000001;";
      $s1 = $pdo->exec($sql1);
    }
    catch (PDOException $e)
    {
      $error =  'Unable to initiate AUTO_INCREMENT value. Try signing up again';
      include 'error.html.php';
      exit();
    }
  }
  // end of Check if table book is empty then assign starting AUTO_INCREMENT bookid value

  //Inserting book information to the database
  try
  {
    $sql3 = "INSERT INTO book(isbn, title, afirstname, alastname, publicationdate, borrowed, bookid)
    VALUES('$isbn','$title','$afirstname','$flastname','$publicationdate','$borrowed','$owner')";

    $result = $pdo->query($sql3);
  }
  catch (PDOException $e)
  {
    $error = 'Error inserting book information to the database: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

}

else
{
    header('Location: add_book.php');
}

?>
