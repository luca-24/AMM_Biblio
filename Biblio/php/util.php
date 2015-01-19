<?php

//Classe che contiene funzioni utili per la formattazione delle date

class Util
{
    public static function stringData($data)
    {
        $anno = substr($data, 0, 4);
        $mese = substr($data, 5, 2);
        $giorno = substr($data, 8, 2);
        
        switch($mese)
        {
            case "01":
                $strM = "Gennaio";
                break;
            case "02":
                $strM = "Febbraio";
                break;
            case "03":
                $strM = "Marzo";
                break;
            case "04":
                $strM = "Aprile";
                break;
            case "05":
                $strM = "Maggio";
                break;
            case "06":
                $strM = "Giugno";
                break;
            case "07":
                $strM = "Luglio";
                break;
            case "08":
                $strM = "Agosto";
                break;
            case "09":
                $strM = "Settembre";
                break;
            case "10":
                $strM = "Ottobre";
                break;
            case "11":
                $strM = "Novembre";
                break;
            case "12":
                $strM = "Dicembre";
                break;
                
        }
        
        return $giorno." ".$strM." ".$anno;
    }
    
    public static function invData($data)
    {
        $anno = substr($data, 0, 4);
        $mese = substr($data, 5, 2);
        $giorno = substr($data, 8, 2);
        
        return $giorno."/".$mese."/".$anno;
    }

}



?>
