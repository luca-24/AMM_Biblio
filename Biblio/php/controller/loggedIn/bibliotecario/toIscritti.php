<?php

include_once 'bibliotecarioController.php';

/****
if(session_status()!=2)
            session_start();
include_once $_SESSION['bibliotecarioControllerPath'];
****/

bibliotecarioController::aggiornaMaster('iscritti');

?>

