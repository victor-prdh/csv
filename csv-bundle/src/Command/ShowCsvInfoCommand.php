<?php

declare(strict_types=1);

namespace VictorPrdh\CsvBundle;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'csv-bundle:show-info')]
class DisplayCsvInformationsCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->write('OK');
        return Command::SUCCESS;
    }
}
