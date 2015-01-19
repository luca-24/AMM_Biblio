<?php 

//////BIBLIOTECARIO

$bib = $_SESSION['utente'];
?>

 
    <div id="leftSide">
         <a href="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/toHome.php"><img src="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/imgs/b.jpg" alt="Logo" height="55" width="55" id="logo"></a>
         <div id="credenziali">
            <h3><?=$bib->getNomeBiblioteca()?></h3>    
            <h4><?=$bib->getNome()." ".$bib->getCognome()?></h4>
         </div>
    </div>
    
    
    <div id="rightSide">        
        <ul id="logout">
            <li><a href="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedOut/logout.php">Log-out</a></li>
        </ul>
        <ul id="actions">
            <li><a href="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/toProfilo.php" ><img src="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/imgs/profile.png" alt="Profilo" height="30" width="30" class="icon"></a></li>  
            <li><a href="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/toCatalogo.php"><img src="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/imgs/books.png" alt="Libri" height="30" width="30"class="icon"></a></li> 
            <li><a href="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/toIscritti.php"><img src="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/imgs/people.png" alt="Iscritti" height="30" width="30" class="icon"></a></li>                              
        </ul> 
    </div>
        
        