<?php

declare(strict_types=1);

namespace Symfony\Sample\Request\BroadcastListener;

use Symfony\Sample\Request\BroadcastListener\Product\ListPrice;
use Symfony\Sample\ContextualInterface;
use Symfony\Sample\RequestBodyInterface;
use Symfony\Sample\ValidatableRequestInterface;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

class BroadcastProductRequest implements
    RequestBodyInterface,
    ValidatableRequestInterface,
    ContextualInterface
{
    #[JMS\Type(name: 'string')]
    #[Assert\Type(type: 'string')]
    #[Assert\Length(min: 1, max: 30)]
    #[Assert\NotBlank]
    public string $sku;

    #[JMS\Type(name: 'string')]
    #[Assert\NotNull]
    #[Assert\Type(type: 'string')]
    #[Assert\Length(max: 255)]
    public string $name;

    #[JMS\Type(name: 'string')]
    #[Assert\Type(type: 'string')]
    public ?string $description = null;

    #[JMS\Type(name: 'strict_boolean')]
    #[Assert\NotNull]
    #[Assert\Type(type: 'boolean')]
    public bool $isSellable = false;

    #[JMS\Type(name: 'integer')]
    #[Assert\NotNull]
    #[Assert\Type(type: 'integer')]
    public int $stock;

    #[JMS\Type(name: 'App\Contract\Request\BroadcastListener\Common\Price')]
    #[Assert\Type(type: 'App\Contract\Request\BroadcastListener\Common\Price')]
    #[Assert\NotNull]
    #[Assert\Valid]
    public ListPrice $listPrice;

    #[JMS\Type(name: 'datetime')]
    #[Assert\Type(type: 'datetime')]
    public ?\DateTime $updatedAt = null;

    /**
     * @codeCoverageIgnore
     */
    public function getContext(): array
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'is_sellable' => $this->isSellable,
            'stock' => $this->stock,
            'list_price' => $this->listPrice->getContext(),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }
}
