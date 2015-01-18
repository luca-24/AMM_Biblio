<?php

include_once 'bibliotecarioController.php';

/****
if(session_status()!=2)
            session_start();
include_once $_SESSION['bibliotecarioControllerPath'];
****/

/*******************

//echo "toProfilo; session path: ".$_SESSION['UtenteFactoryPath'];
include_once $_SESSION['UtenteFactoryPath'];
$p = UtenteFactory::caricaUtentePerId(2);
echo $p->getCognome();
return;

/*****************/

bibliotecarioController::aggiornaMaster('profilo');

?>

