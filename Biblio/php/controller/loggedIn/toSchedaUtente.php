<?php

include_once 'lettore/lettoreController.php';
include_once 'bibliotecario/bibliotecarioController.php';



/****
if(session_status()!=2)
            session_start();
include_once $_SESSION['lettoreControllerPath'];
include_once $_SESSION['bibliotecarioControllerPath'];
***/


if(isset($_REQUEST))
{
    $_REQUEST['auxUtente'] = UtenteFactory::caricaUtentePerId($_REQUEST['utenteId']);

    if($_REQUEST['ruolo']=='lettore')
        lettoreController::aggiornaMaster('schedaBiblioteca');
    else if($_REQUEST['ruolo']=='bibliotecario')
        bibliotecarioController::aggiornaMaster('schedaUtente');
}
else
    lettoreController::aggiornaMaster(' ');


?>
