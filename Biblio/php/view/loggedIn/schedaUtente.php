<?php 

include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/Settings.php';
include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/util.php';


$loggato = $_SESSION['utente'];
$utente = $_REQUEST['utente'];

$ruoloLoggato = $loggato->getRuolo();
$ruoloUtente = $utente->getRuolo();

if($ruoloUtente=='lettore')
    echo "<h3>Profilo dell'utente</h3>";
else if($ruoloUtente=='bibliotecario')
    echo "<h3>Scheda biblioteca</h3>";

?>

<ul id="schedaUtente">
    <?php 
    if($ruoloUtente=='bibliotecario')
        echo "<li>Nome della biblioteca: ".$utente->getNomeBiblioteca()."</li>";
    ?>
    <li>Nome <?php if($ruoloUtente=='bibliotecario') echo 'titolare';?>: <?= $utente->getNome()?></li>
    <li>Cognome <?php if($ruoloUtente=='bibliotecario') echo 'titolare';?>: <?= $utente->getCognome()?></li>
    <?php 
     if($utente->getRuolo()=='lettore')
        echo "<li>Data di nascita: ".Util::stringData($utente->getDataDiNascita())."</li>";
    ?>        
    <li>Citt&agrave;: <?= $utente->getCitta()?></li>
    <li>Indirizzo: <?= $utente->getIndirizzo()?></li>
    <li>E-mail: <?= $utente->getEmail()?></li>
    <?php 
     if($utente->getRuolo()=='lettore')
        echo "<li>Numero di ammonizioni: ".$utente->getNAmmonizioni()."</li>";
    ?> 
</ul>

<?php

if($ruoloUtente=='bibliotecario')
{
    echo "
        <form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/".$ruoloLoggato."/toCatalogo.php\">
            <button type=\"submit\" name=\"bibliotecaId\" value=".$utente->getId().">Visualizza catalogo</button>
        </form>
        
    <h4>Cerca un libro nel catalogo</h4>    
    <form method=\"post\" id=\"formCercaLibro\" action=\"#\">
        <input type=\"hidden\" name=\"utenteId\" value=".$utente->getId().">
        <input type=\"hidden\" name=\"cercaIn\" value=\"una\">
        <input name=\"ruolo\" id=\"ruolo\" type=\"hidden\" value=".$ruoloLoggato.">
        <input type=\"hidden\" name=\"bibliotecaId\" value=".$utente->getId().">
        <label for=\"tipoFiltroL\">Seleziona il filtro per la ricerca:</label>
        <select name=\"tipoFiltroL\" id=\"tipoFiltroL\">
             <option value=\"titolo\">Titolo</option>
             <option value=\"autore\">Autore</option>
        </select>
        <input type=\"text\" name=\"parRicercaLibro\" id=\"parRicercaLibro\">
        <button type=\"submit\" id=\"buttonCercaLibro\">Cerca</button>
    </form> 
        ";
}

if($ruoloLoggato == 'bibliotecario' && $ruoloUtente=='lettore')
{        
       
    if($utente->isIscritto($loggato))
    {
        if($utente->getNAmmonizioni()<3)
        {
            echo "                
                <form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/bibliotecarioController.php\">
                    <input type=\"hidden\" name=\"bibliotecarioId\" value=".$loggato->getId().">
                    <input type=\"hidden\" name=\"utenteId\" value=".$utente->getId().">
                    <button type=\"submit\" name=\"cmd\" value=\"ammonizione\">Ammonisci</button>     
                </form> 
                ";        
        }
        
        $auxInPrestito = $utente->caricaLibriInPrestito();
        $inPrestito = array();        
        foreach($auxInPrestito as $lp)
        {
            if($lp['libro']->getBibliotecarioId()==$loggato->getId())
                $inPrestito[] = $lp['libro'];
        }  
        
        $nPrest = count($inPrestito);
        echo "<p>L'utente ha attualmente ".$nPrest." libr";
        if ($nPrest==1)
            echo "o preso";
        else
            echo "i presi";
        echo " in prestito presso la mia biblioteca:</p>";
        
        if($nPrest>0)
        {
            echo "
                <table>
                    <tr>
                        <th>Titolo</th>
                        <th>Autore</th>
                        <th>Codice</th>
                        <th></th>
                    </tr>
                    ";
            
            foreach($inPrestito as $l)
            {
                echo "
                    <tr>
                        <td>".$l->getTitolo()."</td>
                        <td>".$l->getAutore()."</td>
                        <td>".$l->getId()."</td>
                        <td>
                            <form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/toSchedaLibro.php\">
                                <input type=\"hidden\" name=\"libroId\" value=".$l->getId().">
                                <input type=\"hidden\" name=\"codiceScheda\" value=\"singoloPrestato\">
                                <input type=\"hidden\" name=\"ruolo\" value=\"bibliotecario\">
                                <input type=\"hidden\" name=\"noleggianteId\" value=".$l->getLettoreId().">
                                <button type=\"submit\"><img src=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/imgs/book.png\" alt=\"Libri\" height=\"14\" width=\"14\"></button>
                            </form>
                         </td>
                    </tr>";
            }     
            echo "</table>";
        }
        
          
        
    }   
    else
    {
        echo "<p>Questo utente non &egrave; iscritto alla tua biblioteca.</p>";        
    } 
}

if($ruoloLoggato=='lettore' && $ruoloUtente=='bibliotecario')
{
    if($loggato->getNAmmonizioni()<3)
    {
        if(!($loggato->isIscritto($utente)))
        {
            echo "                
                <form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/lettore/lettoreController.php\">
                    <input type=\"hidden\" name=\"utenteId\" value=".$loggato->getId().">
                    <input type=\"hidden\" name=\"bibliotecaId\" value=".$utente->getId().">
                    <button type=\"submit\" name=\"cmd\" value=\"iscrizione\">Iscriviti</button>     
                </form> 
                ";       
        }
        else
        {
            echo "<p>Sei iscritto a questa biblioteca.</p>";
             
            $inPrestito = $loggato->caricaLibriInPrestito();
            $nLibriInPrestito = 0;
            foreach($inPrestito as $lp)
            {
                if($lp['libro']->getBibliotecarioId()==$utente->getId())
                    $nLibriInPrestito++;
            }
            if($nLibriInPrestito == 0)
            {
                
                echo "                
                <form method=\"post\" action=\"http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/lettore/lettoreController.php\">
                    <input type=\"hidden\" name=\"utenteId\" value=".$loggato->getId().">
                    <input type=\"hidden\" name=\"bibliotecaId\" value=".$utente->getId().">
                    <button type=\"submit\" name=\"cmd\" value=\"disiscrizione\">Disiscriviti</button>     
                </form> 
                ";  
            }
            else
            {
                echo "<p>Hai attualmente ".$nLibriInPrestito." libr";
                if ($nLibriInPrestito==1)
                    echo "o preso";
                else
                    echo "i presi";
                echo " in prestito presso questa biblioteca.</p>";
                
                
                echo "<p>Se vuoi disiscriverti, devi prima rendere i libri
                    che hai preso in prestito.</p>";                
            }
            
        }
    }
    else
    {
        echo "<p>Spiacente, hai raggiunto il numero massimo di ammonizioni (3).
                Non puoi pi&ugrave; iscriverti a nessuna biblioteca.</p>";
    }
}
   


?>