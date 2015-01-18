<?php
include_once 'Utente.php';
/***
if(session_status()!=2)
            session_start();
include_once $_SESSION['UtentePath'];
***/

class Bibliotecario extends Utente
{
    private $nomeBiblioteca;
    private $ruolo;

    public function __constructor($nome, $cognome, $citta, $indirizzo, 
                                $email, $password, $id, $nomeBiblioteca) 
    {
        parent::__constructor($nome, $cognome, $citta, $indirizzo, $email, $password, $id);
        $this->nomeBiblioteca = $nomeBiblioteca;  
        $this->ruolo = 'bibliotecario';
    }
    
     public function setNomeBiblioteca($nomeBiblioteca)
     {
         $this->nomeBiblioteca = $nomeBiblioteca;
     }         
     
     public function setRuolo()
     {
         $this->ruolo = 'bibliotecario';
     }

          public function getNomeBiblioteca()
     {
         return $this->nomeBiblioteca;
     }
     
     public function getRuolo()
     {
         return $this->ruolo;
     }

    public function ammonisciLettore($lettore)
    {
        $nAmmonizioni = $lettore->getNAmmonizioni();
        if($nAmmonizioni==NULL)
        {
            $lettore->setNAmmonizioni(1);
            UtenteFactory::aggiornaUtente($lettore);
            return true;
        }    
        else if($nAmmonizioni<3)
        {
            $lettore->setNAmmonizioni($nAmmonizioni+1);
            UtenteFactory::aggiornaUtente($lettore);
            return true;
        }
        else
            return false;
        
    }
    
    public function caricaIscritti()
    {
        $iscritti = UtenteFactory::caricaIscritti($this);
        return $iscritti;
    }
    
    public function aggiungiLibro($libro)
    {
        $libro->setBibliotecarioId($this->getId());
        LibroFactory::creaLibro($libro);
    }
    
    public function rimuoviLibro($libro)
    {
        LibroFactory::cancellaLibro($libro);
    }
    
    
    public function caricaCatalogo()
    {
        $libri = LibroFactory::caricaLibriBiblioteca($this, 'tutti');
        return $libri;
    }
            

    public function caricaLibriPrestati()
    {
        $libri = LibroFactory::caricaLibriBiblioteca($this, 'inPrestito');
        return $libri;
    }
    
    
    public function cercaLibroPerTitoloNelCatalogo($titolo)
    {        
        $libri = LibroFactory::caricaLibriPerFiltro($titolo, 'titolo', $this);
        return $libri;                
    }
    
    public function cercaLibroPerAutoreNelCatalogo($autore)
    {
        $libri = LibroFactory::caricaLibriPerFiltro($autore, 'autore', $this);
        return $libri;                
    }
    
    
    
}

?>
