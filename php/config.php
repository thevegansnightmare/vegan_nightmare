<?php
// database logingegevens
$db_hostname = '192.168.88.45';
$db_username = 'vampire1';
$db_password = '#1Geheim';
$db_database = 'vampire';

// maak de database-verbinding
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if ($mysqli === false)
{
  die("ERROR: Kan niet verbinden.". mysqli_connect_error());
}

?>
