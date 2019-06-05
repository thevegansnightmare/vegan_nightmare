<?php
session_start();
//verwijder alle bestaande sessies
session_destroy();
//verwijzing naar inlog.php
header("location: ../login.html");
