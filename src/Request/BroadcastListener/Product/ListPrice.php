<?php

declare(strict_types=1);

namespace Symfony\Sample\Request\BroadcastListener\Product;

use Symfony\Sample\ContextualInterface;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

class ListPrice implements ContextualInterface
{
    #[JMS\Type(name: 'float')]
    #[Assert\Type(type: 'float')]
    #[Assert\NotBlank]
    public float $salePrice;

    #[JMS\Type(name: 'float')]
    #[Assert\Type(type: 'float')]
    public ?float $specialPrice;

    #[JMS\Type(name: 'datetime')]
    #[Assert\Type(type: 'datetime')]
    public ?\DateTime $specialFrom;

    #[JMS\Type(name: 'datetime')]
    #[Assert\Type(type: 'datetime')]
    public ?\DateTime $specialTo;

    #[JMS\Type(name: 'string')]
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
