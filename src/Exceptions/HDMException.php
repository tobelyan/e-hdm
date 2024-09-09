<?php

namespace Tobelyan\EHDM\Exceptions;

use Exception;

class HDMException extends Exception
{
    protected int $errorCode;
    protected ?string $errorMessage;

    /**
     * Construct a new HDMException.
     *
     * @param string|null $errorMessage
     * @param int $errorCode
     * @param Exception|null $previous
     */
    public function __construct(?string $errorMessage = 'Unknown error', int $errorCode = 0, Exception $previous = null)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        parent::__construct($this->formatMessage(), $errorCode, $previous);
    }

    /**
     * Format the exception message.
     *
     * @return string
     */
    protected function formatMessage(): string
    {
        return "[HDM Error Code: {$this->errorCode}] {$this->errorMessage}";
    }

    /**
     * Get the error code.
     *
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * Get the error message.
     *
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}
