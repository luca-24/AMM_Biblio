<?php


include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/Settings.php';

//uuu//include_once '/home/amm/development/Biblio/php/Settings.php';

/*
Settings::setPaths(basename(__DIR__));

include_once Settings::$ViewDescriptorPath;
include_once Settings::$LettorePath;
include_once Settings::$LibroPath;
include_once Settings::$LibroFactoryPath;
include_once Settings::$UtenteFactoryPath;
include_once Settings::$UtentePath;
include_once Settings::$BibliotecarioPath;
include_once Settings::$loggedOutControllerPath;
include_once Settings::$bibliotecarioControllerPath;
*/


include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/view/ViewDescriptor.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/model/Lettore.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/model/Libro.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/model/LibroFactory.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/model/UtenteFactory.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/model/Utente.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/model/Bibliotecario.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/Settings.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/Settings.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/bibliotecarioController.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/controller/loggedOut/loggedOutController.php';


/****
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
include_once $_SESSION['bibliotecarioControllerPath'];
include_once $_SESSION['loggedOutControllerPath'];
*****///


    if(session_status()!=2)
            session_start();          

if(isset($_REQUEST["cmd"]) && $_REQUEST["cmd"]!='login' && $_REQUEST['cmd']!='registrati')
    lettoreController::handleInput();

