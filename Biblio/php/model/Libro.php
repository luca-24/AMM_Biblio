<?php


class Libro
{
    private $titolo;
    private $autore;
    private $casaEditrice;
    private $genere;
    private $nPagine;
    private $bibliotecarioId;
    private $lettoreId;
    private $dataPrestito;
    private $id;


    public function __constructor($titolo, $autore, $casaEditrice, $genere,
                        $nPagine, $bibliotecarioId, $lettoreId, $dataPrestito, $id) 
    {
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->casaEditrice = $casaEditrice;
        $this->genere = $genere;
        $this->nPagine = $nPagine;
        $this->bibliotecarioId = $bibliotecarioId;
        $this->lettoreId = $lettoreId;
        $this->dataPrestito = $dataPrestito;
        $this->id = $id;
    }
    
     public function setTitolo($titolo)
        {
            $this->titolo = $titolo;
        }
        
        public function setAutore($autore)
        {
            $this->autore = $autore;
        }        
    
        
         public function setCasaEditrice($casaEditrice)
         {
            $this->casaEditrice = $casaEditrice;
         }
     
         public function setGenere($genere)
         {
             $this->genere = $genere;
         }
        
        public function setNPagine($nPagine)
        {
            $this->nPagine = $nPagine;
        }
        
        public function setBibliotecarioId($bibliotecarioId)
        {
            $this->bibliotecarioId = $bibliotecarioId;
        }
        
        public function setLettoreId($lettoreId)
        {
            $this->lettoreId = $lettoreId;
        }
        
        public function setDataPrestito($dataPrestito)
        {
            $this->dataPrestito = $dataPrestito;
        }
        
        
        public function setId($id)
        {
            $this->id = $id;
        }

        
        public function getTitolo()
        {
            return $this->titolo;
        }
        
        public function getAutore()
        {
            return $this->autore;
        }
        
         public function getCasaEditrice()
         {
            return $this->casaEditrice;
         }
     
        public function getGenere()
        {
             return $this->genere;
        }
        
        public function getNPagine()
        {
            return $this->nPagine;
        }
        
        public function getBibliotecarioId()
        {
            return $this->bibliotecarioId;
        }
        
        public function getLettoreId()
        {
            return $this->lettoreId;
        }
        
         
        public function getDataPrestito()
        {
            return $this->dataPrestito;
        }     
    
        public function getId()
        {
            return $this->id;
        }     
    
    
}
?>
