<?php

use App\Services\PriceCalculator;



describe('PriceCalculator - Percentage Discount', function () {
    it('applies percentage discount', function () {
        $calc = new PriceCalculator();
        expect($calc->applyPercentageDiscount(100, 20))->toBe(80.0);
    });

    it('round discounted price', function () {
        $calc = new PriceCalculator();
        expect($calc->applyPercentageDiscount(100, 33.333))->toBe(66.67);
    });
});

describe('PriceCalculator - Fixed Discount', function () {
    it('applies fixed discount', function () {
        $calc = new PriceCalculator();
        expect($calc->applyFixedDiscount(100, 20))->toBe(80.0);
    });

    it('never returns a negative price', function () {
        $calc = new PriceCalculator();
        expect($calc->applyFixedDiscount(50, 100))->toBe(0.0);
    });

    it ('throws an exception for negative discount', function () {
        $calc = new PriceCalculator();
        expect(fn() => $calc->applyFixedDiscount(100, -20))->toThrow(Exception::class);
    });

});

describe('Price Calculator - Add Tax & Final Price', function () {
    it ('adds tax to the price', function () {
        $calc = new PriceCalculator();
        expect($calc->addTax(100, 10))->toBe(110.0);
    });

    it ('rounds taxed price', function () {
        $calc = new PriceCalculator();
        expect($calc->addTax(100, 33.333))->toBe(133.33);
    });

    it ('calculates final price including tax and discounts', function () {
        $calc = new PriceCalculator();
        expect($calc->finalPrice(100, 20, 10))->toBe(88.0);
    });
});


