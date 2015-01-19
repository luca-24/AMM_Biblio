<img src="http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/imgs/info.png" alt="info" height="16px" width="16px" id="info">

<?php
switch ($vd->getSottopagina())
{
    case 'home':
        echo "<p>Esegui la ricerca scegliendo i parametri pi&ugrave; adeguati.<br/>
            Cliccando su \"Gestisci catalogo\", potrai dare in prestito libri o 
            ricevere quelli prestati, oppure aggiungere un nuovo libro al catalogo</p>";
        break;
    case 'libriTrovati':
        echo "<p>Clicca sull'icona corrispondente al libro che ti interessa per
              visualizzarne i dettagli e per eventualmente darlo in
              prestito o per registrarnee la restituzione</p>";
        break;
    case 'iscritti':
        echo "<p>Clicca sull'icona corrispondente all'utente che ti interessa per
                visualizzarne il profilo e per, eventualmente, ammonirlo.</p>";
        break;
    case 'schedaLibro':
        echo "<p>Da questa pagina puoi vedere i dettagli del libro, eventualmente
            darlo in prestito o registrarne la restituzione.</p>";
        break;
    case 'schedaUtente':
        echo "<p>Da questa pagina puoi vedere i dettagli dell'utente, ed eventualmente
            ammonirlo.</p>";
        break;
    case 'aggiungiLibro':
        echo "<p>Inserisci i dettagli del libro che vuoi aggiungere al tuo
            catalogo.</p>";
        break;
     case 'profilo':
        echo "<p>Dettagli della biblioteca.</p>";   
        break;
    
}


?>
