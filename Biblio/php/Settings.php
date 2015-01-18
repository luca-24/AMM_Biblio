<?php

//Settings::setPaths($directory);

//Settings; path: ".Settings::getUtenteFactoryPath();

class Settings
{
    public static $db_host = 'localhost';
    public static $db_user = 'pirasLuca';
    public static $db_password = 'taccola32';
    public static $db_name='amm2014_pirasLuca';
    public static $UtentePath;
    public static $BibliotecarioPath;
    public static $LettorePath;
    public static $LibroPath;
    public static $UtenteFactoryPath;
    public static $LibroFactoryPath;
    public static $lettoreControllerPath;
    public static $bibliotecarioControllerPath;
    public static $loggedOutControllerPath;
    public static $utilPath;
    public static $ViewDescriptorPath;
    
    
    /*
    public static function setPaths($directory)
    {
       ////// $_SESSION['SettingsPath'] = realpath(__FILE__);
        switch($directory)
        {
            case 'loggedIn':
                self::$UtenteFactoryPath = realpath("../../model/UtenteFactory.php");
                self::$UtentePath = realpath("../../model/Utente.php");
                self::$LettorePath = realpath("../../model/Lettore.php");
                self::$BibliotecarioPath = realpath("../../model/Bibliotecario.php");
                self::$LibroPath = realpath("../../model/Libro.php");
                self::$LibroFactoryPath = realpath("../../model/LibroFactory.php");
                self::$ViewDescriptorPath = realpath("../../view/ViewDescriptor.php");
                self::$lettoreControllerPath = realpath("../../controller/loggedIn/lettore/lettoreController.php");
                self::$loggedOutControllerPath = realpath("../../controller/loggedOut/loggedOutController.php");
                self::$bibliotecarioControllerPath = realpath("../../controller/loggedIn/bibliotecario/bibliotecarioController.php");
                self::$utilPath = realpath("../../util.php");
                break;
            case 'bibliotecario':
                self::$UtenteFactoryPath = realpath("../../../model/UtenteFactory.php");
                self::$UtentePath = realpath("../../../model/Utente.php");
                self::$LettorePath = realpath("../../../model/Lettore.php");
                self::$BibliotecarioPath = realpath("../../../model/Bibliotecario.php");
                self::$LibroPath = realpath("../../../model/Libro.php");
                self::$LibroFactoryPath = realpath("../../../model/LibroFactory.php");
                self::$ViewDescriptorPath = realpath("../../../view/ViewDescriptor.php");
                self::$lettoreControllerPath = realpath("../../../controller/loggedIn/lettore/lettoreController.php");
                self::$loggedOutControllerPath = realpath("../../../controller/loggedOut/loggedOutController.php");
                self::$bibliotecarioControllerPath = realpath("../../../controller/loggedIn/bibliotecario/bibliotecarioController.php");
                self::$utilPath = realpath("../../../util.php");
                break;
           case 'lettore':
                self::$UtenteFactoryPath = realpath("../../../model/UtenteFactory.php");
                self::$UtentePath = realpath("../../../model/Utente.php");
                self::$LettorePath = realpath("../../../model/Lettore.php");
                self::$BibliotecarioPath = realpath("../../../model/Bibliotecario.php");
                self::$LibroPath = realpath("../../../model/Libro.php");
                self::$LibroFactoryPath = realpath("../../../model/LibroFactory.php");
                self::$ViewDescriptorPath = realpath("../../../view/ViewDescriptor.php");
                self::$lettoreControllerPath = realpath("../../../controller/loggedIn/lettore/lettoreController.php");
                self::$loggedOutControllerPath = realpath("../../../controller/loggedOut/loggedOutController.php");
                self::$bibliotecarioControllerPath = realpath("../../../controller/loggedIn/bibliotecario/bibliotecarioController.php");
                self::$utilPath = realpath("../../../util.php");
                break;
           case 'loggedOut':
                self::$UtenteFactoryPath = realpath("../../model/UtenteFactory.php");
                self::$UtentePath = realpath("../../model/Utente.php");
                self::$LettorePath = realpath("../../model/Lettore.php");
                self::$BibliotecarioPath = realpath("../../model/Bibliotecario.php");
                self::$LibroPath = realpath("../../model/Libro.php");
                self::$LibroFactoryPath = realpath("../../model/LibroFactory.php");
                self::$ViewDescriptorPath = realpath("../../view/ViewDescriptor.php");
                self::$lettoreControllerPath = realpath("../../controller/loggedIn/lettore/lettoreController.php");
                self::$loggedOutControllerPath = realpath("../../controller/loggedOut/loggedOutController.php");
                self::$bibliotecarioControllerPath = realpath("../../controller/loggedIn/bibliotecario/bibliotecarioController.php");
                self::$utilPath = realpath("../../util.php");
                break;
           case 'model':
                self::$UtenteFactoryPath = realpath("../model/UtenteFactory.php");
                self::$UtentePath = realpath("../model/Utente.php");
                self::$LettorePath = realpath("../model/Lettore.php");
                self::$BibliotecarioPath = realpath("../model/Bibliotecario.php");
                self::$LibroPath = realpath("../model/Libro.php");
                self::$LibroFactoryPath = realpath("../model/LibroFactory.php");
                self::$ViewDescriptorPath = realpath("../view/ViewDescriptor.php");
                self::$lettoreControllerPath = realpath("../controller/loggedIn/lettore/lettoreController.php");
                self::$loggedOutControllerPath = realpath("../controller/loggedOut/loggedOutController.php");
                self::$bibliotecarioControllerPath = realpath("../controller/loggedIn/bibliotecario/bibliotecarioController.php");
                self::$utilPath = realpath("../util.php");
                break;
            case 'view':
                self::$UtenteFactoryPath = realpath("../model/UtenteFactory.php");
                self::$UtentePath = realpath("../model/Utente.php");
                self::$LettorePath = realpath("../model/Lettore.php");
                self::$BibliotecarioPath = realpath("../model/Bibliotecario.php");
                self::$LibroPath = realpath("../model/Libro.php");
                self::$LibroFactoryPath = realpath("../model/LibroFactory.php");
                self::$ViewDescriptorPath = realpath("../view/ViewDescriptor.php");
                self::$lettoreControllerPath = realpath("../controller/loggedIn/lettore/lettoreController.php");
                self::$loggedOutControllerPath = realpath("../controller/loggedOut/loggedOutController.php");
                self::$bibliotecarioControllerPath = realpath("../controller/loggedIn/bibliotecario/bibliotecarioController.php");
                self::$utilPath = realpath("../util.php");
                break;
            case 'php':
                self::$UtenteFactoryPath = realpath("./model/UtenteFactory.php");
                self::$UtentePath = realpath("./model/Utente.php");
                self::$LettorePath = realpath("./model/Lettore.php");
                self::$BibliotecarioPath = realpath("./model/Bibliotecario.php");
                self::$LibroPath = realpath("./model/Libro.php");
                self::$LibroFactoryPath = realpath("./model/LibroFactory.php");
                self::$ViewDescriptorPath = realpath("./view/ViewDescriptor.php");
                self::$lettoreControllerPath = realpath("./controller/loggedIn/lettore/lettoreController.php");
                self::$loggedOutControllerPath = realpath("./controller/loggedOut/loggedOutController.php");
                self::$bibliotecarioControllerPath = realpath("./controller/loggedIn/bibliotecario/bibliotecarioController.php");
                self::$utilPath = realpath("./util.php");
                break;
        }
             
        //self::$UtenteFactoryPath = realpath("../../model/UtenteFactory.php");
    }*/
/*
    public static function getUtenteFactoryPath()
    {
        return self::$UtenteFactoryPath;
    }
  * */
  


