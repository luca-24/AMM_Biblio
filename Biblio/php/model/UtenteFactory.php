<?php


include_once 'Lettore.php';
include_once 'Libro.php';
include_once 'UtenteFactory.php';
include_once 'Utente.php';
include_once 'Bibliotecario.php';


/***
if(session_status()!=2)
            session_start();
include_once $_SESSION['UtentePath'];
include_once $_SESSION['LettorePath'];
include_once $_SESSION['LibroPath'];
include_once $_SESSION['UtenteFactoryPath'];
include_once $_SESSION['BibliotecarioPath'];
***/

class UtenteFactory
{
    public static function caricaUtente($email, $password)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return null;
        }
        
        //formulazione della query SQL  
        $query = "SELECT * FROM users WHERE email=? AND password=?";
        
        //inizializzazione del prepared statement
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if(!$stmt)
        {
            error_log("Errore nella inizializzazione dello statement");
            $mysqli->close();
            return null;
        }      
        
        //la variabile 'ctrl' è usata ripetutamente per controllare la presenza di
        //eventuali errori
        $ctrl = $stmt->bind_param('ss', $email, $password);
        if(!$ctrl)
        {
            error_log("Errore nel bind dei parametri in input");
            $mysqli->close();
            return null;
        }
        
        
        //esecuzione dello statement      
        $ctrl = $stmt->execute();
        if(!$ctrl)
        {
            error_log("Errore nell'esecuzione dello statement");
            $mysqli->close();
            return null;
        }
        
               
        $ctrl = $stmt->bind_result( 
                           $nome, 
                           $cognome,
                           $citta,
                           $indirizzo,
                           $dataDiNascita,
                           $email,
                           $password,
                           $nomeBiblioteca,
                           $nAmmonizioni,
                           $ruolo,
                           $id                                   
                           );
       
        if(!$ctrl)
        {
            error_log("Errore nel bind dei parametri in output");
            $mysqli->close();
            return null;
        }
     
              
       //fetch del risultato         
       $ctrl = $stmt->fetch();
       if(!$ctrl)
       {
            error_log("Errore nel fetch dello statement");
            $mysqli->close();
            return null;
       }
       
       //creiamo un Administrator o un Joiner a seconda del ruolo dell'utente selezionato     
       if($ruolo == "bibliotecario")
       {
           $bibl = new Bibliotecario();
           $bibl->setNome($nome);
           $bibl->setCognome($cognome);
           $bibl->setCitta($citta);
           $bibl->setIndirizzo($indirizzo);           
           $bibl->setEmail($email);
           $bibl->setPassword($password);
           $bibl->setNomeBiblioteca($nomeBiblioteca);
           $bibl->setId($id);
           $bibl->setRuolo();
           
           $mysqli->close();
           return $bibl;
       }
       
       else if($ruolo == "lettore")
       {
           $lettore = new Lettore();
           $lettore->setNome($nome);
           $lettore->setCognome($cognome);
           $lettore->setCitta($citta);
           $lettore->setIndirizzo($indirizzo);
           $lettore->setDataDiNascita($dataDiNascita);
           $lettore->setEmail($email);
           $lettore->setPassword($password);
           $lettore->setNAmmonizioni($nAmmonizioni);
           $lettore->setId($id);
           $lettore->setRuolo();
           
           $mysqli->close();     
           return $lettore;
       }
        
        
    }
    
    
    public static function caricaUtentePerId($utenteId)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return null;
        }
        
        //formulazione della query
        $query = "SELECT * FROM users WHERE id=?";
        
        //inizializzazione del prepared statement
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if(!$stmt)
        {
            error_log("Errore nella inizializzazione dello statement");            
            $mysqli->close();
            return null;
        }
                
        $ctrl = $stmt->bind_param('i', $utenteId);
        if(!$ctrl)
        {
            error_log("Errore nel bind dei parametri in input");            
            $mysqli->close();
            return null;
        }
        
        //esecuzione dello statement
        $ctrl = $stmt->execute();
        if(!$ctrl)
        {
            error_log("Errore nell'esecuzione dello statement");            
            $mysqli->close();
            return null;
        }
        
        
        $ctrl = $stmt->bind_result( 
                           $nome, 
                           $cognome,
                           $citta,
                           $indirizzo,
                           $dataDiNascita,                           
                           $email,
                           $password,
                           $nomeBiblioteca,
                           $nAmmonizioni,
                           $ruolo,
                           $id                                        
                );
       
        if(!$ctrl)
        {
            error_log("Errore nel bind dei parametri in output");            
            $mysqli->close();
            return null;
        }
              
       //fetch del risultato 
       $ctrl = $stmt->fetch();
       if(!$ctrl)
       {
            error_log("Errore nel fetch dello statement");            
            $mysqli->close();
            return null;
       }
     
       
       //A seconda del valore di 'ruolo', creo un Administrator o un Joiner
       if($ruolo == "bibliotecario")
       {
          
           $bibl = new Bibliotecario();
           $bibl->setNome($nome);
           $bibl->setCognome($cognome);
           $bibl->setCitta($citta);
           $bibl->setIndirizzo($indirizzo);
           $bibl->setNomeBiblioteca($nomeBiblioteca);
           $bibl->setEmail($email);
           $bibl->setPassword($password);
           $bibl->setId($id);
           $bibl->setRuolo();
           
           $mysqli->close();
           return $bibl;
       }
       
       else if($ruolo == "lettore")
       {
          
           $lettore = new Lettore();
           $lettore->setNome($nome);
           $lettore->setCognome($cognome);
           $lettore->setDataDiNascita($dataDiNascita);
           $lettore->setCitta($citta);
           $lettore->setIndirizzo($indirizzo);
           $lettore->setEmail($email);
           $lettore->setPassword($password); 
           $lettore->setNAmmonizioni($nAmmonizioni);
           $lettore->setId($id);
           $lettore->setRuolo();
                      
           $mysqli->close();
           return $lettore;
       }
        
        
    }
    
    
    public static function aggiornaUtente($utente)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione al server. $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione: $mysqli->connect_error";
            $mysqli->close();
            return null;
        }
        
        //inizializzazione del prepared statement
        $stmt = $mysqli->stmt_init();
        if (!$stmt) 
        {
              error_log("Errore nell'inizializzazione del prepared statement");
              $mysqli->close();
              return null;
        }
        
        
        //la formulazione della query è diversa a seconda che l'utente sia un
        //Joiner o un Administrator
        if($utente->getRuolo()=="lettore")
        {
            $query = "UPDATE users SET
                  nome = ?,
                  cognome = ?,
                  dataDiNascita = ?,
                  citta = ?,
                  indirizzo = ?,
                  email = ?,
                  password = ?,
                  nAmmonizioni = ?,
                  ruolo = ?                                    
                  WHERE id = ?";
            
            
            $stmt->prepare($query);
            if (!$stmt) 
            {
                error_log("Errore nella preparazione del prepared statement");
                $mysqli->close();
                return null;
            }
            
            
            $ctrl = $stmt->bind_param("sssssssisi", 
                    $utente->getNome(),
                    $utente->getCognome(),
                    $utente->getDataDiNascita(),
                    $utente->getCitta(),
                    $utente->getIndirizzo(),
                    $utente->getEmail(),
                    $utente->getPassword(),
                    $utente->getNAmmonizioni(),
                    $utente->getRuolo(),
                    $utente->getId()                                       
                   );   
            
        }
        
        else if($utente->getRuolo()=="bibliotecario")
        {
            $query = "UPDATE users SET
                  nome = ?,
                  cognome = ?,
                  citta = ?,
                  indirizzo = ?
                  email = ?,
                  password = ?,
                  nomeBiblioteca = ?,
                  ruolo = ?
                  WHERE id = ?";   
             
            $stmt->prepare($query);
            if (!$stmt) 
            {
                error_log("Errore nell'inizializzazione del prepared statement");
                $mysqli->close();
                return null;
            }
             
             $ctrl = $stmt->bind_param('ssssssssi',
                $utente->getNome(),
                $utente->getCognome(),
                $utente->getCitta(),
                $utente->getIndirizzo(),
                $utente->getEmail(),
                $utente->getPassword(),
                $utente->getNomeBiblioteca(),
                $utente->getRuolo(),
                $utente->getId()   
                );    
             
        }        
        
        //controllo dell'errore
         if (!$ctrl) 
         {
             error_log("Errore nel binding in input");
             $mysqli->close();
             return null;
         }
            
         //esecuzione dello statement
         $ctrl = $stmt->execute();
         if(!$ctrl)
         {
             error_log("Errore nell'esecuzione della query");
             $mysqli->close();
             return 0;
         }
        
         $mysqli->close();
         
    }
    
    
    public static function creaUtente($utente)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione al server. $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione: $mysqli->connect_error";
            $mysqli->close();
            return null;
        }
                
        
        //inizializzazione dello statement
        $stmt = $mysqli->stmt_init();
        if (!$stmt) 
        {
              error_log("Errore nell'inizializzazione del prepared statement");
              $mysqli->close();
              return null;
        }
        
        //formulazione della query
        $mysqli->autocommit(FALSE);
        //controllo se l'utente che si vuole creare esiste già (si presume che
        //l'email sia univoca per ogni utente)
        $ctrl = self::caricaUtente($utente->getEmail(), $utente->getPassword());
        if($ctrl!=NULL)
        {
            echo "<br/>Esiste gi&agrave un utente registrato con le stesse credenziali<br/>";
            $mysqli->rollback();
            $mysqli->close();
            return null;
        }
        
        if($utente->getRuolo()=='bibliotecario')
        {
            $query = "INSERT INTO users (                                      
                                      nome,
                                      cognome,
                                      citta,
                                      indirizzo,
                                      email,
                                      password,
                                      nomeBiblioteca,                               
                                      ruolo,
                                      id
                                      )
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            
            $stmt->prepare($query);
            if (!$stmt) 
            {
                error_log("Errore nell'inizializzazione del prepared statement");
                $mysqli->rollback();
                $mysqli->close();
                return null;
            }        

            $ctrl = $stmt->bind_param('ssssssssi', 
                                       $utente->getNome(),
                                       $utente->getCognome(),
                                       $utente->getCitta(),
                                       $utente->getIndirizzo(),
                                       $utente->getEmail(),
                                       $utente->getPassword(),                                  
                                       $utente->getNomeBiblioteca(),
                                       $utente->getRuolo(),
                                       $utente->getId()
                                    );

            if (!$ctrl) 
            {
                error_log("Errore nel binding in input");
                $mysqli->rollback();
                $mysqli->close();
                return null;
            }
        
            
        }
        else if ($utente->getRuolo()=='lettore')
        {
               $query = "INSERT INTO users (                                      
                                      nome,
                                      cognome,
                                      dataDiNascita,
                                      citta,
                                      indirizzo,
                                      email,
                                      password,
                                      nAmmonizioni,                              
                                      ruolo,
                                      id
                                      )
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
               
               
               $stmt->prepare($query);
                if (!$stmt) 
                {
                    error_log("Errore nell'inizializzazione del prepared statement");
                    $mysqli->rollback();
                    $mysqli->close();
                    return null;
                }        

                $ctrl = $stmt->bind_param('sssssssisi', 
                                           $utente->getNome(),
                                           $utente->getCognome(),
                                           $utente->getDataDiNascita(),
                                           $utente->getCitta(),
                                           $utente->getIndirizzo(),
                                           $utente->getEmail(),
                                           $utente->getPassword(),                                  
                                           $utente->getNAmmonizioni(),
                                           $utente->getRuolo(),
                                           $utente->getId()
                                        );

                if (!$ctrl) 
                {
                    error_log("Errore nel binding in input");
                    $mysqli->rollback();
                    $mysqli->close();
                    return null;
                }


               
        }                        
        
         //esecuzione dello statement  
         $ctrl = $stmt->execute();
         if(!$ctrl)
         {
             error_log("Errore nell'esecuzione della query");
             $mysqli->rollback();
             $mysqli->close();
             return 0;
         }
            
         $mysqli->commit();
         $mysqli->autocommit(TRUE);
         $mysqli->close();
        
    }
    
    
    public static function caricaBibliotechePerFiltro($filtro, $tipo)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return null;
        }
        
        //formulazione della query
        if($tipo == 'citta')
        {
            $query = "SELECT * 
                      FROM users 
                      WHERE ruolo='bibliotecario' AND citta LIKE \"%$filtro%\"";
        }            
        else if($tipo == 'nomeBiblioteca')
        {
            $query = "SELECT * 
                      FROM users 
                      WHERE ruolo='bibliotecario' AND nomeBiblioteca LIKE \"%$filtro%\"";
        }
            
        
        $res = $mysqli->query($query);
        if($mysqli->errno!=0)
        {
            $err = $mysqli->errno;
            $msg = $mysqli->error;
            error_log("Errore nell'esecuzione della query. $err: $msg");
            $mysqli->close();
            return NULL;
        }
        
        //'result' è l'array destinato a contenere la lista dei bibliotecari
        $result = array();
        $i = 0;
        while($tmp = $res->fetch_array())   //ciclo finché ci sono feste
        {
            $result[$i] = new Bibliotecario();
            $result[$i]->setNome($tmp['nome']);
            $result[$i]->setCognome($tmp['cognome']);
            $result[$i]->setCitta($tmp['citta']);
            $result[$i]->setIndirizzo($tmp['indirizzo']);
            $result[$i]->setEmail($tmp['email']);
            $result[$i]->setPassword($tmp['email']);
            $result[$i]->setNomeBiblioteca($tmp['nomeBiblioteca']);
            $result[$i]->setRuolo();
            $result[$i]->setId($tmp['id']);        
            
            $i++;
        }
           
        
        $mysqli->close();
        return $result;    
        
    }
    
    public static function nuovaIscrizione($bibliotecario, $lettore)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return;
        }
        
               
        $bibliotecarioId = $bibliotecario->getId();
        $lettoreId = $lettore->getId();
        
        $query = "INSERT INTO iscrizioni (bibliotecarioId, lettoreId)
                  VALUES ($bibliotecarioId, $lettoreId)";
        
        
        //esecuzione della query (non uso i prepared statements in quanto non c'è
        //rischio di sql-injection)
        $mysqli->query($query);
        if($mysqli->errno!=0)
        {
            $err = $mysqli->errno;
            $msg = $mysqli->error;
            error_log("Errore nell'esecuzione della query. $err: $msg");
            $mysqli->close();
            return FALSE;
        }
        
        $mysqli->close();
        return TRUE;
        
    }
    
     public static function cancellaIscrizione($bibliotecario, $lettore)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return;
        }
        
               
        $bibliotecarioId = $bibliotecario->getId();
        $lettoreId = $lettore->getId();
        
        $query = "DELETE FROM iscrizioni
                  WHERE bibliotecarioId = $bibliotecarioId AND  lettoreId = $lettoreId";
        
        
        //esecuzione della query (non uso i prepared statements in quanto non c'è
        //rischio di sql-injection)
        $mysqli->query($query);
        if($mysqli->errno!=0)
        {
            $err = $mysqli->errno;
            $msg = $mysqli->error;
            error_log("Errore nell'esecuzione della query. $err: $msg");
            $mysqli->close();
            return FALSE;
        }
        
        $mysqli->close();
        return TRUE;
        
    }
    
    
    public static function caricaIscrizione($bibliotecario, $lettore)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return;
        }
        
        $bibliotecarioId = $bibliotecario->getId();
        $lettoreId = $lettore->getId();
        
        //formulazione della query
        $query = "SELECT *
                  FROM iscrizioni 
                  WHERE bibliotecarioId = $bibliotecarioId AND lettoreId = $lettoreId";
        
        //esecuzione della query (non uso i prepared statements in quanto non c'è
        //rischio di sql-injection)
        $res = $mysqli->query($query);
        if($mysqli->errno!=0)
        {
            $err = $mysqli->errno;
            $msg = $mysqli->error;
            error_log("Errore nell'esecuzione della query. $err: $msg");
            $mysqli->close();
            return;
        }
        
        //fetch del risultato
        $val = $res->fetch_row();
        $mysqli->close();
        return $val;
        
    }
    
    
    public static function caricaIscritti($bibliotecario)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return;
        }
        
        //controllo se l'utente esiste effettivamente
        if($bibliotecario==NULL)  
        {
            echo "L'utente non esiste<br/>";
            $mysqli->close();
            return;
        }
        
        $bibliotecarioId = $bibliotecario->getId();
        
        //formulazione della query
        $query = "SELECT * 
                  FROM users 
                  JOIN iscrizioni ON iscrizioni.lettoreId = users.id
                  WHERE iscrizioni.bibliotecarioId = $bibliotecarioId
                  ORDER BY cognome";
        
        //esecuzione della query (non uso i prepared-statements in quanto non c'è
        //rischio di sql-injection
        $res = $mysqli->query($query);
        if($mysqli->errno!=0)
        {
            $err = $mysqli->errno;
            $msg = $mysqli->error;
            error_log("Errore nell'esecuzione della query. $err: $msg");
            $mysqli->close();
            return NULL;
        }
        
        //'result' è l'array destinato a contenere la lista dei lettori
        $result = array();
        $i = 0;
        while($tmp = $res->fetch_array())   //ciclo finché ci sono feste
        {
            $result[$i] = new Lettore();
            $result[$i]->setNome($tmp['nome']);
            $result[$i]->setCognome($tmp['cognome']);
            $result[$i]->setDataDiNascita($tmp['dataDiNascita']);            
            $result[$i]->setCitta($tmp['citta']);
            $result[$i]->setIndirizzo($tmp['indirizzo']);
            $result[$i]->setEmail($tmp['email']);
            $result[$i]->setPassword($tmp['password']);
            $result[$i]->setNAmmonizioni($tmp['nAmmonizioni']);
            $result[$i]->setRuolo();
            $result[$i]->setId($tmp['id']);         
            
            $i++;
        }           
        
        $mysqli->close();
        return $result;
        
        
    }
    
     public static function caricaBibliotecheACuiIscritto($lettore)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return;
        }
        
        //controllo se l'utente esiste effettivamente
        if($lettore==NULL)  
        {
            echo "L'utente non esiste<br/>";
            $mysqli->close();
            return;
        }
        
        $lettoreId = $lettore->getId();
        
        //formulazione della query
        $query = "SELECT * 
                  FROM users 
                  JOIN iscrizioni ON iscrizioni.bibliotecarioId = users.id
                  WHERE iscrizioni.lettoreId = $lettoreId
                  ORDER BY cognome";
        
        //esecuzione della query (non uso i prepared-statements in quanto non c'è
        //rischio di sql-injection
        $res = $mysqli->query($query);
        if($mysqli->errno!=0)
        {
            $err = $mysqli->errno;
            $msg = $mysqli->error;
            error_log("Errore nell'esecuzione della query. $err: $msg");
            $mysqli->close();
            return NULL;
        }
        
        //'result' è l'array destinato a contenere la lista dei lettori
        $result = array();
        $i = 0;
        while($tmp = $res->fetch_array())   //ciclo finché ci sono feste
        {
            $result[$i] = new Bibliotecario();
            $result[$i]->setNome($tmp['nome']);
            $result[$i]->setCognome($tmp['cognome']);                       
            $result[$i]->setCitta($tmp['citta']);
            $result[$i]->setIndirizzo($tmp['indirizzo']);
            $result[$i]->setEmail($tmp['email']);
            $result[$i]->setPassword($tmp['password']);
            $result[$i]->setNomeBiblioteca($tmp['nomeBiblioteca']);
            $result[$i]->setRuolo();
            $result[$i]->setId($tmp['id']);         
            
            $i++;
        }           
        
        $mysqli->close();
        return $result;
        
        
    }
    
    function emailExists($email)
    {
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        
        if($mysqli->connect_errno!=0)
        {
            error_log("Errore nella connessione col server. 
                    $mysqli->connect_errno: $mysqli->connect_error");
            echo "Errore nella connessione";
            $mysqli->close();
            return;
        }
        
        $query = "SELECT count(*) 
                  FROM users 
                  WHERE email = \"$email\"";
        
        //esecuzione della query (non uso i prepared-statements in quanto non c'è
        //rischio di sql-injection
        $res = $mysqli->query($query);
        if($mysqli->errno!=0)
        {
            $err = $mysqli->errno;
            $msg = $mysqli->error;
            error_log("Errore nell'esecuzione della query. $err: $msg");
            $mysqli->close();
            return NULL;
        }
        
        $result = $res->fetch_row();
        if($result[0] > 0)
            return 1;
        else
            return 0;
        
    }

    
   
    
}
?>
