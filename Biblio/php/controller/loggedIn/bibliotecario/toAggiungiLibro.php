<?php
/****
include_once '/home/amm/development/Biblio/php/Settings.php';
Settings::setPaths(basename(__DIR__));

include_once Settings::$bibliotecarioControllerPath;
***/

include_once 'bibliotecarioController.php';


/*****
if(session_status()!=2)
            session_start();
include_once $_SESSION['bibliotecarioControllerPath'];
*****/

  

bibliotecarioController::aggiornaMaster('aggiungiLibro');

?>

