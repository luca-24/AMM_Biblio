
<?php
include_once 'loggedOutController.php';

/*****
if(session_status()!=2)
            session_start();
include_once $_SESSION['loggedOutControllerPath'];
***/

/*********************/


include_once '/home/amm/development/Biblio/php/Settings.php';
include_once '/home/amm/development/Biblio/php/model/UtenteFactory.php';
//include_once '../../model/UtenteFactory.php';
//echo Settings::$db_password;
//return;

/*Settings::setPaths(basename(__DIR__));
include_once Settings::$UtenteFactoryPath;*/

//$up = UtenteFactory::caricaUtentePerId(1);
//echo $up->getCognome();
//echo "toComeFunziona; path: ".Settings::$UtenteFactoryPath;
//echo "toComeFunziona; path: ".Settings::$UtenteFactoryPath;
//return;


/*********************/

loggedOutController::aggiornaMaster('comeFunziona');

?>

