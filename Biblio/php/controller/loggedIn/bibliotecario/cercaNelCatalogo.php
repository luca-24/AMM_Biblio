<?php

include_once 'bibliotecarioController.php';

    if(isset($_REQUEST))
    { 
        if($_REQUEST['tipoFiltroL']=='titolo')
        {
            $_REQUEST['titolo'] = $_REQUEST['parRicercaLibro'];
            bibliotecarioController::aggiornaMaster('cercaPerTitoloNelCatalogo');
        }
        else if($_REQUEST['tipoFiltroL']=='autore')
        {
            $_REQUEST['autore'] = $_REQUEST['parRicercaLibro'];
            bibliotecarioController::aggiornaMaster('cercaPerAutoreNelCatalogo');
        }
    }
    else
        bibliotecarioController::aggiornaMaster(' ');
?>
