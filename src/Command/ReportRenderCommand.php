<?php

namespace BirtRenderer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use BirtRenderer\Renderer;
use BirtRenderer\Report;
use BirtRenderer\Parameter;

class ReportRenderCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('report:render')
            ->setDescription('Render a BIRT report')
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                '.rptdesign filename'
            )
            ->addArgument(
                'output',
                InputArgument::REQUIRED,
                'output filename'
            )
            ->addOption(
                'parameter',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Parameter(s) to pass to the report'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('filename');
        $outputfilename = $input->getArgument('output');
        $output->writeln('<info>Rendering</info> .rptdesign filename: <fg=cyan>'.$filename.'</fg=cyan>');
        
        $report = new Report();
        $report->loadFilename($filename);
        
        $renderer = new Renderer();
        $birthome = getenv('BIRT_HOME');
        $output->writeln('<info>BIRT_HOME</info>  <fg=cyan>' . $birthome . '</fg=cyan>');
        $renderer->setBirtHome($birthome);
        
        $parameters = array();
        $options = $input->getOption('parameter');
        foreach ($options as $option) {
            $part = explode("=", $option);
            $parameters[] = new Parameter($part[0], $part[1]);
        }
        $renderer->render($report, $parameters, $outputfilename);
    }
}
