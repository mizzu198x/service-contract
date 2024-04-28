<?php

declare(strict_types=1);

namespace Symfony\Sample;

interface ContextualInterface
{
    public function getContext(): array;
}
