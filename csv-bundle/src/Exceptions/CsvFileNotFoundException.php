<?php declare(strict_types=1);

namespace VictorPrdh\CsvBundle\Exceptions;

use Exception;

class CsvFileNotFoundException extends Exception
{
    public function __construct(string $filename = "")
    {
        parent::__construct("CSV file \"{$filename}\" not found");
    }
}