<?php 

//include_once '../indexO.php';

include_once '/home/amm/development/Biblio/php/Settings.php';

/*Settings::setPaths(basename(__DIR__));
include_once Settings::$ViewDescriptorPath;*/

include_once '/home/amm/development/Biblio/php/view/ViewDescriptor.php';
/****
if(session_status()!=2)
            session_start();
include_once $_SESSION['ViewDescriptorPath'];
*****/

$titolo = $vd->getTitolo();
$header = $vd->getHeaderFile();
$leftBar = $vd->getLeftBarFile();
$rightBar = $vd->getRightBarFile();
$content = $vd->getContentFile();
$footer = $vd->getFooterFile();
/*
echo session_id()." sessionId</br>";
echo session_status()." sessionStatus</br>";
*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $titolo ?></title>
        <meta name="author" content="Luca Piras">
        <meta name="keywords" content="AMM biblioteche">
        <meta name="description" content="Una pagina per gestire biblioteche" />
        <link rel="stylesheet" type="text/css" href="/Biblio/css/loggedOut.css">
        <script type="text/javascript" src="/Biblio/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="/Biblio/js/validazioneForm.js"></script>
        <script type="text/javascript" src="/Biblio/js/nascondiMenu.js"></script>
    </head>
    <body>
         
        <div id="page">
            
            <div id="header">
                <?php               
                 require "$header";
                ?>                
            </div>
            <div id="leftBar">
                 <?php
                 if($vd->getPagina()!='login')
                 {                     
                     require "$leftBar";
                 }                
                ?>
            </div>
            <div id="rightBar">
                 <?php 
                 if($vd->getPagina()!='login')
                 {                     
                     require "$rightBar";
                 }                
                ?>
            </div>
            <div id="content">
                 <?php                 
                require "$content";
                ?>
            </div>
            <div id="clear"></div>           
            <div id="footer">
                <?php 
                   require "$footer";                
                ?>
            </div>           
        </div>
       
    </body>
</html>

