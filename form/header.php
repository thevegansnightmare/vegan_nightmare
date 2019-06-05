<?php require_once"config.php";
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<!-- meta tags -->
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!------------------------------------------------------------------>

	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
	<!------------------------------------------------------------------>

</head>
<body>

	<!-- Navbar -->
  <?php 
 
  if(isset($_SESSION['id'])){?>  <!-- ben je ingelogd? Zoja laat hetvolgende ingelogd -->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">

      <a class="navbar-brand" href="index.php">Pol-lepel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="recepten.php">Gerechten</a></li>
          <li class="nav-item"><a class="nav-link" href="basistechnieken.php">Basistechnieken</a></li>
          <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php?id=?>">Profiel</a></li>
        </ul>

        <form class="form-inline my-2 my-lg-0" action="search.php" method="POST">
          <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit-search">Search</button>
        </form>  
      </div>
    </nav>

  <?php } else { ?> <!--Niet ingelogd? laat deze navbar zien:-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">

    <a class="navbar-brand" href="index.php">Pol-lepel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav mr-auto">

        <li class="nav-item"><a class="nav-link" href="recepten.php">Gerechten</a></li>
        <li class="nav-item"><a class="nav-link" href="basistechnieken.php">Basistechnieken</a></li>
        
        <li class="nav-item"><a class="nav-link" href="login.php">Inloggen</a></li>

      </ul>

      <form class="form-inline my-2 my-lg-0" action="search.php" method="POST">
        <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit-search">Search</button>
      </form>
    </div>
  </nav>


  <?php } ?>