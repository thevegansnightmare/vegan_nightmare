<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Characters</title>
  </head>
  <body>
    <?php
    require "config.php";
    //alles ophalen uit DB
    $query = "select * from Characters";
    //query uitvoeren
    $result = mysqli_query($mysqli, $query);
    //is er resultaat
    if(mysqli_num_rows($result) == 0)
    {
      echo "<p>Er zijn geen resultaten gevonden.</p>";
    }
    else
    {

      while($rij = mysqli_fetch_array($result))
      {
        echo "<table border='1'>";

        echo "<tr><th>Character Naam&colon; </th>
        <td>".$rij['Char_Naam']."</td></tr>";

        echo "<tr><th>Achtergrond verhaal Naam&colon; </th>
        <td>".$rij['Backstory']."</td></tr>";

        echo "<tr><th rowspan='3'>Stats Naam&colon; </th>
        <td>
        <div class='progress'><div class='progress-bar' style='width: ".$rij['Offensive']."%' aria-valuenow='".$rij['Offensive']."' aria-valuemin='0' aria-valuemax='100'></div></div> ".$rij['Offensive']."&percnt;</td></tr>";

        echo "<tr><td>
        <div class='progress'><div class='progress-bar' style='width: ".$rij['Defensive']."%' aria-valuenow='".$rij['Defensive']."' aria-valuemin='0' aria-valuemax='100'></div></div> ".$rij['Defensive']."&percnt;</td></tr>";

        echo "<tr><td>
        <div class='progress'><div class='progress-bar' style='width: ".$rij['Tactical']."%' aria-valuenow='".$rij['Tactical']."' aria-valuemin='0' aria-valuemax='100'></div></div> ".$rij['Tactical']."&percnt;</td></tr>";

        echo "</table>";
        echo "<hr>";
      }

    }
     ?>
  </body>
</html>
