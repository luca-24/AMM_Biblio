<?php 


$utente = $_SESSION['utente'];

$libro = $_REQUEST['libro'];

if(isset($_REQUEST['disp']) && $_REQUEST['disp']>0)
{
    $libro = LibroFactory::caricaPrimoDisponibile($libro->getTitolo(), $libro->getBibliotecarioId());
}

$codiceScheda = $_REQUEST['codiceScheda'];

?>
<h3>Scheda libro</h3>
<ul id="schedaLibro">
    <li>Titolo: <?= $libro->getTitolo()?></li>
    <li>Autore: <?= $libro->getAutore()?></li>
    <li>Genere: <?= $libro->getGenere()?></li>
    <li>Numero di pagine: <?= $libro->getNPagine()?></li>
    <li>Casa editrice: <?= $libro->getCasaEditrice()?></li>
    <?php 
    $biblioteca = UtenteFactory::caricaUtentePerId($libro->getBibliotecarioId());
    $nomeBiblioteca = $biblioteca->getNomeBiblioteca();
    ?>
    <li>Biblioteca: <?= $nomeBiblioteca ?></li>
    <?php
    if($codiceScheda!='inPrestito' && $codiceScheda!='prestati' && $codiceScheda!='singoloPrestato')
        if(isset($_REQUEST['nCopie']))
        echo 
            "
    <li>Copie totali: ".$_REQUEST['nCopie']."</li>
    <li>Copie disponibili: ".$_REQUEST['disp']."</li> 
            ";
    if($codiceScheda=='singoloPrestato')
        echo "
    <li>Prestato a: ".UtenteFactory::caricaUtentePerId($_REQUEST['noleggianteId'])->getNome()." ".UtenteFactory::caricaUtentePerId($_REQUEST['noleggianteId'])->getCognome()."</li>";
    ?>
           
</ul>

<?php  

if($utente->getRuolo() == 'lettore')
{
    if($utente->getNAmmonizioni()<3)
    {
        if($utente->isIscritto(UtenteFactory::caricaUtentePerId($libro->getBibliotecarioId())))
        {
            
            $inPrestito = $utente->caricaLibriInPrestito();
            $nInP = 0;
            foreach ($inPrestito as $ip)
            {
                if($ip['libro']->getBibliotecarioId() == $libro->getBibliotecarioId()
                    && $ip['libro']->getTitolo() == $libro->getTitolo()
                    && $ip['libro']->getAutore() == $libro->getAutore())
                {
                    $nInP++;
                }
            }
            
            if($nInP>0)
            {
                echo "<p>Hai attualmente preso in prestito ".$nInP." copi";
                if($nInP==1)
                    echo "a";
                else
                    echo "e";
                echo " di questo libro
                        presso ".$nomeBiblioteca."</p>";
            }
                    
            
            if($codiceScheda!='inPrestito' && $codiceScheda!='prestati')
            {
                if($_REQUEST['disp']>0)
                {
                     echo "
                         <form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/lettore/lettoreController.php\">
                             <input type=\"hidden\" name=\"libroId\" value=".$libro->getId().">
                             <input type=\"hidden\" name=\"utenteId\" value=".$utente->getId().">
                             <input type=\"hidden\" name=\"nCopie\" value=".$_REQUEST['nCopie'].">
                             <input type=\"hidden\" name=\"disp\" value=".$_REQUEST['disp'].">
                             <input type=\"hidden\" name=\"cmd\" value=\"noleggio\">
                             <button type=\"submit\">Noleggia</button>
                         </form>
                         ";
                 }
                 else
                 {                    
                    echo "<p>Al momento non sono disponibili altre copie
                        di questo libro.</p>";
                 }
            }     
            
            
        }
        else
        {
            echo "<p>Devi prima registrarti a $nomeBiblioteca per poter prendere
            in prestito questo libro.</p>";
            echo "<form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/lettore/lettoreController.php\">
                    <input type=\"hidden\" name=\"utenteId\" value=".$utente->getId().">
                    <input type=\"hidden\" name=\"bibliotecaId\" value=".$libro->getBibliotecarioId().">                    
                    <input type=\"hidden\" name=\"tornaA\" value=\"schedaLibro\">
                    <input type=\"hidden\" name=\"libroId\" value=".$libro->getId().">";
            if(isset($_REQUEST['nCopie']) && isset($_REQUEST['disp']))
            {
                    echo "
                    <input type=\"hidden\" name=\"nCopie\" value=".$_REQUEST['nCopie'].">
                    <input type=\"hidden\" name=\"disp\" value=".$_REQUEST['disp'].">";
                
            }
            echo"
                    <input type=\"hidden\" name=\"bibliotecaId\" value=".$libro->getBibliotecarioId().">
                    <button type=\"submit\" name=\"cmd\" value=\"iscrizione\">Iscriviti</button>     
                </form>";
        }
    }
    else
    {
        echo "<p>Spiacente, hai raggiunto il numero massimo di ammonizioni (3).
                Non puoi pi&ugrave; prendere in prestito nessun libro.</p>";
    }
    
        
    
}

