<?php

namespace Tobelyan\EHDM\Contracts;

interface HDMServiceInterface
{
    public function checkServiceStatus(): array;

    public function activate(string $crn): array;

    public function configureDepartments(array $data): array;

    public function printReceipt(array $data): array;

    public function printReceiptCopy(string $crn, int $seq, int $receiptId): array;

    public function getReturnedReceiptInfo(string $crn, int $receiptId, int $seq): array;

    public function printReturnReceipt(array $data): array;
}
