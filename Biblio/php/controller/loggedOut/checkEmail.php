<?php

include_once '/home/amm/development/Biblio/php/model/UtenteFactory.php';
include_once '/home/amm/development/Biblio/php/Settings.php';
//include_once '/home/amm/development/Biblio/php/model/LibroFactory.php';


/***
if(session_status()!=2)
            session_start();
include_once $_SESSION['UtenteFactoryPath'];
include_once $_SESSION['SettingsPath'];
***/


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