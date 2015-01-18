<?php


class Utente
{
    private $nome;
    private $cognome;
    private $citta;
    private $indirizzo;
    private $email;
    private $password;
    private $id;
    
    
    public function __constructor($nome, $cognome, $citta, $indirizzo, 
                                $email, $password, $id) 
    {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->citta = $citta;
        $this->indirizzo = $indirizzo;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }
        
    
        public function setNome($nome)
        {
            $this->nome = $nome;
        }
        
        public function setCognome($cognome)
        {
            $this->cognome = $cognome;
        }        
    
        
         public function setCitta($citta)
         {
            $this->citta = $citta;
         }
     
         public function setIndirizzo($indirizzo)
         {
             $this->indirizzo = $indirizzo;
         }
        
        public function setEmail($email)
        {
            $this->email = $email;
        }
        
        public function setPassword($password)
        {
            $this->password = $password;
        }
        
        public function setId($id)
        {
            $this->id = $id;
        }
        
        public function setRuolo()
        {    }

        
        public function getNome()
        {
            return $this->nome;
        }
        
        public function getCognome()
        {
            return $this->cognome;
        }
        
         public function getCitta()
         {
            return $this->citta;
         }
     
        public function getIndirizzo()
        {
             return $this->indirizzo;
        }
        
        public function getEmail()
        {
            return $this->email;
        }
        
        public function getPassword()
        {
            return $this->password;
        }
        
        public function getId()
        {
            return $this->id;
        }       
                
                
    
    
}


?>
