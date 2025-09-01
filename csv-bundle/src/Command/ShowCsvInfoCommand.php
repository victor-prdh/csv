<?php

declare(strict_types=1);

namespace VictorPrdh\CsvBundle\Command;

use Generator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Scheduler\Attribute\AsCronTask;
use VictorPrdh\CsvBundle\Model\Product;
use VictorPrdh\CsvBundle\Service\Products;

#[AsCommand(name: 'csv-bundle:show-info', description: 'Shows the csv information')]
#[AsCronTask('0 7-19 * * *', arguments: ['path' => '/var/www/data/product.csv'])]
class ShowCsvInfoCommand extends Command
{
    public function __construct(
        private readonly Products $products,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('path', InputArgument::REQUIRED, 'path to csv file')
            ->addOption('json', null, InputOption::VALUE_NONE, 'Change table format to json format');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $products = $this->products->getProductsFromCsvFile($input->getArgument('path'));

        if ($input->getOption('json')) {
            $this->renderJson($products, $output);
        } else {
            $this->renderTable($products, $output);
        }

        return self::SUCCESS;
    }

    private function renderTable(Generator $products, OutputInterface $output): void
    {
        $table = new Table($output);
        $table->setHeaders(['Sku', 'Status', 'Price', 'Description', 'Created At', 'Slug']);

        foreach ($products as $product) {
            $table->addRow($this->formatProduct($product));
        }

        $table->render();
    }

    private function renderJson(Generator $products, OutputInterface $output): void
    {
        $arrayProducts = array_map(
            $this->formatProduct(...),
            iterator_to_array($products, false)
        );

        $output->writeln(json_encode($arrayProducts, JSON_PRETTY_PRINT));
    }

    private function formatProduct(Product $product): array
    {
        return [
            'Sku' => $product->sku,
            'Status' => $product->getTextualStatus(),
            'Price' => $product->getPrice(),
            'Description' => $product->getDescription(),
            'Created At' => $product->getHttpDateCreatedAt(),
            'Slug' => $product->slug,
        ];
    }
}
