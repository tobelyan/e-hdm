# e-hdm

A PHP package for integrating with the Armenian electronic cash register (HDM) API. This package provides a set of tools to interact with the electronic cash register system, making it easier to manage receipts, activate devices, configure departments, and more.

**Sponsored by** [Turn.am](https://turn.am)

## Installation

You can install the package via Composer:

```bash
composer require tobelyan/e-hdm

EHDM_API_BASE_URL=http://example.com/api/v1.0

## Use the Service in Laravel

```
namespace App\Http\Controllers;

use Tobelyan\EHDM\Services\HDMService;

class ExampleController extends Controller
{
    public function index()
    {
        $baseUrl = config('ehdm.api_base_url');
        $hdmService = new HDMService($baseUrl);

        try {
            $status = $hdmService->checkServiceStatus();
            return response()->json($status);
        } catch (HDMException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

## Exception Handling
```
use Tobelyan\EHDM\Services\HDMService;
use Tobelyan\EHDM\Exceptions\HDMException;

$baseUrl = 'http://example.com/api/v1.0';
$hdmService = new HDMService($baseUrl);

try {
    $response = $hdmService->activate('31801118');
    echo 'Service activated: ' . json_encode($response);
} catch (HDMException $e) {
    echo 'Failed to activate service: ' . $e->getErrorMessage();
    echo 'Error Code: ' . $e->getErrorCode();
}

## Available Methods

1. checkServiceStatus()

    Description: Checks the availability of the HDM API service.
    Request Method: GET
    Returns: An array containing the service status details.

2. activate(string $crn)

    Description: Activates the electronic cash register (ՀԴՄ).
    Request Method: POST
    Parameters:
        crn (string): The registration number of the cash register.
    Returns: An array with the result of the activation request.

3. configureDepartments(array $data)

    Description: Configures the departments and their tax regimes for the electronic cash register.
    Request Method: POST
    Parameters:
        data (array): An associative array containing department configurations:
            crn (string): Registration number of the cash register.
            seq (int): The sequence number of the request.
            departments (array): List of department configurations, where each entry includes:
                departmentId (int): Department ID.
                taxRegime (int): Tax regime (1 - VAT, 2 - non-VAT, etc.).
    Returns: An array with the configuration status.

4. printReceipt(array $data)

    Description: Prints a receipt via the electronic cash register.
    Request Method: POST
    Parameters:
        data (array): An associative array containing receipt details, such as:
            crn (string): Registration number of the cash register.
            seq (int): The sequence number of the request.
            cashierId (int): ID of the cashier.
            items (array): List of items in the receipt.
    Returns: An array with the receipt print status.

5. printReceiptCopy(string $crn, int $seq, int $receiptId)

    Description: Prints a copy of an existing receipt.
    Request Method: POST
    Parameters:
        crn (string): Registration number of the cash register.
        seq (int): The sequence number of the request.
        receiptId (int): ID of the receipt to print a copy of.
    Returns: An array with the receipt copy print status.

6. getReturnedReceiptInfo(string $crn, int $receiptId, int $seq)

    Description: Retrieves information about a returned receipt.
    Request Method: POST
    Parameters:
        crn (string): Registration number of the cash register.
        receiptId (int): ID of the returned receipt.
        seq (int): The sequence number of the request.
    Returns: An array with the returned receipt details.

7. printReturnReceipt(array $data)

    Description: Prints a return receipt for a transaction.
    Request Method: POST
    Parameters:
        data (array): An associative array containing return receipt details, such as:
            crn (string): Registration number of the cash register.
            seq (int): The sequence number of the request.
            returnItemList (array): List of items to return.
    Returns: An array with the return receipt print status.