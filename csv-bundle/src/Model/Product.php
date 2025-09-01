<?php declare(strict_types=1);

namespace VictorPrdh\CsvBundle\Model;

use DateTimeImmutable;
use Symfony\Component\String\Slugger\AsciiSlugger;

final readonly class Product
{
    public string $slug;

    public function __construct(
        public string $sku,
        public string $title,
        private bool $status,
        private float $price,
        private string $currency,
        public string $description,
        private DateTimeImmutable $createdAt,
    ) {
        $this->slug = (new AsciiSlugger())->slug($this->title)->lower()->toString();
    }

    public function getTextualStatus(): string
    {
        return $this->status ? 'Enabled' : 'Disabled';
    }

    public function getPrice(): string
    {
        $roundedPrice = round($this->price, 1);

        return sprintf('%.2f%s', $roundedPrice, $this->currency);
    }

    public function getHttpDateCreatedAt(): string
    {
        return $this->createdAt->format('l, d-M-Y H:i:s T');
    }

    public function getDescription(): string
    {
        $clean = str_ireplace(["\\r", "<br>", "<br/>", "<br />"], "\n", $this->description);

        return strip_tags($clean);
    }
}