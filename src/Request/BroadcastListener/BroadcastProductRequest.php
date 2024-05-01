<?php

declare(strict_types=1);

namespace Symfony\Sample\Request\BroadcastListener;

use JMS\Serializer\Annotation as JMS;
use Symfony\Sample\Request\BroadcastListener\Product\ListPrice;
use Symfony\Sample\ContextualInterface;
use Symfony\Sample\RequestBodyInterface;
use Symfony\Sample\ValidatableRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class BroadcastProductRequest implements
    RequestBodyInterface,
    ValidatableRequestInterface,
    ContextualInterface
{
    #[Assert\Type(type: 'string')]
    #[Assert\Length(min: 1, max: 30)]
    #[Assert\NotBlank]
    public string $sku;

    #[Assert\Type(type: 'string')]
    #[Assert\Length(max: 255)]
    #[Assert\NotNull]
    public string $name;

    #[Assert\Type(type: 'string')]
    public ?string $description = null;

    #[Assert\Type(type: 'boolean')]
    #[Assert\NotNull]
    public bool $isSellable = false;

    #[Assert\Type(type: 'integer')]
    #[Assert\NotNull]
    public int $stock;

    #[Assert\Type(type: 'Symfony\Sample\Request\BroadcastListener\Product\ListPrice')]
    #[Assert\NotNull]
    #[Assert\Valid]
    public ListPrice $listPrice;

    #[JMS\Type(name: "DateTime<'Y-m-d H:i:s', null, 'Y-m-d H:i:s'>")]
    #[Assert\Type(type: 'DateTime')]
    #[Assert\NotNull]
    public \DateTime $updatedAt;

    public function getContext(): array
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'is_sellable' => $this->isSellable,
            'stock' => $this->stock,
            'list_price' => $this->listPrice->getContext(),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }
}
