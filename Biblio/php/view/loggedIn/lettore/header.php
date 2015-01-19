<?php 

//////LETTORE

$lettore = $_SESSION['utente'];
?>

  
    <div id="leftSide">
         <a href="http://spano.sc.unica.it/amm2014/username/Biblio/php/controller/loggedIn/lettore/toHome.php"><img src="http://spano.sc.unica.it/amm2014/username/Biblio/imgs/b.jpg" alt="Logo" height="55" width="55" id="logo"></a>
         <div id="credenziali">
            <h3><?=$lettore->getNome()." ".$lettore->getCognome() ?></h3>    
            <h4>Lettore</h4>
         </div>
    </div>
    
    

    <div id="rightSide">    
        <ul id="logout">
             <li><a href="http://spano.sc.unica.it/amm2014/username/Biblio/php/controller/loggedOut/logout.php">Log-out</a></li>
        </ul>    
        <ul id="actions">
            <li><a href="http://spano.sc.unica.it/amm2014/username/Biblio/php/controller/loggedIn/lettore/toProfilo.php" ><img src="http://spano.sc.unica.it/amm2014/username/Biblio/imgs/profile.png" alt="Profilo" height="30" width="30" class="icon"></a></li>  
            <li><a href="http://spano.sc.unica.it/amm2014/username/Biblio/php/controller/loggedIn/lettore/toLibriInPrestito.php"><img src="http://spano.sc.unica.it/amm2014/username/Biblio/imgs/book.png" alt="Libri" height="30" width="30" class="icon"></a></li> 
            <li><a href="http://spano.sc.unica.it/amm2014/username/Biblio/php/controller/loggedIn/lettore/toMieBiblioteche.php"><img src="http://spano.sc.unica.it/amm2014/username/Biblio/imgs/library.png" alt="Biblioteche" height="30" width="30" class="icon"></a></li>                              
        </ul> 
    </div>
        
        