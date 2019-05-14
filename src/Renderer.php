<?php

namespace BirtRenderer;

use RuntimeException;

class Renderer
{
    public function render(Report $report, $parameters, $outputfilename, $options)
    {
        $format = null;
        $outputextension = pathinfo($outputfilename, PATHINFO_EXTENSION);
        if (!$format) {
            switch ($outputextension) {
                case 'pdf':
                    $format = 'pdf';
                    break;
                case 'html':
                    $format = 'html';
                    break;
                case 'doc':
                    $format = 'doc';
                    break;
                case 'docx':
                    $format = 'docx';
                    break;    
                case 'xls':
                    $format = 'xls';
                    break;
                case 'xlsx':
                    $format = 'xlsx';
                    break;    
                case 'ppt':
                    $format = 'ppt';
                    break;
                case 'pptx':
                    $format = 'pptx';
                    break;           
                case 'postscript':
                case 'ps':
                    $format = 'postscript';
                    break;
                default:
                    throw new RuntimeException("Can't auto-determine format by outputfilename extension. Please pass specifically in the options, or use a recognised filename extension.");
                    break;
            }
        }
        if (!file_exists($this->birthome)) {
            throw new RuntimeException("Undefined or invalid BIRT_HOME: " . $this->birthome);
        }
        $scriptfilename = $this->birthome . '/ReportEngine/genReport.sh';
        if (!file_exists($scriptfilename)) {
            throw new RuntimeException("Script not found: " . $scriptfilename);
        }
        $cmd = $scriptfilename;
        foreach ($parameters as $parameter) {
            $cmd .= " --parameter \"" . $parameter->getKey() . "=" . $parameter->getValue() . "\"";
        }
        
        $cmd .= " -f " . $format;
        $cmd .= " -o " . $outputfilename;
        $cmd .= " --file " . $report->getFilename();
        
        //echo $cmd . "\n";
        putenv('BIRT_HOME=' . $this->birthome);
        exec($cmd, $output);
    }
    
    public function setBirtHome($birthome)
    {
        $this->birthome = $birthome;
    }
}
