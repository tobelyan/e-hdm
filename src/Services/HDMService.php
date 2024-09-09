<?php

namespace Tobelyan\EHDM\Services;

use Tobelyan\EHDM\Contracts\HDMServiceInterface;
use Tobelyan\EHDM\Exceptions\HDMException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HDMService implements HDMServiceInterface
{
    protected string $baseUrl;
    protected Client $client;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => ['Content-Type' => 'application/json']
        ]);
    }

    public function checkServiceStatus(): array
    {
        return $this->sendRequest('GET', 'dummy');
    }

    public function activate(string $crn): array
    {
        return $this->sendRequest('POST', 'activate', ['crn' => $crn]);
    }

    public function configureDepartments(array $data): array
    {
        return $this->sendRequest('POST', 'configureDepartments', $data);
    }

    public function printReceipt(array $data): array
    {
        return $this->sendRequest('POST', 'print', $data);
    }

    public function printReceiptCopy(string $crn, int $seq, int $receiptId): array
    {
        return $this->sendRequest('POST', 'printCopy', [
            'crn' => $crn,
            'seq' => $seq,
            'receiptId' => $receiptId
        ]);
    }

    public function getReturnedReceiptInfo(string $crn, int $receiptId, int $seq): array
    {
        return $this->sendRequest('POST', 'getReturnedReceiptInfo', [
            'crn' => $crn,
            'receiptId' => $receiptId,
            'seq' => $seq
        ]);
    }

    public function printReturnReceipt(array $data): array
    {
        return $this->sendRequest('POST', 'printReturnReceipt', $data);
    }

    protected function sendRequest(string $method, string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->request($method, $endpoint, ['json' => $data]);
            $responseBody = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() !== 200) {
                throw new HDMException(
                    $responseBody['errorMessage'] ?? 'Unknown error', 
                    $responseBody['code'] ?? 500
                );
            }

            return $responseBody;
        } catch (GuzzleException $e) {
            throw new HDMException($e->getMessage(), $e->getCode());
        }
    }
}
