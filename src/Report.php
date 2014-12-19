<?php

namespace BirtRenderer;

use InvalidArgumentException;
use SimpleXMLElement;

class Report
{
    private $filename;
    private $xml;
    
    public function __construct()
    {
    }

    public function loadFilename($filename)
    {
        $this->filename = $filename;
        if (!file_exists($filename)) {
            throw new InvalidArgumentException("File not found: " . $filename);
        }
        $xmlstring = file_get_contents($filename);
        $this->loadXmlString($xmlstring);
    }
    
    private function loadXmlString($xmlstring)
    {
        $this->xml = new SimpleXMLElement($xmlstring);
        //print_r($this->xml);
    }
    
    public function getFilename()
    {
        return $this->filename;
    }
}
