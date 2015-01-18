<?php

/*
session_start();
setcookie(session_name(), '', time() - 2592000, '/');

session_destroy();
 return;

include '/home/amm/development/Biblio/php/Settings.php';
//echo Settings::$db_host;
//return;
//echo dirname(__FILE__);
//return;
Settings::setPaths();
echo "path: ".Settings::$UtenteFactoryPath;
//include Settings::$UtenteFactoryPath;

//$u = UtenteFactory::caricaUtentePerId(1);
//echo $u->getCognome();

//echo Settings::$loggedOutControllerPath;

/***************************+
session_start();
setcookie(session_name(), '', time() - 2592000, '/');

session_destroy();
 return;
//echo realpath("Libro.php");
/*
include_once 'Lettore.php';
/*include_once '/home/amm/development/Biblio/model/Libro.php';*/
/*include_once 'UtenteFactory.php';
include_once 'LibroFactory.php';
include_once '/home/amm/development/Biblio/php/Settings.php';
//include_once '/home/amm/development/Biblio/php/indexO.php';


if(session_status()!=2)
    session_start();

Settings::setPaths();

echo "lll ".Settings::$BibliotecarioPath;
/*
$u = UtenteFactory::caricaUtentePerId(116);
echo "i".$u->getEmail();
return;

/*
echo UtenteFactory::emailExists("lll@m.it");
return;

/*include_once '/home/amm/development/Biblio/model/Utente.php';
include_once '/home/amm/development/Biblio/model/Bibliotecario.php';*/

/*
$u = new Lettore();
$u->setEmail('m@p.it');
$u->setPassword('m');
UtenteFactory::creaUtente($u);*/
/*
session_start();
setcookie(session_name(), '', time() - 2592000, '/');

session_destroy();
 return;
if (isset($_COOKIE[session_name()]))
    echo "set";
else
    echo "no";
return;

$utente = new Lettore();
$utente->setNome('Lol');
$utente->setCognome('Pop');
$utente->setEmail('lol@o.it');
$utente->setPassword('lol');
$utente->setCitta('Cagliari');
$utente->setDataDiNascita('1994-03-13');
$utente->setRuolo();

UtenteFactory::creaUtente($utente);
echo 'boh';
/*
$utente = UtenteFactory::caricaUtentePerId(1);
$libri = $utente->cercaLibroPerAutore('Hemingway');

foreach($libri as $l)
{
    echo $l->getAutore()." ".$l->getTitolo()." ".$l->getBibliotecarioId()."<br/>";
}


/*$utente = UtenteFactory::caricaUtentePerId(1);
echo $utente->getNome();
echo $utente->getDataDiNascita();
echo $utente->getCitta();

$utente->setCitta("Roma");
UtenteFactory::aggiornaUtente($utente);*/
/*
$biblioteche = UtenteFactory::caricaBibliotecheCitta('Villaputzu');
foreach ($biblioteche as $b) 
{
    echo $b->getNome()." ".$b->getCognome()."<br/>";
}
*/
/*
$utente = UtenteFactory::caricaUtentePerId(4);
$lettore = UtenteFactory::caricaUtentePerId(1);
$libro = LibroFactory::caricaLibroPerId(40);
$lettore->restituisciLibro($libro);
$lettore->disiscrivitiBiblioteca($utente);
//$lettore->prendiInPrestito($libro);
return;




/*
$libro = LibroFactory::caricaLibroPerId(36);
$lettore->prendiInPrestito($libro);


//$libro = LibroFactory::caricaLibroPerId(23);
//$lettore->prendiInPrestito($libro);
/*
$cat = $utente->caricaCatalogo();
foreach ($cat as $l) 
{
    echo $l['libro']->getAutore()." - ".$l['libro']->getTitolo()." - ".$l['nCopie']."<br/>";
}
return;*/

/*
$libro = new Libro();
$libro->setAutore('Kerouak');
$libro->setTitolo('On the road');
$libro->setNPagine(310);
$utente->aggiungiLibro($libro);

$libro2 = new Libro();
$libro2->setAutore('Hemingway');
$libro2->setTitolo('Addio alle armi');
$libro2->setNPagine(300);
$utente->aggiungiLibro($libro2);

$libro3 = new Libro();
$libro3->setAutore('Hemingway');
$libro3->setTitolo('Festa mobile');
$libro3->setNPagine(180);
$utente->aggiungiLibro($libro3);*/

/*
$libri = $lettore->cercaLibroPerAutore('Hemingway');

echo "Sono stati individuati ".count($libri)." risultati<br/>";

foreach ($libri as $l)
{
    echo $l->getAutore()." - ".$l->getTitolo()." - ".$l->getBibliotecarioId()."<br/>";
}

/*
$libri = $lettore->caricaLibriInPrestito();
foreach ($libri as $l)
{
    echo $l->getAutore()." - ".$l->getTitolo()." - ".$l->getLettoreId()."<br/>";
}

/*
$libro = LibroFactory::caricaLibroPerId(22);
$lettore->restituisciLibro($libro);


/*
$libro = new Libro();
$libro->setAutore('Hemingway');
$libro->setTitolo('Addio alle armi');
$libro->setNPagine(300);
$utente->aggiungiLibro($libro);
/*
$libro2 = new Libro();
$libro2->setAutore('Pirandello');
$libro2->setTitolo('Il fu Mattia Pascal');
$libro2->setNPagine(250);
$utente->aggiungiLibro($libro2);

$libro3 = new Libro();
$libro3->setAutore('Marquez');
$libro3->setTitolo('Amore ai tempi del colera');
$libro3->setNPagine(400);
$utente->aggiungiLibro($libro3);*/

/*
$cat = $utente->caricaCatalogo();
foreach ($cat as $l) 
{
    echo $l['libro']->getAutore()." - ".$l['libro']->getTitolo()." - ".$l['nCopie']."<br/>";
}
*/
///echo $cat[0];




/*
$utente = UtenteFactory::caricaUtentePerId(4);
$utente2 = UtenteFactory::caricaUtentePerId(2);

$utente->ammonisciLettore($utente2);

/*$iscritti = $utente->caricaMieBiblioteche();
foreach ($iscritti as $is) 
{
    echo $is->getNomeBiblioteca()." ".$is->getCitta()."<br/>";
}
*/

?>
