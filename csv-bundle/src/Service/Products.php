<?php declare(strict_types=1);

namespace VictorPrdh\CsvBundle\Service;

use DateTimeImmutable;
use DateTimeZone;
use Generator;
use VictorPrdh\CsvBundle\Model\Product;
use VictorPrdh\CsvBundle\Reader\CsvReader;

final readonly class Products
{
    public function __construct(
        private CsvReader $csvReader,
    ) {
    }

    public function getProductsFromCsvFile(string $filename): Generator
    {
        foreach ($this->csvReader->readAssociative($filename) as $row) {
            $product = new Product(
                sku: $row['sku'],
                title: $row['title'],
                status: (bool)$row['is_enabled'],
                price: (float)$row['price'],
                currency: $row['currency'],
                description: $row['description'],
                createdAt: new DateTimeImmutable($row['created_at'], new DateTimeZone('CET')),
            );

            yield $product;
        }
    }
}