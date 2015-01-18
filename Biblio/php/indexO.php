<?php

/****
include_once '/home/amm/development/Biblio/php/view/ViewDescriptor.php';
include_once '/home/amm/development/Biblio/php/controller/loggedIn/lettore/lettoreController.php';
include_once '/home/amm/development/Biblio/php/controller/loggedIn/bibliotecario/bibliotecarioController.php';
include_once 'Settings.php';
*****/

include_once 'view/ViewDescriptor.php';
include_once 'controller/loggedIn/lettore/lettoreController.php';
include_once 'controller/loggedIn/bibliotecario/bibliotecarioController.php';
include_once 'Settings.php';

FrontController::start();


class FrontController
{  
    public static function start()
    {
        
        Settings::setPaths(basename(__DIR__));
        
        /*************/
        
      //  echo "index; path: ".Settings::$UtenteFactoryPath;
       // echo "index; path: ".Settings::$UtenteFactoryPath;
        //return;
        
        
        /************/
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

    
    
   /* 
    public static function getIndexPath()
    {
        return FrontController::$indexPath;
    }
    
    public static function getSettingsPath()
    {
        return $SettingsPath;
    }
    
    public static function getViewDescriptorPath()
    {
        return $this->ViewDescriptorPath;
    }
    
    public static function getLoggedOutControllerPath()
    {
        return $this->loggedOutControllerPath;
    }
    
    public static function getLettoreControllerPath()
    {
        return $this->lettoreControllerPath;
    }
    
    public static function getBibliotecarioControllerPath()
    {
        return $this->bibliotecarioControllerPath;
    }
    
    public static function getUtentePath()
    {
        return $this->UtentePath;
    }
    
    public static function getLettorePath()
    {
        return $this->LettorePath;
    }
    
    public static function getBibliotecarioPath()
    {
        return $this->BibliotecarioPath;
    }
    
    public static function getLibroPath()
    {
        return $this->LibroPath;
    }
    
    public static function getUtenteFactoryPath()
    {
        return $this->UtenteFactoryPath;
    }
    
    public static function getLibroFactoryPath()
    {
        return $this->LibroFactoryPath;
    }
    
    public static function getUtilPath()
    {
        return $this->utilPath;
    }
*/
}

?>
