<?php

include_once 'lettoreController.php';


if(isset($_REQUEST))
{
    if($_REQUEST['cercaIn'] == 'tutte')
    {
        if($_REQUEST['tipoFiltroL']=='titolo')
        {
            $_REQUEST['titolo'] = $_REQUEST['parRicercaLibro'];
            lettoreController::aggiornaMaster('ricercaLibriPerTitolo');
        }
        else if($_REQUEST['tipoFiltroL']=='autore')
        {
            $_REQUEST['autore'] = $_REQUEST['parRicercaLibro'];
            lettoreController::aggiornaMaster('ricercaLibriPerAutore');
        }
    }
    else if($_REQUEST['cercaIn']=='mieBiblioteche')
    {
        if($_REQUEST['tipoFiltroL']=='titolo')
        {
            $_REQUEST['titolo'] = $_REQUEST['parRicercaLibro'];
            lettoreController::aggiornaMaster('cercaPerTitoloNelleMieBiblioteche');
        }
        else if($_REQUEST['tipoFiltroL']=='autore')
        {
            $_REQUEST['autore'] = $_REQUEST['parRicercaLibro'];
            lettoreController::aggiornaMaster('cercaPerAutoreNelleMieBiblioteche');
        }
    }
    else if($_REQUEST['cercaIn']=='una')
    {
        if($_REQUEST['tipoFiltroL']=='titolo')
        {
            $_REQUEST['titolo'] = $_REQUEST['parRicercaLibro'];
            $_REQUEST['auxBibliotecaId'] = $_REQUEST['bibliotecaId'];
            lettoreController::aggiornaMaster('cercaPerTitoloInUnaBiblioteca');
        }
        else if($_REQUEST['tipoFiltroL']=='autore')
        {
            $_REQUEST['autore'] = $_REQUEST['parRicercaLibro'];
            $_REQUEST['auxBibliotecaId'] = $_REQUEST['bibliotecaId'];
            lettoreController::aggiornaMaster('cercaPerAutoreInUnaBiblioteca');
        }
    }
}
else
    lettoreController::aggiornaMaster(' ');




?>
