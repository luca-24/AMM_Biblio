<?php
/***
include_once '/home/amm/development/Biblio/php/Settings.php';
Settings::setPaths(basename(__DIR__));

include_once Settings::$bibliotecarioControllerPath;
***/

include_once 'bibliotecarioController.php';
/****
if(session_status()!=2)
            session_start();
include_once $_SESSION['bibliotecarioControllerPath'];

include_once $_SESSION['bibliotecarioControllerPath'];
*****/
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
