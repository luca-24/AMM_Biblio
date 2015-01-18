<?php

class ViewDescriptor
{
    private $titolo;
    private $headerFile;
    private $leftBarFile;
    private $rightBarFile;
    private $contentFile;
    private $footerFile;
    private $pagina;
    private $sottopagina;
    private $messaggioErrore;
    
    public function getTitolo()
    {
        return $this->titolo;
    }
    
    public function getHeaderFile()
    {
        return $this->headerFile;
    }
    
    public function getLeftBarFile()
    {
        return $this->leftBarFile;
    }
    
    public function getRightBarFile()
    {
        return $this->rightBarFile;
    }
    
    public function getContentFile()
    {
        return $this->contentFile;
    }
    
    public function getFooterFile()
    {
        return $this->footerFile;
    }
    
    public function getPagina()
    {
        return $this->pagina;
    }
    
    public function getSottopagina()
    {
        return $this->sottopagina;
    }
    
    public function getMessaggioErrore()
    {
        return $this->messaggioErrore;
    }
    
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }
    
    public function setHeaderFile($headerFile)
    {
        $this->headerFile = $headerFile;
    }
    
    public function setLeftBarFile($leftBarFile)
    {
        $this->leftBarFile = $leftBarFile;
    }
    
    public function setRightBarFile($rightBarFile)
    {
        $this->rightBarFile = $rightBarFile;
    }
    
    public function setContentFile($contentFile)
    {
        $this->contentFile = $contentFile;
    }
    
    public function setFooterFile($footerFile)
    {
        $this->footerFile = $footerFile;
    }
    
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;
    }
    
    public function setSottopagina($sottopagina)
    {
        $this->sottopagina = $sottopagina;
    }
    
    public function setMessaggioErrore($messaggioErrore)
    {
        $this->messaggioErrore = $messaggioErrore;
    }
    
}



?>
