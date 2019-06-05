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
          echo "<p>Uw bericht is verzonden en ontvangen.</p><br>";
          echo "<p><a href='../../index.html'>Hier</a> kunt u terug gaan naar de Homepage van de site.</p><br>";

          if(!empty($_POST))
          {
            mail($to, $ond, $mailinhoud);
          }
        }
        else
        {
          echo "<p>Uw bericht is niet verzonden, er is een fout in het verzenden.</p><br>";
          echo "<p><a href='../../index.html'>Hier</a> kunt u terug gaan naar de Homepage van de site.</p><br>";
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
        {
          echo "<p>Uw bericht is verzonden en ontvangen, er is ook een mail gestuurd naar  u.</p><br>";
          echo "<p><a href='../../index.html'>Hier</a> kunt u terug gaan naar de Homepage van de site.</p><br>";

          if(!empty($_POST))
          {
            mail($to, $ond, $mailinhoud);
          }
        }
        else
        {
          echo "<p>Uw bericht is niet verzonden, er is een fout in het verzenden</p><br>";
          echo "<p><a href='../../index.html'>Hier</a> kunt u terug gaan naar de Homepage van de site</p><br>";
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
