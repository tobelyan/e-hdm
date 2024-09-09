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
```
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
```