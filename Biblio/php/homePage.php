<?php


include_once 'view/ViewDescriptor.php';
include_once 'controller/loggedIn/lettore/lettoreController.php';
include_once 'controller/loggedIn/bibliotecario/bibliotecarioController.php';
include_once 'Settings.php';

FrontController::start();


class FrontController
{  
    public static function start()
    {      
        if(session_status()!=2)
            session_start();       
                       
        $vd = new ViewDescriptor();
        
        if(isset($_SESSION['utente']))
        {
            if($_SESSION['utente']->getRuolo()=='lettore')
            {
                lettoreController::aggiornaMaster('home');
            }
            else if($_SESSION['utente']->getRuolo()=='bibliotecario')
            {
                bibliotecarioController::aggiornaMaster('home');
            }
                
            
        }
        else
        {        
            $vd->setHeaderFile('./view/loggedOut/header.html');
            $vd->setFooterFile('./view/loggedOut/footer.html');
            $vd->setPagina('login');
            $vd->setContentFile('./view/loggedOut/loginForm.php');     

            require_once './view/master.php';
        }        
        
                        
    }        
   
   
}

?>
