<?php

include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/view/ViewDescriptor.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/model/UtenteFactory.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/Settings.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/bibliotecarioController.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/controller/loggedIn/lettore/lettoreController.php';


if(session_status()!=2)
            session_start();

if(isset($_REQUEST['cmd']))
    loggedOutController::handleInput();


class loggedOutController
{
    public static function aggiornaMaster($newContent)
    {
              
        if(session_status()!=2)
             session_start();
                 
        $vd = new ViewDescriptor();
        
        $vd->setHeaderFile('../../view/loggedOut/header.html');
        $vd->setFooterFile('../../view/loggedOut/footer.html');
        
        if(isset($_REQUEST['erroreLogin']) && $_REQUEST['erroreLogin']==TRUE)
        {
             $vd->setMessaggioErrore('Autenticazione fallita');             
        }
        $vd->setPagina('login');
        $vd->setTitolo('Biblio-'.$newContent);
        
        switch ($newContent)
        {
            case 'comeFunziona':
                $vd->setSottopagina('comeFunziona');
                $vd->setContentFile('../../view/loggedOut/comeFunziona.html');
                break;
            case 'registrazione':
                $vd->setSottopagina('registrazione');
                $vd->setContentFile('../../view/loggedOut/registrazione.html');
                break;
            case 'credits':
                $vd->setSottopagina('credits');
                $vd->setContentFile('../../view/credits.html');    
                break;
            case 'loginForm':
                $vd->setSottopagina('loginForm');
                $vd->setContentFile ('../../view/loggedOut/loginForm.php');
                break;
        }
          
        require_once '../../view/master.php';
    }
    
    public static function login($email, $password)
    {
                
        $utente = UtenteFactory::caricaUtente($email, $password);
        
        if($utente==NULL)
        {
            $_REQUEST['erroreLogin'] = TRUE;
            loggedOutController::aggiornaMaster('loginForm');
        }
        else 
        {   
            if(session_status()!=2)
                session_start();
            
            if(isset($_SESSION['utente']))
            {
                $giaLoggato = UtenteFactory::caricaUtentePerId($_SESSION['utente']->getId());
                if($giaLoggato != NULL && $giaLoggato->getId() != $utente->getId() && !(isset($registrato)))
                {                    
                    $vd = new ViewDescriptor();
                    $vd->setHeaderFile('../../view/loggedOut/header.html');
                    $vd->setFooterFile('../../view/loggedOut/footer.html');
                    $vd->setMessaggioErrore('Impossibile effettuare il login: un altro
                          utente &egrave; gi&agrave; attivo in questo momento.');
                    $vd->setPagina('login');
                    $vd->setContentFile ('../../view/loggedOut/loginForm.php');
                    require_once '../../view/master.php';
                    return;
                }    
            }
            
            
            $_SESSION['utente'] = $utente;
            $_SESSION['logged'] = TRUE;
            
            if($utente->getRuolo()=='lettore')
            {
               lettoreController::aggiornaMaster('home');
            }
            else if($utente->getRuolo()=='bibliotecario')
            {
               bibliotecarioController::aggiornaMaster('home');
            }
                        
        }
    }
    
    public static function logout()
    {        
            
       $_SESSION['logged'] = FALSE;
       if (session_id() != '' || isset($_COOKIE[session_name()])) 
       {
            setcookie(session_name(), '', time() - 2592000, '/');
       }
        session_destroy();
        loggedOutController::aggiornaMaster('loginForm');
    }

    public static function handleInput() 
    {
        switch($_REQUEST["cmd"])
        {
            case 'login':
                loggedOutController::login($_REQUEST['email'], $_REQUEST['password']);
                break;
            case 'registrati':
                if(isset($_REQUEST['nomeBiblioteca']))
                {
                    $utente = new Bibliotecario();
                    $utente->setNomeBiblioteca($_REQUEST['nomeBiblioteca']);
                }
                else
                {
                    $utente = new Lettore();
                    $utente->setDataDiNascita($_REQUEST['data']);
                    $utente->setNAmmonizioni(0);
                }
                $utente->setRuolo();
                $utente->setNome($_REQUEST['nome']);
                $utente->setCognome($_REQUEST['cognome']);
                $utente->setCitta($_REQUEST['citta']);
                $utente->setIndirizzo($_REQUEST['indirizzo']);
                $utente->setEmail($_REQUEST['email']);
                $utente->setPassword($_REQUEST['password']);                
                
                UtenteFactory::creaUtente($utente);
                $registrato = TRUE;              
                self::login($utente->getEmail(), $utente->getPassword());
                break;
          
           case 'controllaEmail':
                if(UtenteFactory::emailExists($_REQUEST['email'])==1)
                    $response = false;
                else
                    $response = true;
                 echo json_encode($response);
                 break;
                
        }
    }
    
            
}
?>
