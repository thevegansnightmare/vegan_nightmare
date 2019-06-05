<?php


// Kijk of de user als is ingelogd, is dit het geval verwijs hem dan naar de home pagina
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// toevoegen van config file
require_once "config.php";
 
// definiëren van variabelen en ervoor zorgen dat deze leeg zijn
$username = $password = "";
$username_err = $password_err = "";
 
// processeren van het formulier wanneer deze verstuurd word
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // controleer of er een gebruikersnaam is ingevoerd 
    if(empty(trim($_POST["username"]))){
        $username_err = "<p style='color: red; text-align: center'>Vul een gebruikersnaam in.</p>";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // controleer of er een wachtwoord is ingevoerd
    if(empty(trim($_POST["password"]))){
        $password_err = "<p style='color: red; text-align: center'>Vul een wachtwoord in.</p>";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // controleren van variabelen
    if(empty($username_err) && empty($password_err)){
        // maak een statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // koppel de variabelen aan de prepared statements als parameters 
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameter
            $param_username = $username;
            
            // probeer de prepared statement uit te voeren
            if(mysqli_stmt_execute($stmt)){
                // sla het resultaat op
                mysqli_stmt_store_result($stmt);
                
                // bekijk als de gebruikersnaam bestaat, is dit het geval verifieer de ingevoerde wachtwoorden
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // combineer de resultaten met de onderstaande variabelen
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // het wachtwoord is correct, start hierdoor een nieuwe sessie
                            session_start();
                            
                            // sla de data op in de volgende variabelen
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // verwijs de gebruiker naar de home pagina
                            header("location: index.php");
                        } else{
                            //laat deze melding zien als het wachtwoord niet bestaat
                            $password_err = "<p style='color: red; text-align: center'> Het wachtwoord dat u heeft ingevoerd is onjuist.</p>";
                        }
                    }
                } else{
                    // de error voor als de gebruikernaam niet bestaat
                    $username_err = "<p style='color: red; text-align: center'> Geen account gevonden met deze gebruikernaam.</p>";
                }
            } else{
                echo "<p style='color: red; text-align: center'> Er is iets verkeerd gegaan, probeer het alstublieft later opnieuw.</p>";
            }
        }
        
        // afsluiten statement
        mysqli_stmt_close($stmt);
    }
    
    // afsluiten connection
    mysqli_close($link);
}
?>

<center>
    <div class="col-md-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="card">
                <div class="card-header bg-white font-weight-bold">
                    <h2>Login</h2>
                    <p>Vul de onderstaande velden in om in te loggen.</p>
                </div>

                 <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" class="form-control" placeholder="Gebruikersnaam" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password"  placeholder="Wachtwoord" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="card-footer bg-white">
                <input type="submit" class="btn btn-primary" value="Inloggen">
            </div>
            <p>Heeft u nog geen account? <a href="register.php">Maak er dan snel één aan</a>!</p>
        </div>
        </form>
    </div>   
</center> 
