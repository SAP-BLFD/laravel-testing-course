<?php

namespace App\Services;

class WineCalculator
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function float (float $price): float
    {
        return $price*1.19;
    }
}