class lettoreController
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
            $vd->setContentFile ('/home/amm/development/Biblio/php/view/loggedOut/loginForm.php');
            require_once '/home/amm/development/Biblio/php/view/master.php';
            return;
        }  
        
        $vd->setTitolo('Biblio-'.$newContent);
        $vd->setPagina('lettore');        
        $vd->setHeaderFile('/home/amm/development/Biblio/php/view/loggedIn/lettore/header.php');
        $vd->setFooterFile('/home/amm/development/Biblio/php/view/loggedIn/lettore/footer.html');
        $vd->setLeftBarFile('/home/amm/development/Biblio/php/view/loggedIn/lettore/sidebarLeft.html');
        $vd->setSottopagina($newContent);
        $vd->setRightBarFile('/home/amm/development/Biblio/php/view/loggedIn/lettore/sidebarRight.php');
                       
        
        switch($newContent)
        {
            case 'profilo':
                $_REQUEST['utente'] = $_SESSION['utente'];
                $vd->setSottopagina('profilo');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/schedaUtente.php');
                break;
            case 'libriInPrestito':
                $_REQUEST['libri'] = $_SESSION['utente']->caricaLibriInPrestito();
                $_REQUEST['codiceRicerca'] = 'inPrestito';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'catalogoBiblioteca':
                $_REQUEST['libri'] = $_REQUEST['biblioteca']->caricaCatalogo();
                $_REQUEST['codiceRicerca'] = 'catalogo';
                $_REQUEST['bibCatalogo'] = $_REQUEST['biblioteca'];
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'ricercaLibriPerTitolo':
                $_REQUEST['libri'] = $_SESSION['utente']->cercaLibroPerTitolo($_REQUEST['titolo']);
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'ricercaLibriPerAutore':
                $_REQUEST['libri'] = $_SESSION['utente']->cercaLibroPerAutore($_REQUEST['autore']);
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'cercaPerTitoloNelleMieBiblioteche':
                $biblioteche = $_SESSION['utente']->caricaMieBiblioteche();
                $auxLibri = array();
                $_REQUEST['libri'] = array();
                foreach ($biblioteche as $b) 
                {
                    $auxLibri[] = $_SESSION['utente']->cercaLibroPerTitoloPerBiblioteca($_REQUEST['titolo'], $b);
                }
                foreach ($auxLibri as $al) 
                {
                    foreach ($al as $singleBook) 
                    {
                        $_REQUEST['libri'][] = $singleBook;
                    }
                }
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
             case 'cercaPerAutoreNelleMieBiblioteche':
                $biblioteche = $_SESSION['utente']->caricaMieBiblioteche();
                $auxLibri = array();
                $_REQUEST['libri'] = array();
                foreach ($biblioteche as $b) 
                {
                    $auxLibri[] = $_SESSION['utente']->cercaLibroPerAutorePerBiblioteca($_REQUEST['autore'], $b);
                }
                foreach ($auxLibri as $al) 
                {
                    foreach ($al as $singleBook) 
                    {
                        $_REQUEST['libri'][] = $singleBook;
                    }
                }
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;            
            case 'cercaPerTitoloInUnaBiblioteca':
                $biblioteca = UtenteFactory::caricaUtentePerId($_REQUEST['auxBibliotecaId']);
                $_REQUEST['libri'] = LibroFactory::caricaLibriPerFiltro($_REQUEST['titolo'], 'titolo', $biblioteca);
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;
            case 'cercaPerAutoreInUnaBiblioteca':
                $biblioteca = UtenteFactory::caricaUtentePerId($_REQUEST['auxBibliotecaId']);
                $_REQUEST['libri'] = LibroFactory::caricaLibriPerFiltro($_REQUEST['autore'], 'autore', $biblioteca);
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('libriTrovati');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/libriTrovati.php');
                break;                
            case 'mieBiblioteche':
                $_REQUEST['biblioteche'] = $_SESSION['utente']->caricaMieBiblioteche();
                $_REQUEST['codiceRicerca'] = 'mieBiblioteche';
                $vd->setSottopagina('bibliotecheTrovate');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/lettore/bibliotecheTrovate.php');
                break;
            case 'ricercaBibliotechePerNome':
                $_REQUEST['biblioteche'] = UtenteFactory::caricaBibliotechePerFiltro($_REQUEST['nome'], 'nomeBiblioteca');
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('bibliotecheTrovate');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/lettore/bibliotecheTrovate.php');
                break;
            case 'ricercaBibliotecheCitta':
                $_REQUEST['biblioteche'] = UtenteFactory::caricaBibliotechePerFiltro($_REQUEST['citta'], 'citta');
                $_REQUEST['codiceRicerca'] = ' ';
                $vd->setSottopagina('bibliotecheTrovate');
                $vd->setContentFile('/home/amm/development/Biblio/php/view/loggedIn/lettore/bibliotecheTrovate.php');
                break;           
            case 'schedaLibro':
                $_REQUEST['libro'] = $_REQUEST['auxLibro'];
                if($_REQUEST['auxCodiceScheda']!='inPrestito' && $_REQUEST['auxCodiceScheda']!='prestati')
                {
                    $_REQUEST['nCopie'] = $_REQUEST['auxNCopie'];
                    $_REQUEST['disp'] = $_REQUEST['auxDisp'];
                }                
                $_REQUEST['codiceScheda'] = $_REQUEST['auxCodiceScheda'];
                if($_REQUEST['codiceScheda']=='inPrestito')
                    $vd->setSottopagina('libroInPrestito');
                else
                    $vd->setSottopagina('schedaLibro');
                $vd->setContentFile ('/home/amm/development/Biblio/php/view/loggedIn/schedaLibro.php');
                break;
            case 'schedaBiblioteca':
                $_REQUEST['utente'] = $_REQUEST['auxUtente'];
                $vd->setSottopagina('schedaBiblioteca');
                $vd->setContentFile ('/home/amm/development/Biblio/php/view/loggedIn/schedaUtente.php');
                break;
            case 'home':
                $vd->setContentFile ('/home/amm/development/Biblio/php/view/loggedIn/lettore/homeContent.html');          
                break;
            case 'credits':
                $vd->setContentFile ('/home/amm/development/Biblio/php/view/credits.html');          
                break;
            default :
                  echo "errore";
        }              
        
        require_once '/home/amm/development/Biblio/php/view/master.php';        
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
        
        switch($_REQUEST["cmd"])
        {
            case 'iscrizione':
                $utente = UtenteFactory::caricaUtentePerId($_REQUEST['utenteId']);
                $biblioteca = UtenteFactory::caricaUtentePerId($_REQUEST['bibliotecaId']);
                $utente->iscrivitiBiblioteca($biblioteca);
                $_REQUEST['auxUtente'] = $biblioteca;
                if(isset($_REQUEST['tornaA']))
                {
                    $_REQUEST['auxLibro'] = LibroFactory::caricaLibroPerId($_REQUEST['libroId']);
                    $_REQUEST['auxCodiceScheda'] = ' ';
                    $_REQUEST['auxNCopie'] = $_REQUEST['nCopie'];
                    $_REQUEST['auxDisp'] = $_REQUEST['disp'];                    
                    self::aggiornaMaster($_REQUEST['tornaA']);
                }
                    
                else
                    self::aggiornaMaster('schedaBiblioteca');
                break;
             case 'disiscrizione':
                $utente = UtenteFactory::caricaUtentePerId($_REQUEST['utenteId']);
                $biblioteca = UtenteFactory::caricaUtentePerId($_REQUEST['bibliotecaId']);
                $utente->disiscrivitiBiblioteca($biblioteca);
                $_REQUEST['auxUtente'] = $biblioteca;
                self::aggiornaMaster('schedaBiblioteca');
                break;
            case 'noleggio':
                $utente = UtenteFactory::caricaUtentePerId($_REQUEST['utenteId']);
                $libro = LibroFactory::caricaLibroPerId($_REQUEST['libroId']);
                $utente->prendiInPrestito($libro);
                $_REQUEST['auxLibro'] = $libro;
                $_REQUEST['auxCodiceScheda'] = ' ';
                $_REQUEST['auxNCopie'] = $_REQUEST['nCopie'];
                $_REQUEST['auxDisp'] = $_REQUEST['disp']-1;
                if($_SESSION['utente']->getRuolo()=='lettore')
                    self::aggiornaMaster('schedaLibro');
                else if($_SESSION['utente']->getRuolo()=='bibliotecario')
                    bibliotecarioController::aggiornaMaster ('schedaLibro');
                break;
        }
        
        
        
    }
            
}
?>