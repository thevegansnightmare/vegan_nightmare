<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/index-style.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css?family=VT323&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js"></script>
    <title>Characters</title>
  </head>
  <body>
    <div class="menudiv">
      <ul class="menuul">
        <li>
          <main class="container">
            <a class="myButt one" href="/index.html">
              <div class="insider"></div>
              Home
            </a>
          </main>
        </li>
        <li>
          <main class="container">
            <a class="myButt one" href="/overons/index.html">
              <div class="insider"></div>
              Over ons
            </a>
          </main>
        </li>
        <li>
          <main class="container">
            <a class="myButt one" href="index.php">
              <div class="insider"></div>
              Characters
            </a>
          </main>
        </li>

        <li>
          <main class="container">
            <a class="myButt one" href="/contact/index.html">
              <div class="insider"></div>
              Contact
            </a>
          </main>
        </li>
        <li>
          <main class="container">
            <a class="myButt one" href="/inlog_uitlog/index.html">
              <div class="insider"></div>
              Inlog
            </a>
          </main>
        </li>
        <li>
          <main class="container">
            <a class="myButt one" href="/game/index.html" style="color:red">
              <div class="insider"></div>
              Game
            </a>
          </main>
        </li>
      </ul>
    </div>

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
      echo "<div style='margin: 150px auto;'></div>";
      while($rij = mysqli_fetch_array($result))
      {

        echo "<div class='container row' style='width: 1500px; margin: 0px auto;'>";

        echo "<img class='col-4' src='../../images/".$rij['img']."' alt='".$rij['img']."' />";

        echo "<table class='col-8 flat-table flat-table-2'>";

        echo "<tr><th>Character Naam&colon; </th>
        <td>".$rij['Char_Naam']."</td></tr>";

        echo "<tr><th>Achtergrond verhaal&colon; </th>
        <td>".$rij['Backstory']."</td></tr>";

        echo "<tr><th rowspan='3'>Stats&colon; </th>
        <td>
        <div class='progress'><div class='progress-bar bg-success' role='progressbar' style='width: ".$rij['Offensive']."%' aria-valuenow='".$rij['Offensive']."' aria-valuemin='0' aria-valuemax='100'></div></div>Aanval&colon; ".$rij['Offensive']."&percnt;</td></tr>";

        echo "<tr><td>
        <div class='progress'><div class='progress-bar bg-success' role='progressbar' style='width: ".$rij['Defensive']."%' aria-valuenow='".$rij['Defensive']."' aria-valuemin='0' aria-valuemax='100'></div></div>Verdediging&colon; ".$rij['Defensive']."&percnt;</td></tr>";

        echo "<tr><td>
        <div class='progress'><div class='progress-bar bg-success' role='progressbar' style='width: ".$rij['Tactical']."%' aria-valuenow='".$rij['Tactical']."' aria-valuemin='0' aria-valuemax='100'></div></div>Taktisch&colon; ".$rij['Tactical']."&percnt;</td></tr>";

        echo "</table>";
        echo "</div>";
        echo "<hr>";
      }

    }
     ?>
  </body>
</html>
