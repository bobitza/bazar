<?php

namespace Cone\Bazar;

use Cone\Bazar\Exceptions\InvalidCurrencyException;
use Illuminate\Support\Facades\Config;

abstract class Bazar
{
    /**
     * The package version.
     *
     * @var string
     */
    public const VERSION = '0.9.1';

    /**
     * The currency in use.
     *
     * @var string|null
     */
    protected static ?string $currency = null;

    /**
     * Get the package version.
     *
     * @return string
     */
    public static function getVersion(): string
    {
        return static::VERSION;
    }

    /**
     * Get all the available currencies.
     *
     * @return array
     */
    public static function getCurrencies(): array
    {
        return array_flip(Config::get('bazar.currencies.available', []));
    }

    /**
     * Get the currency in use.
     *
     * @return string
     */
    public static function getCurrency(): string
    {
        return static::$currency ?: Config::get('bazar.currencies.default', 'usd');
    }

    /**
     * Set the currency in use.
     *
     * @param  string  $currency
     * @return void
     *
     * @throws \Cone\Bazar\Exceptions\InvalidCurrencyException
     */
    public static function setCurrency(string $currency): void
    {
        $currency = strtolower($currency);

        if (array_search($currency, static::getCurrencies()) === false) {
            throw new InvalidCurrencyException("The [{$currency}] currency is not registered.");
        }

        static::$currency = $currency;
    }
}
