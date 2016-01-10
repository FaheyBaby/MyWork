<?php
      session_start();
      if (!isset($_SESSION["user_login"]))
      {

      }
      else 
      {
            $username = $_SESSION['user_login'];
      } 
?>

<!-- THIS PAGE WAS CREATED BY GAVIN FAHEY -->
<!DOCTYPE html>
<html>
<head>
      <!-- LINKING FONTS AND CSS AND JAVASCRIPT TO MY HTML -->
	<link rel="stylesheet" type="text/css" href="css/debate.css">
	<link href='https://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway:800' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="js/debate.js"></script>
	<title>theDEBATE</title>
</head>