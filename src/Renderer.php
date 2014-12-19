<?php

namespace BirtRenderer;

class Renderer
{
    public function render(Report $report, $parameters, $outputfilename)
    {
        if (!file_exists($this->birthome)) {
            throw new RuntimeException("Undefined or invalid BIRT_HOME: " . $this->birthome);
        }
        $scriptfilename = $this->birthome . '/ReportEngine/genReport.sh';
        if (!file_exists($scriptfilename)) {
            throw new RuntimeException("Script not found: " . $scriptfilename);
        }
        $cmd = $scriptfilename;
        $cmd .= " -p \"StockLocation=Customer\"";
        $cmd .= " -f pdf -o " . $outputfilename;
        $cmd .= " --file " . $report->getFilename();
        
        echo $cmd . "\n";
        putenv('BIRT_HOME=' . $this->birthome);
        exec($cmd);
    }
    
    public function setBirtHome($birthome)
    {
        $this->birthome = $birthome;
    }
}
