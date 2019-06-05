<?php

//start session
session_start();

if ($_SESSION['ip'] == $_SERVER["REMOTE_ADDR"])
{
  //als gebruiker niet is ingelogd
  if (!isset($_SESSION['gebr']))
  {
    //terug sturen
    header("location: ../login.html");
  }

  session_regenerate_id();

  if ((time() - 10) > $_SESSION['timestamp'])
  {
    header("location: uitlog.php");
  }
  else
  {
    $_SESSION['timestamp'] = time();
  }
}
else
{
  header("location: uitlog.php");
}

 ?>
