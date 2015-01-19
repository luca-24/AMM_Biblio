//////////////
//BISOGNA INSERIRE NEL RAMO if DEI CONTROLLI, DOPO L'alert, L'ATTRIBUTO
//ACTION DEL FORM, IN MODO TALE CHE LA PAGINA RICARICATA SIA
//QUELLA CORRENTE!!!!!



$(document).ready(function()
{ 
    $("#buttonCercaLibro").on("click", function()
    {
        
        par = $("#parRicercaLibro").val();
    
        if(par == "" || par == "undefined" || par == null)
        {
            alert("Inserisci il parametro per la ricerca.");                
        }            
        else
        {   
          if($("#ruolo").val() == 'lettore')
                $("#formCercaLibro").attr("action", "http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/lettore/cercaLibro.php");
            else if($("#ruolo").val() == 'bibliotecario')
                $("#formCercaLibro").attr("action", "http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/cercaNelCatalogo.php");
        }    
   
    });
    
    //////////////
  //  action=\"/Biblio/php/controller/loggedIn/lettore/cercaLibro.php\"
   // action=\"/Biblio/php/controller/loggedIn/bibliotecario/cercaNelCatalogo.php\"
    
    
    
    
    ////////////
    
    $("#buttonCercaBiblioL").on("click", function()
    {
        
        par = $("#parRicercaBiblio").val();
    
        if(par == "" || par == "undefined" || par == null)
            {
               alert("Inserisci il parametro per la ricerca.");
            }
        else
        {           
            $("#formCercaBiblioL").attr("action", "http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/lettore/cercaBiblioteca.php") ;
        }    
   
    });
    
    
    ///////////
    
    $("#buttonAggiungiLibro").on("click", function()
    {
        
        titolo = $("#titolo").val();
        autore = $("#autore").val();
        casaEditrice = $("#casaEditrice").val();
        genere = $("#genere").val();
        nPagine = $("#nPagine").val();
        nCopie = $("#nCopie").val();
        
        nPagine = nPagine.toString();
        nCopie = nCopie.toString();
        
        invalidNPagine = false;
        for(i=0; i<nPagine.length; i++)
        {
            if(nPagine.charCodeAt(i)<48 || nPagine.charCodeAt(i)>57)
                invalidNPagine = true;
        }
        
        invalidNCopie = false;
        for(i=0; i<nCopie.length; i++)
        {
            if(nCopie.charCodeAt(i)<48 || nCopie.charCodeAt(i)>57)
                invalidNCopie = true;
        }
        
    
        if(titolo == "" || titolo == "undefined" || titolo == null
            || autore == "" || autore == "undefined" || autore == null 
            || casaEditrice == "" || casaEditrice == "undefined" || casaEditrice == null
            || genere == "" || genere == "undefined" || genere == null
            || nPagine == "" || nPagine == "undefined" || nPagine == null
            || nCopie == "" || nCopie == "undefined" || nCopie == null)
            alert("Hai lasciato qualche campo vuoto.");
        else if(invalidNPagine == true)
        {
            alert("Inserisci un valore numerico nel campo \"Numero di pagine\"");
        }
        else if(invalidNCopie == true)
        {
            alert("Inserisci un valore numerico nel campo \"Numero di copie\"");
            
        }
        else
        {           
            $("#formAggiungiLibro").attr("action", "http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedIn/bibliotecario/bibliotecarioController.php") ;
            $("#formAggiungiLibro").submit();
        }    
   
    });
   
   
    /////////
    
    
    
    $("#submitL").on("click", function()
     {      
         
        nomeL = $("#nameL").val();
        cognomeL = $("#surnameL").val();
        cittaL = $("#cityL").val();
        indirizzoL = $("#addressL").val();
        dataDiNascitaL = $("#dateL").val();
        emailL = $("#emailL").val();
        passwordL = $("#passwordL").val();
        
        invalid = false;
        
        anno = dataDiNascitaL.substring(0, 4);
        mese = dataDiNascitaL.substring(5, 7);
        giorno = dataDiNascitaL.substring(8, 10);
        
        anno = anno.toString();
        mese = mese.toString();
        giorno = giorno.toString();
        
        if(anno.length<4)
            invalid = true;
        for(i=0; i<anno.length; i++)
        {
            if(anno.charCodeAt(i)<48 || anno.charCodeAt(i)>57)
                invalid = true;
        }
        
        if(mese.length<2)
                invalid = true;
        for(i=0; i<mese.length; i++)
        {
            if(mese.charCodeAt(i)<48 || mese.charCodeAt(i)>57)
                invalid = true;
        }
        
        if(giorno.length<2)
                invalid = true;
        
        for(i=0; i<giorno.length; i++)
        {
            if(giorno.charCodeAt(i)<48 || giorno.charCodeAt(i)>57)
                invalid = true;
        }
        
        invalidMail = true;
        found = false;
        for(i=0; i<emailL.length; i++)
        {
            if(emailL.charAt(i)== '@')
            {
               found = true;
               break; 
            }
                               
        }
        
        if(found==true && i<emailL.length-1 && i!=0)
            invalidMail = false;
       
        esisteGia= false;
        $.ajax(
        {
            url: "http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedOut/checkEmail.php",
            data: 
            {
                email : emailL        
            },
            async : false,
            type : "POST",
            dataType : 'json',
            success : function(data)
            {
                esisteGia = !data;             
            },
            error : function(data)
            {
                alert("Errore nella connessione al server");                
            }
            
        });
         
         
        if(nomeL == "undefined" || nomeL == "" || nomeL == null
            || cognomeL == "" || cognomeL == "undefined" || cognomeL == null
            || cittaL == "" || cittaL == "undefined" || cittaL == null
            || indirizzoL == "" || indirizzoL == "undefined" || indirizzoL == null
            || dataDiNascitaL == "" || dataDiNascitaL == "undefined" || dataDiNascitaL == null
            || emailL == "" || emailL == "undefined" || emailL == null
            || passwordL == "" || passwordL == "undefined" || passwordL == null)
            {
                 alert("Hai lasciato in bianco qualche campo.");
             }
        else if(esisteGia==true)
        {
            alert("Esiste già un utente registrato con questa email.\nPotresti aver sbagliato digitando, oppure potresti essere già registrato.");
        }
        else if(invalid==true
            || giorno < 0 || giorno > 31 || mese < 0 || mese > 12 || anno < 0
            || (mese== 2 && giorno > 29)
            || ((mese == 4 || mese == 6 || mese == 9 || mese == 11) && giorno > 30))
                alert("Errore nell'inserimento della data.\nPer favore, utilizzare il formato anno-mese-giorno.");
         else if(invalidMail == true)
         {
                alert("Errore nell'inserimento dell'indirizzo e-mail.");                 
         }         
         else
            {
                $("#registrazioneL").attr("action", "http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedOut/loggedOutController.php");   
                $("#registrazioneL").submit();
            }    
     });
     
     
     
     $("#submitB").on("click", function()
     {      
         
        nomeB = $("#nameB").val();
        cognomeB = $("#surnameB").val();
        cittaB = $("#cityB").val();
        indirizzoB = $("#addressB").val();
        emailB = $("#emailB").val();
        passwordB = $("#passwordB").val();
        nomeBiblioteca = $("#nomeBiblioteca");
        
        invalidMail = true;
        found = false;
        for(i=0; i<emailB.length; i++)
        {
            if(emailB.charAt(i)== '@')
            {
               found = true;
               break; 
            }
                               
        }
        
        if(found==true && i<emailB.length-1 && i!=0)
            invalidMail = false;
        
        esisteGia= false;
        $.ajax(
        {
            url: "http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedOut/checkEmail.php",
            data: 
            {
                email : emailB        
            },
            async : false,
            type : "POST",
            dataType : 'json',
            success : function(data)
            {
                esisteGia = !data;             
            },
            error : function(data)
            {
                alert("Errore nella connessione al server");                
            }
            
        });
         
        if(nomeB == "undefined" || nomeB == "" || nomeB == null
            || cognomeB == "" || cognomeB == "undefined" || cognomeB == null
            || cittaB == "" || cittaB == "undefined" || cittaB == null
            || indirizzoB == "" || indirizzoB == "undefined" || indirizzoB == null
            || emailB == "" || emailB == "undefined" || emailB == null
            || passwordB == "" || passwordB == "undefined" || passwordB == null)
            {
                 alert("Hai lasciato in bianco qualche campo.");
            }
        else if(esisteGia==true)
        {
            alert("Esiste già un utente registrato con questa email.\nPotresti aver sbagliato digitando, oppure potresti essere già registrato.");
        }
        else if(invalidMail==true)
        {
            alert("Errore nell'inserimento dell'indirizzo e-mail");
        }
        else
            {
                $("#registrazioneB").attr("action", "http://spano.sc.unica.it/amm2014/pirasLuca/Biblio/php/controller/loggedOut/loggedOutController.php");   
                $("#registrazioneB").submit();
             }    
     });
     
     
     
     

});