<?php declare(strict_types=1);

namespace VictorPrdh\CsvBundle\Reader;

use Generator;
use VictorPrdh\CsvBundle\Exceptions\CsvFileNotFoundException;

final readonly class CsvReader
{
    /**
     * @throws CsvFileNotFoundException
     */
    public function read(string $filename, string $separator = ";"): Generator
    {
        if (false === $fh = @fopen($filename, "r")) {
            throw new CsvFileNotFoundException($filename);
        }

        while ($row = fgetcsv($fh, separator: $separator)) {
            yield $row;
        }
    }

    /**
     * @throws CsvFileNotFoundException
     */
    public function readAssociative(string $filename, string $separator = ";"): Generator
    {
        $keys = null;

        foreach ($this->read($filename, $separator) as $row) {
            if (null === $keys) {
                $keys = $row;
                continue;
            }

            yield array_combine($keys, $row);
        }
    }
}