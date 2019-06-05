<?php

//start session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// if ($_SESSION['ip'] == $_SERVER["REMOTE_ADDR"])
// {
  //als gebruiker niet is ingelogd
  if (!isset($_SESSION['gebr']))
  {
    //terug sturen
    // header("location: ../login.html");
    echo "geen gebrNaam <br>";
  }

  session_regenerate_id();

  if ((time() - 10000) > $_SESSION['timestamp'])
  {
    // header("location: uitlog.php");
    echo "Fout bij session timestamp of lang niets gedaan<br>";
  }
  else
  {
    $_SESSION['timestamp'] = time();
  }
// }
// else
// {
//   header("location: uitlog.php");
//   echo "Fout bij vergelijking ip en REMOTE_ADDR<br>";
// }

 ?>
