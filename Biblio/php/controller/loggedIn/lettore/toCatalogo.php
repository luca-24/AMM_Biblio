<?php
include_once 'lettoreController.php';

/***
if(session_status()!=2)
            session_start();
include_once $_SESSION['lettoreControllerPath'];
*****/

if(isset($_REQUEST))
{
    $_REQUEST['biblioteca'] = UtenteFactory::caricaUtentePerId($_REQUEST['bibliotecaId']);
    lettoreController::aggiornaMaster('catalogoBiblioteca');
}
else
    lettoreController::aggiornaMaster(' ');



?>
