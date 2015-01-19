<?php

////questa pagina può essere usata sia per il lettore, per visualizzare il risultato
////delle sue ricerche, sia per il bibliotecario, per la visualizzazione del catalogo

include_once '/home/amm/repoAmm/amm2014/pirasLuca/Biblio/php/Settings.php';

/*Settings::setPaths(basename(__DIR__));
include_once Settings::$utilPath;*/

include_once '/home/amm/development/Biblio/php/util.php';

/***
if(session_status()!=2)
            session_start();
include_once $_SESSION['utilPath'];
***/

////echo __FILE__;

$utente = $_SESSION['utente'];
$libri = $_REQUEST['libri'];
$codiceRicerca = $_REQUEST['codiceRicerca'];
if($codiceRicerca=='catalogo' && $utente->getRuolo()=='lettore')
    $bibCatalogo = $_REQUEST['bibCatalogo'];


if($utente->getRuolo()=='bibliotecario')
{
    echo "<h3>Catalogo</h3>
        <h4><a href=\"/Biblio/php/controller/loggedIn/bibliotecario/toAggiungiLibro.php\" id=\"aggiungiA\">Aggiungi un libro al catalogo</a></h4>";
    switch($codiceRicerca)
    {
        case 'catalogo':
            echo
            "<h4>Tutti i libri presenti nel catalogo:</h4>";
            break;
        case 'prestati':
            echo
            "<h4>Libri del catalogo che al momento sono stati prestati:</h4>";
            break;
    }
    
}
else if($utente->getRuolo()=='lettore')
{
    switch($codiceRicerca)
    {
        case 'inPrestito':
            echo "<h3>Libri che hai preso attualmente in prestito</h3>";
            break;
        case 'catalogo':
            echo "<h3>Catalogo di ".$bibCatalogo->getNomeBiblioteca()."</h3>";
            break;
        default:
            echo "<h3>Ricerca libri</h3>";
            break;
    }
}

?>

<p><?php $ris = count($libri);
    if($ris==1) echo " $ris risultato<br/>";
    else echo "$ris risultati"?></p>

<?php 
if(count($libri)>0)
{
       echo "
<table>
    <tr>
        <th>Titolo</th>
        <th>Autore</th>";
       if($utente->getRuolo()=='lettore' && $codiceRicerca!='inPrestito'
          && $codiceRicerca!='catalogo') echo        
       "<th>Sede</th>"; 
       if($codiceRicerca=='prestati') echo
           "<th>Prestato a</th>
           <th>Data prestito</th>";
       else if($codiceRicerca=='inPrestito') echo
           "<th>Prestato da</th>
           <th>Data prestito</th>";
       else echo
           "<th>Copie totali</th>
            <th>Copie disponibili</th>";
       
       echo 
        "<th></th>
    </tr>   ";
       
       
       
}
   

foreach ($libri as $l) 
{?>

    <tr>
        <td><?= $l['libro']->getTitolo()?></td>
        <td><?= $l['libro']->getAutore()?></td>
        <?php 
        if($utente->getRuolo()=='lettore' && $codiceRicerca!='inPrestito'
                && $codiceRicerca!='catalogo')
        {
            $biblioteca = UtenteFactory::caricaUtentePerId($l['libro']->getBibliotecarioId());
            $nomeBiblioteca = $biblioteca->getNomeBiblioteca();
            $cittaBiblioteca = $biblioteca->getCitta();
            echo "<td>$nomeBiblioteca, $cittaBiblioteca</td>";
        }
        
        if($codiceRicerca=='prestati')
        {
            $nomeLettore = UtenteFactory::caricaUtentePerId($l['libro']->getLettoreId())->getNome();
            $cognomeLettore = UtenteFactory::caricaUtentePerId($l['libro']->getLettoreId())->getCognome();
            echo 
            "<td>".$nomeLettore." ".$cognomeLettore."</td>
             <td>".Util::invData($l['libro']->getDataPrestito())."</td>";
        }
        else if($codiceRicerca=='inPrestito')
        {
            $nomeBiblioteca = UtenteFactory::caricaUtentePerId($l['libro']->getBibliotecarioId())->getNomeBiblioteca();            
            echo 
            "<td>".$nomeBiblioteca."</td>
             <td>".  Util::invData($l['libro']->getDataPrestito())."</td>";
        }
        else echo       
        "<td>".$l['nCopie']."</td>
        <td>".$l['disp']."</td>";
        
        
        ?>
        <td>
            <form method="post" action="/Biblio/php/controller/loggedIn/toSchedaLibro.php">
                <?php 
                if($codiceRicerca!='inPrestito' && $codiceRicerca!='prestati')
                {
                    echo "<input type=\"hidden\" name=\"nCopie\" value=".$l['nCopie'].">";
                    echo "<input type=\"hidden\" name=\"disp\" value=".$l['disp'].">";
                }                    
                ?>
                <input type="hidden" name="ruolo" value="<?=$utente->getRuolo()?>">
                <input type="hidden" name="codiceScheda" value="<?=$codiceRicerca?>">
                
                <?php 
                if(isset($l['disp']) && $l['disp']>0)
                {
                    $primoDisp = LibroFactory::caricaPrimoDisponibile($l['libro']->getTitolo(), $l['libro']->getBibliotecarioId());
                    echo "<input type=\"hidden\" name=\"libroId\" value=".$primoDisp->getId().">";
                }
                else
                    echo "<input type=\"hidden\" name=\"libroId\" value=".$l['libro']->getId().">";
                
                ?>
                
                
                <button type="submit"><img src="/Biblio/imgs/book.png" alt="Libri" height="14" width="14"></button>
            </form>         
          
        </td>
    </tr>  
<?php    
}
?>   
</table>   