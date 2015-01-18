<?php 

//include_once '/home/amm/development/Biblio/php/model/UtenteFactory.php';
//include_once '/home/amm/development/Biblio/php/model/LibroFactory.php';


$biblioteche = $_REQUEST['biblioteche'];

if($_REQUEST['codiceRicerca'] == 'mieBiblioteche')
    echo "<h3>Biblioteche a cui sono iscritto</h3>";
else
    echo "<h3>Ricerca biblioteche</h3>";

?>

<p><?php $ris = count($biblioteche);
    if($ris==1) echo " $ris risultato<br/>";
    else echo "$ris risultati"?></p>

<?php 
if($ris>0)
    echo "
<table>
    <tr>
        <th>Nome</th>
        <th>Indirizzo</th>
        <th>Titolare</th>
        <th>E-mail</th>
        <th></th>
    </tr>   ";     



foreach ($biblioteche as $b) 
{?>
    <tr>
        <td><?= $b->getNomeBiblioteca()?></td>
        <td><?= $b->getCitta()." - ".$b->getIndirizzo()?></td>
        <td><?= $b->getNome()." ".$b->getCognome()?></td>
        <td><?= $b->getEmail()?></td>
        <td>
            <form method="post" action="/Biblio/php/controller/loggedIn/toSchedaUtente.php">
                <input type="hidden" name="ruolo" value="lettore">
                <button type="submit" name="utenteId" value="<?=$b->getId()?>"><img src="/Biblio/imgs/library.png" alt="Biblioteche" height="14" width="14"></button>
            </form>
        </td>
    </tr>  
<?php    
}
?>
</table>