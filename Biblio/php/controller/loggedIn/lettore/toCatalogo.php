<?php
include_once 'lettoreController.php';

if(isset($_REQUEST))
{
    $_REQUEST['biblioteca'] = UtenteFactory::caricaUtentePerId($_REQUEST['bibliotecaId']);
    lettoreController::aggiornaMaster('catalogoBiblioteca');
}
else
    lettoreController::aggiornaMaster(' ');



?>
