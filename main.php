<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

echo "----------------------------------\n";
echo "        CURRENCY CONVERTER        \n";
echo "----------------------------------\n";

$startAmount = readline('Amount (EUR): ');
$currencyToConvert = strtoupper(readline('Currency to convert (ex.USD): '));

$apiClient = new \App\BankApiClient();
$ecbData = $apiClient->getRate($currencyToConvert);

echo "\n Currency: {$ecbData->getId()}\n";
echo " Rate: {$ecbData->getRate()}\n";
echo " Converted amount: $currencyToConvert " . $ecbData->getConvertedAmount((float)$startAmount) . "\n\n";