<?php

//Semplice script che controlla se l'indirizzo email inserito dall'utente
//esiste

include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/model/UtenteFactory.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/Settings.php';

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');


checkEmail($_REQUEST['email']);

function checkEmail($email)
{
    
       if(UtenteFactory::emailExists($email)==1)
           $response = false;
       else
           $response = true;

        echo json_encode($response);

}




?>