<?php

//include_once '/home/amm/development/Biblio/php/view/ViewDescriptor.php';

?>

<div id="login_form">
      <h1 id="titoloPrinc">Biblio</h1>
      <?php
      $msg = $vd->getMessaggioErrore();
      if($msg!=NULL)
        echo "<p id=\"errore\">$msg</p>";
      ?>
      <form method="post" action="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedOut/loggedOutController.php">
           <label for="email">E-mail</label><br/>
           <input type="text" name="email" id="email" value=""/> <br/>
           <label for="password">Password</label><br/>
           <input type="password" name="password" id="password" value=""/> <br/>
           <input type="hidden" name="cmd" value="login">
           <button type="submit">Accedi</button>                
      </form>
      <div id="par_login">
            <p>Non sei ancora registrato?<br/><a href="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedOut/toRegistrazione.php">Fallo ora!</a></p>
      </div>
</div>  