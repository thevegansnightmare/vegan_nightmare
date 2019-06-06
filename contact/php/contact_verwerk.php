<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Resizable Contact Form #GDGHamburg</title>
    <link
      href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:400,500,600,700,800,900"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body>
    <div class="menudiv"=>
      <ul class="menuul">
        <li>
          <main class="container">
            <a class="myButt one" href="../../index.html">
              <div class="insider"></div>
              Home
            </a>
          </main>
        </li>
        <li>
          <main class="container">
            <a class="myButt one" href="../../overons/index.html">
              <div class="insider"></div>
              Over ons
            </a>
          </main>
        </li>
        <li>
          <main class="container">
            <a class="myButt one" href="../../characters/index.html">
              <div class="insider"></div>
              Characters
            </a>
          </main>
        </li>

        <li>
          <main class="container">
            <a class="myButt one" href="../index.html">
              <div class="insider"></div>
              Contact
            </a>
          </main>
        </li>
        <li>
          <main class="container">
            <a class="myButt one" href="../../inlog_uitlog/index.html">
              <div class="insider"></div>
              Inlog
            </a>
          </main>
        </li>
        <li>
          <main class="container menu-game">
            <button class="myButt five">
              <div class="layer">Diee!</div>
              Game
            </button>
          </main>
        </li>
      </ul>
    </div>
    <div><!-- img --></div>
    <div id="content">

        <form
          class="c-form u-inline"
          method="post"
          action="php/contact_verwerk.php"
          style="margin-top:120px;"
        >
          <fieldset class="c-form__fieldset">
            <legend class="c-form__title u-uppercase">
    <?php
    require "config.php";
    //als op verzenden gedrukt is
    if(isset($_POST['verzend']))
    {
      //als alles is ingevuld
      if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['msg']))
      {
        //als email correct is
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
          //alle variabelen
          $email = $_POST['email'];
          $naam = $_POST['name'];
          $msg = $_POST['msg'];
          $ond = $_POST['subject'];
          //mailto vars
          $to = $email;
          $mailinhoud = "$naam

    $ond

    $msg";
          //als onderwerp leeg is
          if($ond == "")
          {
            //query maken voor invoeren
            $query = "insert into Contact(Naam, Email, Tekst)
            values('".$naam."', '".$email."', '".$msg."')";
            //als query goed is uitgevoerd
            if(mysqli_query($mysqli, $query) == true)
            {
              echo "<p>  GELUKT!</p>";
              ?>  </legend><legend class="contact-tekst"><?php
              echo "<p>Uw bericht is verzonden en ontvangen.</p><br>";

              if(!empty($_POST))
              {
                mail($to, $ond, $mailinhoud);
              }
            }
            else
            {
              echo "<p>Uw bericht is niet verzonden, er is een fout in het verzenden.</p><br>";
            }

          }
          //als onderwerp niet leeg is
          else
          {
            //query maken voor invoeren
            $query = "insert into Contact
            values(null, '".$naam."', '".$email."', '".$ond."', '".$msg."')";
            //als query goed is uitgevoerd
            if(mysqli_query($mysqli, $query) == true)
            {  echo "<p>  GELUKT!</p>";
              ?>  </legend><legend class="contact-tekst" style="color:green"><?php
              echo "<p>Uw bericht is verzonden en ontvangen, er is ook een mail gestuurd naar  u.</p><br>";


              if(!empty($_POST))
              {
                mail($to, $ond, $mailinhoud);
              }
            }
            else
            {
              echo "<p>Uw bericht is niet verzonden, er is een fout in het verzenden</p><br>";
            }
          }
        }
        //als email niet correct is
        else
        {
          echo "<p>Er is geen geldige email ingevuld</p><br>";
        }
      }
      //als 1 of meerdere niet is ingevuld
      else
      {
        echo "<p>1 of meerder velden zijn niet ingevuld</p><br>";
      }
    }
    //als er niet op Hit me is gedrukt
    else
    {
      echo "<p>Er is niet gedrukt op '<b>Hit me</b>'</p><br>";
    }

    ?>
    </legend>
  </fieldset>
</form>
 </div>
  </body>
</html>
