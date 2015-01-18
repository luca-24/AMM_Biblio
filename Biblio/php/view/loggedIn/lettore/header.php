<?php 

//////LETTORE

$lettore = $_SESSION['utente'];
?>

  
    <div id="leftSide">
         <a href="/Biblio/php/controller/loggedIn/lettore/toHome.php"><img src="/Biblio/imgs/b.jpg" alt="Logo" height="55" width="55" id="logo"></a>
         <div id="credenziali">
            <h3><?=$lettore->getNome()." ".$lettore->getCognome() ?></h3>    
            <h4>Lettore</h4>
         </div>
    </div>
    
    

    <div id="rightSide">    
        <ul id="logout">
             <li><a href="/Biblio/php/controller/loggedOut/logout.php">Log-out</a></li>
        </ul>    
        <ul id="actions">
            <li><a href="/Biblio/php/controller/loggedIn/lettore/toProfilo.php" ><img src="/Biblio/imgs/profile.png" alt="Profilo" height="30" width="30" class="icon"></a></li>  
            <li><a href="/Biblio/php/controller/loggedIn/lettore/toLibriInPrestito.php"><img src="/Biblio/imgs/book.png" alt="Libri" height="30" width="30" class="icon"></a></li> 
            <li><a href="/Biblio/php/controller/loggedIn/lettore/toMieBiblioteche.php"><img src="/Biblio/imgs/library.png" alt="Biblioteche" height="30" width="30" class="icon"></a></li>                              
        </ul> 
    </div>
        
        