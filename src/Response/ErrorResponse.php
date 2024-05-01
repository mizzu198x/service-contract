<?php

declare(strict_types=1);

namespace Symfony\Sample\Response;

class ErrorResponse
{
    public const DEFAULT_MESSAGE = 'Internal Server Error';

    public const DEFAULT_CODE = 500;

    public string $message = self::DEFAULT_MESSAGE;

    public ?string $exceptionMessage = null;

    public int $code = self::DEFAULT_CODE;

    public array $errorList = [];

    public function toArray(): array
    {
        $errorList = [];
        if (count($this->errorList) > 0) {
            $errorList = ['errors' => $this->errorList];
        }

        return [
            'error' => array_merge([
                'message' => $this->message,
                'exception' => $this->exceptionMessage,
                'code' => $this->code,
            ], $errorList),
        ];
    }
}
