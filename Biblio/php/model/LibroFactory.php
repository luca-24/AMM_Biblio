<?php

include_once 'Lettore.php';
include_once 'Libro.php';
include_once 'UtenteFactory.php';
include_once 'Utente.php';
include_once 'Bibliotecario.php';


/*****
if(session_status()!=2)
            session_start();
include_once $_SESSION['UtentePath'];
include_once $_SESSION['LettorePath'];
include_once $_SESSION['LibroPath'];
include_once $_SESSION['UtenteFactoryPath'];
include_once $_SESSION['BibliotecarioPath'];
****/

class LibroFactory
{
    
    public static function getMaxId()
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
        
         $query = "SELECT id 
                  FROM libri                   
                  ORDER BY id DESC";
        
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
        
        return $res->fetch_row()[0];
        
    }

    

    public static function caricaLibriInPrestito($utente)
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
        if($utente==NULL)  
        {
            echo "L'utente non esiste<br/>";
            $mysqli->close();
            return;
        }
        
        $utenteId = $utente->getId();
        
        //formulazione della query
        $query = "SELECT * 
                  FROM libri 
                  WHERE lettoreId = $utenteId
                  ORDER BY dataPrestito";
        
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
        
        //'result' è l'array destinato a contenere la lista dei libri
        $result = array();
        $i = 0;
        while($tmp = $res->fetch_array())   //ciclo finché ci sono feste
        {
            $result[$i]['libro'] = new Libro();
            $result[$i]['libro']->setTitolo($tmp['titolo']);
            $result[$i]['libro']->setAutore($tmp['autore']);
            $result[$i]['libro']->setCasaEditrice($tmp['casaEditrice']);            
            $result[$i]['libro']->setGenere($tmp['genere']);
            $result[$i]['libro']->setNPagine($tmp['nPagine']);
            $result[$i]['libro']->setBibliotecarioId($tmp['bibliotecarioId']);
            $result[$i]['libro']->setLettoreId($tmp['lettoreId']);
            $result[$i]['libro']->setDataPrestito($tmp['dataPrestito']);
            $result[$i]['libro']->setId($tmp['id']);         
            
            $i++;
        }           
        
        $mysqli->close();
        return $result;
        
        
    }
    
    public static function aggiornaLibro($libro)
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
        
        
             
            $query = "UPDATE libri SET
                  titolo = ?,
                  autore = ?,
                  casaEditrice = ?,
                  genere = ?,
                  nPagine = ?,
                  bibliotecarioId = ?,
                  lettoreId = ?,
                  dataPrestito = ?
                  WHERE id = ?";
            
            
            $stmt->prepare($query);
            if (!$stmt) 
            {
                error_log("Errore nella preparazione del prepared statement");
                $mysqli->close();
                return null;
            }
            
            
            $ctrl = $stmt->bind_param("ssssiiisi", 
                    $libro->getTitolo(),
                    $libro->getAutore(),
                    $libro->getCasaEditrice(),
                    $libro->getGenere(),
                    $libro->getNPagine(),
                    $libro->getBibliotecarioId(),
                    $libro->getLettoreId(),
                    $libro->getDataPrestito(),
                    $libro->getId()                                                        
                   );   
            
        
        
           
        
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
    
    public static function creaLibro($libro)
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
        
        
            $query = "INSERT INTO libri (                                      
                                      titolo,
                                      autore,
                                      casaEditrice,
                                      genere,
                                      nPagine,
                                      bibliotecarioId,
                                      lettoreId,                               
                                      id,
                                      dataPrestito
                                      )
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            
            $stmt->prepare($query);
            if (!$stmt) 
            {
                error_log("Errore nell'inizializzazione del prepared statement");
                $mysqli->close();
                return null;
            }        

            $ctrl = $stmt->bind_param("ssssiiiis", 
                        $libro->getTitolo(),
                        $libro->getAutore(),
                        $libro->getCasaEditrice(),
                        $libro->getGenere(),
                        $libro->getNPagine(),
                        $libro->getBibliotecarioId(),
                        $libro->getLettoreId(),
                        $libro->getId(),
                        $libro->getDataPrestito()
                       );   

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
    
    public static function cancellaLibro($libro)
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
        
        //controllo se l'utente che si vuole cancellare esiste effettivamente
        if($libro==NULL)
        {
            echo "Il libro che vuoi cancellare non esiste";
            $mysqli->close();
            return null;
        }

        //come parametro di filtro per la query usiamo l'id dell'utente, che è univoco
        $libroId = $libro->getId();
        
        $query = "DELETE FROM libri WHERE id=?";
        
        //inizializzazione del prepared statement
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if(!$stmt)
        {
            error_log("Errore nella inizializzazione dello statement");
            $mysqli->close();
            return null;
        }        
        
        $ctrl = $stmt->bind_param('i', $libroId);
        if(!$ctrl)
        {
            error_log("Errore nel bind dei parametri in input");
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
        $mysqli->close();
        
                   
    }
    
    public static function caricaLibriBiblioteca($bibliotecario, $opzione)
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
        
        $biblotecarioId = $bibliotecario->getId();
        
        
        if($opzione == 'tutti')
        {
             $query = "SELECT *, COUNT(titolo)
                  FROM libri 
                  WHERE bibliotecarioId = $biblotecarioId
                  GROUP BY titolo
                  ORDER BY autore";
        }
        else if($opzione == 'inPrestito')
        {
            $query = "SELECT * 
                  FROM libri 
                  WHERE bibliotecarioId = $biblotecarioId AND lettoreId>0
                  ORDER BY dataPrestito";
        }        
                  
        
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
        
               
        //'result' è l'array destinato a contenere la lista dei libri
        $result = array();
        $i = 0;
        while($tmp = $res->fetch_row())   //ciclo finché ci sono feste
        {
            $result[$i]['libro'] = new Libro();
            $result[$i]['libro']->setTitolo($tmp[0]);
            $result[$i]['libro']->setAutore($tmp[1]);
            $result[$i]['libro']->setCasaEditrice($tmp[2]);            
            $result[$i]['libro']->setGenere($tmp[3]);
            $result[$i]['libro']->setNPagine($tmp[4]);
            $result[$i]['libro']->setBibliotecarioId($tmp[5]);
            $result[$i]['libro']->setLettoreId($tmp[6]);
            $result[$i]['libro']->setId($tmp[7]);
            $result[$i]['libro']->setDataPrestito($tmp[8]);
            if($opzione == 'tutti')
                $result[$i]['nCopie'] = $tmp[9];
            else if($opzione == 'inPrestito')
                $result[$i]['nCopie'] = 1;
            
           $queryDisp = "SELECT *, COUNT(titolo) 
                          FROM libri 
                          WHERE titolo = \"$tmp[0]\" AND bibliotecarioId = $tmp[5] AND lettoreId>0";
            
                        
            $resDisp = $mysqli->query($queryDisp);
            if($mysqli->errno!=0)
            {
                $err = $mysqli->errno;
                $msg = $mysqli->error;
                error_log("Errore nell'esecuzione della query. $err: $msg");
                $mysqli->close();
                return NULL;
            }
            
            $tmpDisp = $resDisp->fetch_row();
            if($opzione == 'tutti')
                $result[$i]['disp'] = $tmp[9] - $tmpDisp[9];
            else if($opzione == 'inPrestito')
                $result[$i]['disp'] = 0;
            
            $i++;
        }           
        
        $mysqli->close();
        return $result;
        
        
    }
    
           
    
    public static function caricaLibriPerFiltro($filtro, $tipo, $biblioteca)
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
              
        if($biblioteca==NULL)
        {
            if($tipo == 'titolo')
            {

                 $query = "SELECT *, COUNT(bibliotecarioId) 
                      FROM libri 
                      WHERE titolo LIKE \"%$filtro%\"
                      GROUP BY bibliotecarioId
                      ";
                 
                 
            }
            else if($tipo == 'autore')
            {

                $query = "SELECT *, COUNT(bibliotecarioId) 
                          FROM libri 
                          WHERE autore LIKE \"%$filtro%\"
                          GROUP by bibliotecarioId, titolo
                          ";

            }       
               
        }
        else
        {
            $bibliotecarioId = $biblioteca->getId();
            if($tipo == 'titolo')
            {

                 $query = "SELECT *, COUNT(bibliotecarioId) 
                      FROM libri 
                      WHERE titolo LIKE \"%$filtro%\" AND bibliotecarioId = $bibliotecarioId
                      GROUP BY bibliotecarioId
                      ";
            }
            else if($tipo == 'autore')
            {

                $query = "SELECT *, COUNT(bibliotecarioId) 
                          FROM libri 
                          WHERE autore LIKE \"%$filtro%\" AND bibliotecarioId = $bibliotecarioId
                          GROUP by bibliotecarioId, titolo
                          ";

            }  
            
            
        }
           
        
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
        
        //'result' è l'array destinato a contenere la lista dei libri
        $result = array();
        $i = 0;
        while($tmp = $res->fetch_row())   //ciclo finché ci sono libri
        {
            
            $result[$i]['libro'] = new Libro();
            $result[$i]['libro']->setTitolo($tmp[0]);
            $result[$i]['libro']->setAutore($tmp[1]);
            $result[$i]['libro']->setCasaEditrice($tmp[2]);            
            $result[$i]['libro']->setGenere($tmp[3]);
            $result[$i]['libro']->setNPagine($tmp[4]);
            $result[$i]['libro']->setBibliotecarioId($tmp[5]);
            $result[$i]['libro']->setLettoreId($tmp[6]);
            $result[$i]['libro']->setDataPrestito($tmp[8]);
            $result[$i]['libro']->setId($tmp[7]);
            $result[$i]['nCopie'] = $tmp[9];
            
            
            $queryDisp = "SELECT *, COUNT(titolo) 
                          FROM libri 
                          WHERE titolo = \"$tmp[0]\" AND bibliotecarioId = $tmp[5] AND lettoreId>0";
            
                        
            $resDisp = $mysqli->query($queryDisp);
            if($mysqli->errno!=0)
            {
                $err = $mysqli->errno;
                $msg = $mysqli->error;
                error_log("Errore nell'esecuzione della query. $err: $msg");
                $mysqli->close();
                return NULL;
            }
            
            $tmpDisp = $resDisp->fetch_row();
            $result[$i]['disp'] = $tmp[9] - $tmpDisp[9];
            
            
            $i++;
        }           
        
        $mysqli->close();
        return $result;
        
        
    }
    
    public static function caricaLibroPerId($libroId)
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
        $query = "SELECT * FROM libri WHERE id=?";
        
        //inizializzazione del prepared statement
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if(!$stmt)
        {
            error_log("Errore nella inizializzazione dello statement");            
            $mysqli->close();
            return null;
        }
                
        $ctrl = $stmt->bind_param('i', $libroId);
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
                           $titolo, 
                           $autore,
                           $casaEditrice,
                           $genere,
                           $nPagine,                           
                           $bibliotecarioId,
                           $lettoreId,
                           $id,
                           $dataPrestito                                        
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
     
         
           $libro = new Libro();
           $libro->setTitolo($titolo);
           $libro->setAutore($autore);
           $libro->setCasaEditrice($casaEditrice);
           $libro->setGenere($genere);
           $libro->setNPagine($nPagine);
           $libro->setBibliotecarioId($bibliotecarioId);
           $libro->setLettoreId($lettoreId);
           $libro->setId($id);
           $libro->setDataPrestito($dataPrestito);
           
           $mysqli->close();
           return $libro;
       
               
        
    }
    
    
    public static function caricaPrimoDisponibile($titolo, $bibliotecarioId)
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
        
        $query = "SELECT * 
                  FROM libri 
                  WHERE titolo = \"$titolo\" AND bibliotecarioId = $bibliotecarioId                  
                  ";
        
        $res = $mysqli->query($query);
        if($mysqli->errno!=0)
        {
            $err = $mysqli->errno;
            $msg = $mysqli->error;
            error_log("Errore nell'esecuzione della query. $err: $msg");
            $mysqli->close();
            return NULL;
        }
        
        while ($tmp = $res->fetch_array())
        {
            if($tmp['lettoreId']==NULL)
                break;                
        }
        
        $libro = new Libro();
        $libro->setTitolo($tmp['titolo']);
        $libro->setAutore($tmp['autore']);
        $libro->setCasaEditrice($tmp['casaEditrice']);
        $libro->setGenere($tmp['genere']);
        $libro->setNPagine($tmp['nPagine']);
        $libro->setBibliotecarioId($tmp['bibliotecarioId']);
        $libro->setLettoreId($tmp['lettoreId']);
        $libro->setId($tmp['id']);
        $libro->setDataPrestito($tmp['dataPrestito']);
           
        $mysqli->close();
        return $libro;
        
    }
    
    
    
}




?>
