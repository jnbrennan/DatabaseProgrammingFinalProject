<?php
// Start the session
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

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
  $owner = $_SESSION['username'];



  //Check if table book is empty then assign starting AUTO_INCREMENT bookid value
  try
  {
    //Starting transaction
    $pdo->beginTransaction();

    //counting number of rows on book table
    $sql = "SELECT COUNT(*) FROM book";
    $s = $pdo->query($sql);
    $row = $s->fetch();
    if ($row[0] < 1)
    {
      //Book table is empty so we set the initial AUTO_INCREMENT value
        $sql1 = "ALTER TABLE book AUTO_INCREMENT=100000001;";
        $s1 = $pdo->query($sql1);
    }
    // end of Check if table book is empty then assign starting AUTO_INCREMENT bookid value

    //Inserting book information to the database
      $sql3 = "INSERT INTO book(isbn, title, afirstname, alastname, publicationdate, borrowed, active, username)
      VALUES('$isbn','$title','$afirstname','$alastname','$publicationdate', 0, 1, '$owner')";

      $result = $pdo->query($sql3);
      $pdo->commit();
      header("Location:add_book.php?error=Book added successfully.");
  }
  catch (PDOException $e)
  {
    $pdo->rollback();
    $error = 'Error inserting book information to the database: ' . $e->getMessage();
    header("Location:add_book.php?error=$error");
  }

}

else
{
    header('Location: add_book.php');
}

?>
