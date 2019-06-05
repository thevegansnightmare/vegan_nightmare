<?php require_once"config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forum</title>

    <!-- Bootstrap -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>
<body>


<div class="col-md-5">
    <form method="POST">

        <div class="card">
            <div class="card-header bg-white font-weight-bold">
                Blog aanmaken
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Titel</label>
                    <input type="text" class="form-control" id="loginInput" name="entry_title">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Uittreksel</label>
                    <textarea class="form-control" name="entry_content" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Inhoud</label>
                    <textarea class="form-control" name="entry_excerpt" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Auteur</label>
                    <input type="text" class="form-control" id="loginInput" name="entry_author">
                </div>
                <div class="card-footer bg-white">
                    <input type="submit" class="btn btn-primary" name="submit" value="Publiceren">
                </div>
            </div>
        </div>

    </form>
</div>

</center>
</div>


<?php
require 'header.php';

// kijk als de user is ingelogd, zoniet verwijs hem naar de login pagina
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// lees alle formuliervelden
$title   =  isset($_POST['entry_title']) && trim($_POST['entry_title'])!='' ? $_POST['entry_title'] : '';
$content =  isset($_POST['entry_content']) && trim($_POST['entry_content'])!='' ? $_POST['entry_content'] : '';
$excerpt =  isset($_POST['entry_excerpt']) && trim($_POST['entry_excerpt'])!='' ? $_POST['entry_excerpt'] : '';
$author  =  isset($_POST['entry_author']) && trim($_POST['entry_author'])!='' ? $_POST['entry_author'] : '';

// controleer of alle formuliervelden waren ingevuld
if (strlen($title)   > 0 &&
    strlen($content)    > 0 &&
    strlen($excerpt)   > 0 &&
    strlen($author)  	   > 0) {


    $query = "INSERT INTO entries
 				  (entry_title, entry_content, entry_excerpt, entry_author)
 				  VALUES (
 				  '$title',
 				  '$content',
 				 '$excerpt',
 				  '$author')";

    // voer de query uit
    $result = mysqli_query($link, $query);

    // controleer het resultaat
    if ($result) {
        //alles OK, stuur terug naar de homepage
        header("Location:index.php");
        exit;
    }
    else
    {
        echo 'Er ging wat mis met het toevoegen!';
    }
}



?>
<!-- Main -->
<div class="alert alert-secondary" role="alert">
    <h1 class="alert alert-dark" role="alert">Meest recente blogs</h1>
    <?php
    $sql = "SELECT * FROM Forum";
    $result = mysqli_query($link, $sql);
    $queryResults = mysqli_num_rows($result);

    if($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>
						<h3>".$row['entry_title']."</h3>
						<p>".$row['entry_content']."</p>
						<p>".$row['entry_excerpt']."</p>
						<p>".$row['entry_date']."</p>
						<p>".$row['entry_author']."</p>
						<hr>
					</div>";
        }
    }
    ?>
</div>


</body>
</html>