else if($utente->getRuolo() == 'bibliotecario')
{
    if(isset($_REQUEST['disp']) && $_REQUEST['disp']>0)
    {
        echo "
            <form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/bibliotecarioController.php\">
                <input type=\"hidden\" name=\"libroId\" value=".$libro->getId().">
                <input type=\"hidden\" name=\"cmd\" value=\"rimozioneLibro\">";
                if(isset($_REQUEST['nCopie']) && isset($_REQUEST['disp']))
                    echo"
                <input type=\"hidden\" name=\"nCopie\" value=".$_REQUEST['nCopie'].">
                <input type=\"hidden\" name=\"disp\" value=".$_REQUEST['disp'].">    
                        ";
        echo "
                <button type=\"submit\">Rimuovi una copia dal catalogo</button>
            </form>


            ";
        echo "<button type=\"button\" id=\"daiInPrestito\" class=\"button\">Dai in prestito</button>";
        echo "
            <div id=\"formPrestito\" class=\"hidden\">
            <p>Seleziona l'utente a cui vuoi prestare il libro.</p>
            <form  method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/lettore/lettoreController.php\">
                   <input type=\"hidden\" name=\"libroId\" value=".$libro->getId().">";
                   
                   $iscr = $utente->caricaIscritti();
                   foreach($iscr as $is)
                   {
                       echo "
                   <input type=\"radio\" id=\"utenteId\" name=\"utenteId\" value=".$is->getId().">        
                   <label for=\"utenteId\">".$is->getNome()." ".$is->getCognome()."</label>
                       </br>
                            ";
                   }
        
                   echo "<input type=\"hidden\" name=\"nCopie\" value=".$_REQUEST['nCopie'].">
                   <input type=\"hidden\" name=\"disp\" value=".$_REQUEST['disp'].">
                   <input type=\"hidden\" name=\"cmd\" value=\"noleggio\">
                   <button type=\"submit\">Conferma</button>
            </form>
            </div>
              ";
        
        
    }
    if(isset($_REQUEST['disp']) && isset($_REQUEST['nCopie']) && $_REQUEST['nCopie'] != $_REQUEST['disp'])
    {
        
        $noleggianti = array();
        $libri = LibroFactory::caricaLibriBiblioteca($utente, 'inPrestito');
        foreach($libri as $l)
        {
            if($l['libro']->getTitolo()==$libro->getTitolo()
                && $l['libro']->getAutore() == $libro->getAutore())
            {
                $noleggianti[] = UtenteFactory::caricaUtentePerId($l['libro']->getLettoreId());
            }                
        }
        
        ?>
            
        <div id="noleggianti">
            <?php
            echo "
            <p>Questo libro &egrave; al momento preso in prestito dai seguenti utenti:</p>";
            ?>
            <ul>    
            <?php
            foreach ($noleggianti as $n)
                echo "
                <li>".$n->getNome()." ".$n->getCognome()."</li>";        
            ?>
            </ul>
                <p>NB: in caso di nomi ripetuti, significa che l'utente ha preso in prestito
                pi&ugrave; di una copia dello stesso libro.</p>
                <button type="button" class="button" id="riceviDalPrestito">Ricevi dal prestito</button>
        </div>
        <div id="formRestituzione" class="hidden">           
            <p>Seleziona l'utente di cui vuoi registrare la restituzione:</p>            
            <form method="post" action="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/bibliotecarioController.php">    
            <input type="hidden" name="cmd" value="restituzioneLibro">            
            <?php
            if(isset($_REQUEST['nCopie']) && isset($_REQUEST['disp']))
            {
                echo "<input type=\"hidden\" name=\"nCopie\" value=".$_REQUEST['nCopie'].">
                      <input type=\"hidden\" name=\"disp\" value=".$_REQUEST['disp'].">";
            }
            $altriPre = array();
            foreach ($noleggianti as $n)
            {                      
                $inPre = $n->caricaLibriInPrestito();
                
                foreach($inPre as $l)
                {                                
                    if($l['libro']->getTitolo()==$libro->getTitolo()
                       && $l['libro']->getAutore()==$libro->getAutore()
                       && $l['libro']->getBibliotecarioId() == $libro->getBibliotecarioId())
                       {
                            $giaMesso = FALSE; 
                            foreach ($altriPre as $ap)
                            {                                
                                if($l['libro']->getId()==$ap)
                                    $giaMesso = TRUE;
                            }
                            if($giaMesso==FALSE)
                            {
                                $altriPre[] = $l['libro']->getId();
                                break;
                            }
                            
                        }
                            
                }
                
                echo "
                <input type=\"radio\" name=\"noleggianteId_libroId\" id=\"noleggianteId_libroId\" value=\"".$n->getId()."-".$l['libro']->getId()."\">       
                <label for=\"noleggianteId_libroId\">".$n->getNome()." ".$n->getCognome()." - Codice libro: ".$l['libro']->getId()."</label>
                </br>";
            }
                
            ?>            
                <p>NB: in caso di nomi ripetuti, significa che l'utente ha preso in prestito
                pi&ugrave; di una copia dello stesso libro.</p>
                <button type="submit">Conferma</button>
            </form>
        </div>

        <?php
    }
    if($codiceScheda=='singoloPrestato')
    {
        echo"
         <form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/bibliotecarioController.php\">    
            <input type=\"hidden\" name=\"tornaA\" value=\"catalogo\">
            <input type=\"hidden\" name=\"cmd\" value=\"restituzioneLibro\">
            <input type=\"hidden\" name=\"noleggianteId_libroId\" id=\"noleggianteId_libroId\" value=\"".$_REQUEST['noleggianteId']."-".$libro->getId()."\">       
            <button type=\"submit\" class=\"button\">Ricevi dal prestito</button>
         </form>
            ";
    }
}
?>


