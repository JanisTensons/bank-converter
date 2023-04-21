<?php declare(strict_types=1);

namespace App\Models;

class CurrencyToConvert
{
    private string $id;
    private float $rate;
    public function __construct(string $id, float $rate)
    {
        $this->id = $id;
        $this->rate = $rate;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getConvertedAmount(float $amount): float
    {
        return $this->rate * $amount;
    }
}
