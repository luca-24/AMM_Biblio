<?php

include_once '/home/amm/development/Biblio/php/Settings.php';
Settings::setPaths(basename(__DIR__));

include_once Settings::$ViewDescriptorPath;
include_once Settings::$LettorePath;
include_once Settings::$LibroPath;
include_once Settings::$LibroFactoryPath;
include_once Settings::$UtenteFactoryPath;
include_once Settings::$UtentePath;
include_once Settings::$BibliotecarioPath;
include_once Settings::$loggedOutControllerPath;


/*****
include_once '/home/amm/development/Biblio/php/view/ViewDescriptor.php';
include_once '/home/amm/development/Biblio/php/model/Lettore.php';
include_once '/home/amm/development/Biblio/php/model/Libro.php';
include_once '/home/amm/development/Biblio/php/model/LibroFactory.php';
include_once '/home/amm/development/Biblio/php/model/UtenteFactory.php';
include_once '/home/amm/development/Biblio/php/model/Utente.php';
include_once '/home/amm/development/Biblio/php/model/Bibliotecario.php';
include_once '/home/amm/development/Biblio/php/Settings.php';
include_once '/home/amm/development/Biblio/php/controller/loggedOut/loggedOutController.php';
*****/

/**********
if(session_status()!=2)
            session_start();
include_once $_SESSION['ViewDescriptorPath'];
include_once $_SESSION['LettorePath'];
include_once $_SESSION['LibroPath'];
include_once $_SESSION['LibroFactoryPath'];
include_once $_SESSION['UtenteFactoryPath'];
include_once $_SESSION['UtentePath'];
include_once $_SESSION['BibliotecarioPath'];
include_once $_SESSION['SettingsPath'];
include_once $_SESSION['loggedOutControllerPath'];
********/

if(session_status()!=2)
     session_start();


if(isset($_REQUEST["cmd"]) && $_REQUEST["cmd"]!='login' && $_REQUEST['cmd']!='registrati')
    bibliotecarioController::handleInput();


class bibliotecarioController
{
    public static function aggiornaMaster($newContent)
    {
        $vd = new ViewDescriptor();        
        
              
        if(!isset($_SESSION['logged']) || $_SESSION['logged']==FALSE)
        {
                $vd->setHeaderFile('/home/amm/development/Biblio/php/view/loggedOut/header.html');
                $vd->setFooterFile('/home/amm/development/Biblio/php/view/loggedOut/footer.html');
                $vd->setMessaggioErrore('Sessione scaduta');
                $vd->setPagina('login');
                $vd->setTitolo('Biblio');
                $vd->setContentFile ('/home/amm/development/Biblio/php/loggedOut/loginForm.php');
                require_once '/home/amm/development/Biblio/php/view/master.php';
                return;
          
            
        }
        
        $vd->setTitolo('Biblio-'.$newContent);
        $vd->setPagina('bibliotecario');        
        $vd->setHeaderFile('/home/amm/development/Biblio/php/view/loggedIn/bibliotecario/header.php');
        $vd->setFooterFile('/home/amm/development/Biblio/php/view/loggedIn/bibliotecario/footer.html');
        $vd->setLeftBarFile('/home/amm/development/Biblio/php/view/loggedIn/bibliotecario/sidebarLeft.html');
        $vd->setSottopagina($newContent);
        $vd->setRightBarFile('/home/amm/development/Biblio/php/view/loggedIn/bibliotecario/sidebarRight.php');
        
               
        switch($newContent)
        {
            case 'profilo':
                $_REQUEST['utente'] = $_SESSION['utente'];
                $vd->setSottopagina('profilo');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/schedaUtente.php');
                break;
            case 'aggiungiLibro':
                $vd->setSottopagina('aggiungiLibro');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/bibliotecario/aggiungiLibro.html');
                break;
            case 'catalogo':
                $_REQUEST['libri'] = $_SESSION['utente']->caricaCatalogo();
                $_REQUEST['codiceRicerca'] = 'catalogo';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'libriPrestati':
                $_REQUEST['libri'] = $_SESSION['utente']->caricaLibriPrestati();
                $_REQUEST['codiceRicerca'] = 'prestati';
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'cercaPerTitoloNelCatalogo':
                $_REQUEST['libri'] = $_SESSION['utente']->cercaLibroPerTitoloNelCatalogo($_REQUEST['titolo']);
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'cercaPerAutoreNelCatalogo':
                $_REQUEST['libri'] = $_SESSION['utente']->cercaLibroPerAutoreNelCatalogo($_REQUEST['autore']);
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'schedaLibro':
                $_REQUEST['libro'] = $_REQUEST['auxLibro'];
                
                if(isset($_REQUEST['auxNoleggianteId']))
                    $_REQUEST['noleggianteId'] = $_REQUEST['auxNoleggianteId'];
                
                if(isset($_REQUEST['auxNCopie']) && isset($_REQUEST['auxDisp']))
                {
                    $_REQUEST['nCopie'] = $_REQUEST['auxNCopie'];
                    $_REQUEST['disp'] = $_REQUEST['auxDisp'];
                }                
                $_REQUEST['codiceScheda'] = $_REQUEST['auxCodiceScheda'];
                $vd->setSottopagina('schedaLibro');
                $vd->setContentFile ('/home/amm/development/Biblio/php/view/loggedIn/schedaLibro.php');
                break;
            case 'schedaUtente':
                $_REQUEST['utente'] = $_REQUEST['auxUtente'];
                $vd->setSottopagina('schedaUtente');
                 $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/schedaUtente.php');
                 break;
            case 'iscritti':
                $vd->setSottopagina('iscritti');
                $vd->setContentFile ('/home/amm/development/Biblio/php/view/loggedIn/bibliotecario/iscritti.php');
                break;
            case 'home':
                $vd->setContentFile ('/home/amm/development/Biblio/php/view/loggedIn/bibliotecario/homeContent.html');          
                break;
            case 'credits':
                $vd->setContentFile ('/home/amm/development/Biblio/php/view/credits.html');          
                break;
            
                
        }     
       
        require '/home/amm/development/Biblio/php/view/master.php';
    }
    
