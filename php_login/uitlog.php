<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
//verwijder alle bestaande sessies
session_destroy();
//verwijzing naar inlog.php
header("location: ../login.html");
