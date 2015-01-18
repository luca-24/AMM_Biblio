<?php 

include_once '/home/amm/development/Biblio/php/Settings.php';

/*Settings::setPaths(basename(__DIR__));
include_once Settings::$utilPath;
*/
include_once '/home/amm/development/Biblio/php/util.php';
/***
if(session_status()!=2)
            session_start();
include_once $_SESSION['utilPath'];
***/

$bibliotecario = $_SESSION['utente'];
$iscritti = $bibliotecario->caricaIscritti();

?>

<h3>Gli iscritti della mia biblioteca</h3>

<p><?php $ris = count($iscritti);
    if($ris==1) echo " $ris risultato<br/>";
    else echo "$ris risultati"?></p>


<?php 
if($ris>0)
    echo "
<table>
    <tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Data di nascita</th>
        <th>Libri in prestito</th>
        <th>Numero di ammonizioni</th>
        <th></th>
    </tr>   ";     



foreach ($iscritti as $i) 
{?>
    <tr>
        <td><?= $i->getNome()?></td>
        <td><?= $i->getCognome()?></td>
        <td><?= Util::invData($i->getDataDiNascita())?></td>
        <?php 
        $inPrestito = $i->caricaLibriInPrestito();
        $nLibriInPrestito = 0;
        foreach($inPrestito as $lp)
        {
            if($lp['libro']->getBibliotecarioId()==$bibliotecario->getId())
                $nLibriInPrestito++;
        }        
        ?>        
        <td><?=$nLibriInPrestito?></td>
        <td><?= $i->getNAmmonizioni()?></td>
        <td>
            <form method="post" action="/Biblio/php/controller/loggedIn/toSchedaUtente.php">
                <input type="hidden" name="ruolo" value="bibliotecario">
                <button type="submit" name="utenteId" value="<?=$i->getId()?>"><img src="/Biblio/imgs/profile.png" alt="profilo" height="14" width="14" class="clickBut"></button></td>                
            </form>
    </tr>  
<?php    
}
?>
</table>