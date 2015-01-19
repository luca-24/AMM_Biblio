<?php 

//Pagina principale dell'applicazione. Il suo contenuto è caricato dinamicamente
//grazie alla classe ViewDescriptor e alle classi del Controller.

include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/Settings.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/view/ViewDescriptor.php';

$titolo = $vd->getTitolo();
$header = $vd->getHeaderFile();
$leftBar = $vd->getLeftBarFile();
$rightBar = $vd->getRightBarFile();
$content = $vd->getContentFile();
$footer = $vd->getFooterFile();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $titolo ?></title>
        <meta name="author" content="Luca Piras">
        <meta name="keywords" content="AMM biblioteche">
        <meta name="description" content="Una pagina per gestire biblioteche" />
        <link rel="stylesheet" type="text/css" href="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/css/loggedOut.css">
        <script type="text/javascript" src="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/js/validazioneForm.js"></script>
        <script type="text/javascript" src="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/js/nascondiMenu.js"></script>
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

