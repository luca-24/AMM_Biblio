<?php
include_once 'loggedOutController.php';
/****
if(session_status()!=2)
            session_start();
include_once $_SESSION['loggedOutControllerPath'];
****/

loggedOutController::logout();

?>
