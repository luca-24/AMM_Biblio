$(document).ready(function()
{
       
    
    $("#scegliLettore").on("click", function()
    {
        $("#registrazioneLettore").removeClass("hidden");
        $("#registrazioneBibliotecario").addClass("hidden");
    })
    
    
    $("#scegliBibliotecario").on("click", function()
    {
        $("#registrazioneBibliotecario").removeClass("hidden");
        $("#registrazioneLettore").addClass("hidden");
    })
    
    
    $("#daiInPrestito").on("click", function()
    {
        $("#daiInPrestito").hide();
        $("#formPrestito").removeClass("hidden");
    })
    
    $("#riceviDalPrestito").on("click", function()
    {
        $("#riceviDalPrestito").hide();
        $("#formRestituzione").removeClass("hidden");
    })
    
    
    
    
});




