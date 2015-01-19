<?php

//Classe che modella il ruolo del lettore, attribuendogli
//variabili di stato e metodi specifici; estende la classe Utente

include_once 'Utente.php';

class Lettore extends Utente
{
    private $nAmmonizioni;
    private $dataDiNascita;
    private $ruolo;


    public function __constructor($nome, $cognome, $citta, $indirizzo, $email, 
                                 $password, $id, $nAmmonizioni, $dataDiNascita) 
    {
        parent::__constructor($nome, $cognome, $citta, $indirizzo, $email, $password, $id);
        $this->nAmmonizioni = $nAmmonizioni;   
        $this->dataDiNascita = $dataDiNascita;
        $this->ruolo = 'lettore';
    }
        
    public function setNAmmonizioni($nAmmonizioni)
    {
        $this->nAmmonizioni = $nAmmonizioni;
    }
    
    public function setDataDiNascita($dataDiNascita)
    {
        $this->dataDiNascita = $dataDiNascita;
    }
    
    
    public function setRuolo()
    {
        $this->ruolo = "lettore";
    }

        public function getNAmmonizioni()
    {
        return $this->nAmmonizioni;
    }
    
    public function getDataDiNascita()
    {
        return $this->dataDiNascita;
    }
    
     public function getRuolo()
     {
         return $this->ruolo;
     }  
    
    public function iscrivitiBiblioteca($bibliotecario)
    {
        if(!$this->isIscritto($bibliotecario))
        {
            UtenteFactory::nuovaIscrizione($bibliotecario, $this);
            return true;
        }
        else
            return false;
    }

    
        
    public function disiscrivitiBiblioteca($bibliotecario)
    {
        $flag = FALSE;
        if($this->isIscritto($bibliotecario))
        {
            $libri = $this->caricaLibriInPrestito();
            foreach ($libri as $l) 
            {
                if($l['libro']->getBibliotecarioId()==$bibliotecario->getId())
                    $flag = TRUE;
            }
            if(!$flag)
            {
                UtenteFactory::cancellaIscrizione($bibliotecario, $this);
                return TRUE;
            }
            return FALSE;
            
        }
        else
            return FALSE;
    }
    
    
    public function isIscritto($bibliotecario)
    {
        $isIscritto = UtenteFactory::caricaIscrizione($bibliotecario, $this);
        if($isIscritto == NULL)
            return FALSE;        
        else
            return TRUE;
    }

    public function caricaMieBiblioteche()
    {
        $biblioteche = UtenteFactory::caricaBibliotecheACuiIscritto($this);
        return $biblioteche;
    }
    
    public function prendiInPrestito($libro)
    {
       $libro->setLettoreId($this->getId());
       date_default_timezone_set('UTC');
       $libro->setDataPrestito(date('Y-m-d'));
       LibroFactory::aggiornaLibro($libro);
    }
    
    public function restituisciLibro($libro)
    {
       $libro->setLettoreId(NULL);
       $libro->setDataPrestito(NULL);            
       LibroFactory::aggiornaLibro($libro);
       
    }

    public function caricaLibriInPrestito()
    {
        $libri = LibroFactory::caricaLibriInPrestito($this);
        return $libri;
    }
    
    public function cercaLibroPerTitolo($titolo)
    {
        $libri = LibroFactory::caricaLibriPerFiltro($titolo, 'titolo', NULL);
        return $libri;                
    }
    
    public function cercaLibroPerAutore($autore)
    {
        $libri = LibroFactory::caricaLibriPerFiltro($autore, 'autore', NULL);
        return $libri;                
    }
    
    
    public function cercaLibroPerTitoloPerBiblioteca($titolo, $biblioteca)
    {        
        $libri = LibroFactory::caricaLibriPerFiltro($titolo, 'titolo', $biblioteca);
        return $libri;                
    }
    
    public function cercaLibroPerAutorePerBiblioteca($autore, $biblioteca)
    {
        $libri = LibroFactory::caricaLibriPerFiltro($autore, 'autore', $biblioteca);
        return $libri;                
    }
    
    
}

?>
