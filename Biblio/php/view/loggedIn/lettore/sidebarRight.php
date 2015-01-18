
<img src="/Biblio/imgs/info.png" alt="info" height="16px" width="16px" id="info">
<?php
switch ($vd->getSottopagina())
{
    case 'home':
        echo "<p>Esegui la ricerca scegliendo i parametri pi&ugrave; adeguati.</p>";
        break;
    case 'libriTrovati':
        echo "<p>Clicca sull'icona corrispondente al libro che ti interessa per
              visualizzarne i dettagli e per eventualmente richiederne il prestito</p>";
        break;
    case 'bibliotecheTrovate':
        echo "<p>Clicca sull'icona corrispondente alla biblioteca che ti interessa per
                visualizzarne i dettagli e per eventualmente richiedere l'iscrizione.</p>";
        break;
    case 'profilo':
        echo "<p>Informazioni personali dell'utente</p>";
        break;
    case 'schedaLibro':
        echo "<p>Da questa pagina hai la possibilit&agrave; di bloccare il libro per
                 prenderlo in prestito. Nel caso non fossi iscritto alla biblioteca, 
                 dovrai prima procedere con l'iscrizione per poter prendere in prestito
                 il libro</p>";
        break;
    case 'libroInPrestito':
        echo "<p>Dettagli del libro che hai preso in prestito</p>";
        break;
    case 'schedaBiblioteca':
        echo "<p>Da questa pagina hai la possibilit&agrave; di iscriverti alla biblioteca,
            (se gi&agrave; non sei iscritto), visualizzarne il catalogo ed effettuare
            una ricerca all'interno dello stesso.</p>";
        break;
    
}


?>
