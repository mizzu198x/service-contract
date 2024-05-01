<?php

declare(strict_types=1);

namespace Symfony\Sample\Request\BroadcastListener\Product;

use JMS\Serializer\Annotation as JMS;
use Symfony\Sample\ContextualInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ListPrice implements ContextualInterface
{
    #[Assert\Type(type: 'float')]
    #[Assert\NotBlank]
    public float $salePrice;

    #[Assert\Type(type: 'float')]
    public ?float $specialPrice = null;

    #[JMS\Type(name: "DateTime<'Y-m-d H:i:s', null, 'Y-m-d H:i:s'>")]
    #[Assert\Type(type: 'DateTime')]
    public ?\DateTime $specialFrom = null;

    #[JMS\Type(name: "DateTime<'Y-m-d H:i:s', null, 'Y-m-d H:i:s'>")]
    #[Assert\Type(type: 'DateTime')]
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
