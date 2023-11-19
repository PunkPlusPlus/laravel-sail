<?php

use App\Models\Cource;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;
use YooKassa\Model\Payment\ConfirmationType;
use YooKassa\Request\Payments\CreatePaymentRequest;
use Ramsey\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('payment', function () {
    $client = new Client();
    
    $client->setAuth('store_id', 'api_key');

    $builder = CreatePaymentRequest::builder();
    $builder
        ->setAmount(1)
        ->setCurrency(CurrencyCode::RUB)
        ->setOptions([
            'cms_name'       => 'yoo_api_test',
            'order_id'       => '112233',
            'language'       => 'ru',
            'transaction_id' => '123-456-789',
        ]);
        $builder->setConfirmation([
            'type' => ConfirmationType::REDIRECT,
            'returnUrl' => 'http://localhost/backUrl'
        ]);
        $request = $builder->build();
        $uuid = Uuid::uuid4()->toString();
        $response = $client->createPayment($request, $uuid);
        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
        print($confirmationUrl);
        echo "\n";
        var_dump($response->getId());

    
});

Artisan::command('check', function () {
    $client = new Client();
    
    $client->setAuth('store_id', 'api_key');
    $paymentId = '2cebb2b3-000f-5000-a000-13d7dd4b2d92';
    $response = $client->getPaymentInfo($paymentId);
    var_dump($response->getStatus());
});

Artisan::command('cource', function () {
    $model = Cource::factory()->create();
    var_dump($model);
});
