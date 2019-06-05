
<?php

if(isset($_SESSION['id'])){?>  <!-- ben je ingelogd? Zoja laat hetvolgende ingelogd -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="forum.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">log-out</a></li>
            </ul>

        </div>
    </nav>

<?php } else { ?> <!--Niet ingelogd? laat deze navbar zien:-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">

        <a class="navbar-brand" href="index.php">Pol-lepel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">



                <li class="nav-item"><a class="nav-link" href="login.php">Inloggen</a></li>

            </ul>

            <form class="form-inline my-2 my-lg-0" action="search.php" method="POST">
                <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit-search">Search</button>
            </form>
        </div>
    </nav>


<?php } ?>

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
$excerpt =  isset($_POST['entry_excerpt']) && trim($_POST['entry_excerpt'])!='' ? $_POST['entry_excerpt'] : '';
$author  =  isset($_POST['entry_author']) && trim($_POST['entry_author'])!='' ? $_POST['entry_author'] : '';

// controleer of alle formuliervelden waren ingevuld
if (strlen($title)   > 0 &&
    strlen($content)    > 0 &&
    strlen($excerpt)   > 0 &&
    strlen($author)  	   > 0) {


    $query = "INSERT INTO Forum
 				  (entry_title, entry_excerpt, entry_author)
 				  VALUES (
 				  '$title',
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