    ////private static $applicationPath;
/**
* Restituisce il path relativo nel server corrente dell'applicazione
* Lo uso perche' la mia configurazione locale e' ovviamente diversa da quella
* pubblica. Gestisco il problema una volta per tutte in questo script
*
    public static function getApplicationPath() 
    {
        if (!isset(self::$applicationPath)) 
        {
                // restituisce il server corrente
           switch ($_SERVER['HTTP_HOST']) 
           {
                case 'localhost':
                     self::$applicationPath = 'http://' . $_SERVER['HTTP_HOST'];
                     break;
                case 'spano.sc.unica.it':
                     self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2014/davide/esami14/';
                     break;
                default:
                     self::$appPath = '';
                     break;
           }
        }
            return self::$applicationPath;
    }
    
    ****/
    
    /******
 //   public static $UtenteFactoryPath = '/home/amm/development/Biblio/php/model/UtenteFactory.php';
    
    public static $UtenteFactoryPath;
    
    public static function setPaths()
    {
      $_SESSION['ViewDescriptorPath'] = realpath("view/ViewDescriptor.php");
      $_SESSION['UtentePath'] = realpath("model/Utente.php");
      $_SESSION['LettorePath'] = realpath("model/Lettore.php");
      $_SESSION['BibliotecarioPath'] = realpath("model/Bibliotecario.php");
      $_SESSION['LibroPath'] = realpath("model/Libro.php");
      $_SESSION['UtenteFactoryPath'] = realpath("model/UtenteFactory.php");
      $_SESSION['LibroFactoryPath'] = realpath("model/LibroFactory.php");
      $_SESSION['loggedOutControllerPath'] = realpath("controller/loggedOut/loggedOutController.php");
      $_SESSION['lettoreControllerPath'] = realpath("controller/loggedIn/lettore/lettoreController.php");
      $_SESSION['bibliotecarioControllerPath'] = realpath("controller/loggedIn/bibliotecario/bibliotecarioController.php");
      $_SESSION['utilPath'] = realpath("util.php");
      $_SESSION['SettingsPath'] = realpath(__FILE__);
    }
    ******/
}
?>