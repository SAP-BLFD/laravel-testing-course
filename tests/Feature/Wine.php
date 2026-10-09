+<?php

use App\Services\WineCalculator;

it('calculates the wine price with tax', function () {
    $calculator = new WineCalculator();
    $price = 100;
    $expected = 100 * 1.19;
    expect($calculator->float($price))->toBe($expected);
});

it('result is tobe type float', function() {
    $calculator= new WineCalculator();
    $price=100;
    expect($calculator->float($price))->tobefloat();
});

it ('result is > 100', function() {
    $calculator = new WineCalculator();
    $price=100;
    expect($calculator->float($price))->tobegreaterthan(100);
});

it ('result is between 50 and 150', function() {
    $calculator = new WineCalculator();
    $price=100;
    expect($calculator->float($price))->tobebetween(50,200);
});

it ('result is >=119', function() {
    $calculator = new WineCalculator();
    $price=100;
    expect($calculator->float($price))->tobegreaterthanorequal(119);
});