    public static function handleInput()
    {   
        
        if(!isset($_SESSION['logged']) || $_SESSION['logged']==FALSE)
        {    
             $vd = new ViewDescriptor();
             $vd->setHeaderFile('/home/amm/development/Biblio/php/view/loggedOut/header.html');
             $vd->setFooterFile('/home/amm/development/Biblio/php/view/loggedOut/footer.html');
             $vd->setMessaggioErrore('Sessione scaduta');
             $vd->setPagina('login');
             $vd->setContentFile ('/home/amm/development/Biblio/php/view/loggedOut/loginForm.php');
             require_once '/home/amm/development/Biblio/php/view/master.php';
             return;
                        
        }
        
        switch($_REQUEST['cmd'])
        {
            case 'ammonizione':
                $bibliotecario = UtenteFactory::caricaUtentePerId($_REQUEST['bibliotecarioId']);
                $utente = UtenteFactory::caricaUtentePerId($_REQUEST['utenteId']);
                $bibliotecario->ammonisciLettore($utente);
                $_REQUEST['auxUtente'] = $utente;
                self::aggiornaMaster('schedaUtente');
                break;
            case 'aggiuntaLibro':
                for($i=0; $i<$_REQUEST['nCopie']; $i++)
                {
                    $libro = new Libro();
                    $libro->setTitolo($_REQUEST['titolo']);
                    $libro->setAutore($_REQUEST['autore']);
                    $libro->setCasaEditrice($_REQUEST['casaEditrice']);
                    $libro->setGenere($_REQUEST['genere']);
                    $libro->setNPagine($_REQUEST['nPagine']);
                    $_SESSION['utente']->aggiungiLibro($libro);
                }
                self::aggiornaMaster('catalogo');
                break;
             case 'rimozioneLibro':
                 $libro = LibroFactory::caricaLibroPerId($_REQUEST['libroId']);
                 $_SESSION['utente']->rimuoviLibro($libro);
                 $_REQUEST['auxLibro'] = $libro;
                 $_REQUEST['auxCodiceScheda'] = 'catalogo';
                 if(isset($_REQUEST['nCopie']) && isset($_REQUEST['disp']))
                 {
                      $_REQUEST['auxNCopie'] = $_REQUEST['nCopie']-1;
                      $_REQUEST['auxDisp'] = $_REQUEST['disp']-1;
                 }                 
                 self::aggiornaMaster('schedaLibro');
                 break;
             case 'restituzioneLibro':                
                 $ash = stripos($_REQUEST['noleggianteId_libroId'], "-");
                 $noleggianteId = substr($_REQUEST['noleggianteId_libroId'], 0, $ash);
                 $libroId = substr($_REQUEST['noleggianteId_libroId'], $ash+1);
                 $libro = LibroFactory::caricaLibroPerId($libroId);
                 $noleggiante = UtenteFactory::caricaUtentePerId($noleggianteId);
                 $noleggiante->restituisciLibro($libro);
                 $_REQUEST['auxLibro'] = $libro;
                 
                 $_REQUEST['auxCodiceScheda'] = 'catalogo';
                 if(isset($_REQUEST['nCopie']) && isset($_REQUEST['disp']))
                 {
                      $_REQUEST['auxNCopie'] = $_REQUEST['nCopie'];
                      $_REQUEST['auxDisp'] = $_REQUEST['disp']+1;
                 }                
                 if(isset($_REQUEST['tornaA']))
                     self::aggiornaMaster ($_REQUEST['tornaA']);
                 else
                    self::aggiornaMaster('schedaLibro');
                 break;
                 
        }
    }
            
}
?>