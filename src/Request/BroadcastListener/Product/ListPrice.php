<?php

declare(strict_types=1);

namespace Symfony\Sample\Request\BroadcastListener\Product;

use Symfony\Sample\ContextualInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ListPrice implements ContextualInterface
{
    #[Assert\Type(type: 'float')]
    #[Assert\NotBlank]
    public float $salePrice;

    #[Assert\Type(type: 'float')]
    public ?float $specialPrice;

    #[Assert\Type(type: 'datetime')]
    public ?\DateTime $specialFrom;

    #[Assert\Type(type: 'datetime')]
    public ?\DateTime $specialTo;

    #[Assert\NotBlank]
    #[Assert\Currency]
    public string $currencyCode;

    public function getContext(): array
    {
        return [
            'sale_price' => $this->salePrice,
            'special_price' => $this->specialPrice,
            'special_from' => $this->specialFrom?->format('Y-m-d H:i:s'),
            'special_to' => $this->specialTo?->format('Y-m-d H:i:s'),
            'currency_code' => $this->currencyCode,
        ];
    }
}
