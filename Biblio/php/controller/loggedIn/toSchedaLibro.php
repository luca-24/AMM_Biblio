<?php

include_once 'lettore/lettoreController.php';
include_once 'bibliotecario/bibliotecarioController.php';



if(isset($_REQUEST))
{
    $_REQUEST['auxLibro'] = LibroFactory::caricaLibroPerId($_REQUEST['libroId']);
    if($_REQUEST['codiceScheda']!='inPrestito' && $_REQUEST['codiceScheda']!='prestati' && $_REQUEST['codiceScheda']!='singoloPrestato')
    {
        $_REQUEST['auxNCopie'] = $_REQUEST['nCopie'];
        $_REQUEST['auxDisp'] = $_REQUEST['disp'];
    }
    $_REQUEST['auxCodiceScheda'] = $_REQUEST['codiceScheda'];

    if(isset($_REQUEST['noleggianteId']))
        $_REQUEST['auxNoleggianteId'] = $_REQUEST['noleggianteId'];

    if($_REQUEST['ruolo']=='lettore')
        lettoreController::aggiornaMaster('schedaLibro');
    else if($_REQUEST['ruolo']=='bibliotecario')
        bibliotecarioController::aggiornaMaster('schedaLibro');
}
else
    lettoreController::aggiornaMaster(' ');


?>
