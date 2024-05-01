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
    public ?float $specialPrice = null;

    #[Assert\DateTime(format: \DateTimeInterface::ATOM)]
    public ?\DateTime $specialFrom = null;

    #[Assert\DateTime(format: \DateTimeInterface::ATOM)]
    public ?\DateTime $specialTo = null;

    public function getContext(): array
    {
        return [
            'sale_price' => $this->salePrice,
            'special_price' => $this->specialPrice,
            'special_from' => $this->specialFrom?->format('Y-m-d H:i:s'),
            'special_to' => $this->specialTo?->format('Y-m-d H:i:s'),
        ];
    }
}
