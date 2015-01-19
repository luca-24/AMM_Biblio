<?php
include_once 'lettoreController.php';


if(isset($_REQUEST))
{
    
    if($_REQUEST['tipoFiltroB']=='citta')
    {
        $_REQUEST['citta'] = $_REQUEST['parRicercaBiblio'];
        lettoreController::aggiornaMaster('ricercaBibliotecheCitta');
    }
    else if($_REQUEST['tipoFiltroB']=='nome')
    {
        $_REQUEST['nome'] = $_REQUEST['parRicercaBiblio'];
        lettoreController::aggiornaMaster('ricercaBibliotechePerNome');
    }
}
else
    lettoreController::aggiornaMaster(' ');


?>
