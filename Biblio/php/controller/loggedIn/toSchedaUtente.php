<?php

include_once 'lettore/lettoreController.php';
include_once 'bibliotecario/bibliotecarioController.php';


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
