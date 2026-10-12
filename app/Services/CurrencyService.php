<?php

namespace App\Services;

class CurrencyService
{
    /**
     * Map of supported currencies and their metadata.
     */
    protected static $currencies = [
        'USD' => [
            'code' => 'USD',
            'symbol' => '$',
            'name' => 'US Dollar',
            'country' => 'United States',
            'routing_label' => 'ABA Routing Number',
            'default_routing' => '071923456',
            'format' => '$%s',
        ],
        'AUD' => [
            'code' => 'AUD',
            'symbol' => 'A$',
            'name' => 'Australian Dollar',
            'country' => 'Australia',
            'routing_label' => 'BSB / SWIFT Code',
            'default_routing' => '082001',
            'format' => 'A$%s',
        ],
        'EUR' => [
            'code' => 'EUR',
            'symbol' => '€',
            'name' => 'Euro',
            'country' => 'European Union',
            'routing_label' => 'BIC / SWIFT / IBAN',
            'default_routing' => 'CORXEU2L',
            'format' => '€%s',
        ],
        'GBP' => [
            'code' => 'GBP',
            'symbol' => '£',
            'name' => 'British Pound Sterling',
            'country' => 'United Kingdom',
            'routing_label' => 'Sort Code / SWIFT',
            'default_routing' => '40-02-00',
            'format' => '£%s',
        ],
        'CNY' => [
            'code' => 'CNY',
            'symbol' => '¥',
            'name' => 'Chinese Yuan Renminbi',
            'country' => 'China',
            'routing_label' => 'CNAPS / SWIFT Code',
            'default_routing' => 'BKCHCNBJ',
            'format' => '¥%s',
        ],
        'CAD' => [
            'code' => 'CAD',
            'symbol' => 'C$',
            'name' => 'Canadian Dollar',
            'country' => 'Canada',
            'routing_label' => 'Transit Number / SWIFT',
            'default_routing' => '00001-001',
            'format' => 'C$%s',
        ],
        'JPY' => [
            'code' => 'JPY',
            'symbol' => '¥',
            'name' => 'Japanese Yen',
            'country' => 'Japan',
            'routing_label' => 'Zengin Code / SWIFT',
            'default_routing' => 'BOTKJPJT',
            'format' => '¥%s',
        ],
        'CHF' => [
            'code' => 'CHF',
            'symbol' => 'CHF ',
            'name' => 'Swiss Franc',
            'country' => 'Switzerland',
            'routing_label' => 'BC Number / SWIFT',
            'default_routing' => 'UBSWCHZH',
            'format' => 'CHF %s',
        ],
        'NZD' => [
            'code' => 'NZD',
            'symbol' => 'NZ$',
            'name' => 'New Zealand Dollar',
            'country' => 'New Zealand',
            'routing_label' => 'Bank/Branch / SWIFT',
            'default_routing' => 'ANZBNZ22',
            'format' => 'NZ$%s',
        ],
        'SGD' => [
            'code' => 'SGD',
            'symbol' => 'S$',
            'name' => 'Singapore Dollar',
            'country' => 'Singapore',
            'routing_label' => 'Bank Code / SWIFT',
            'default_routing' => 'DBSSSGSG',
            'format' => 'S$%s',
        ],
        'AED' => [
            'code' => 'AED',
            'symbol' => 'AED ',
            'name' => 'UAE Dirham',
            'country' => 'United Arab Emirates',
            'routing_label' => 'Routing / SWIFT Code',
            'default_routing' => 'EBILAEAD',
            'format' => 'AED %s',
        ],
        'HKD' => [
            'code' => 'HKD',
            'symbol' => 'HK$',
            'name' => 'Hong Kong Dollar',
            'country' => 'Hong Kong',
            'routing_label' => 'Clearing Code / SWIFT',
            'default_routing' => 'HSBCHKHH',
            'format' => 'HK$%s',
        ],
    ];

    /**
     * Get all supported currencies.
     */
    public static function all()
    {
        return static::$currencies;
    }

    /**
     * Get list of currency codes.
     */
    public static function codes()
    {
        return array_keys(static::$currencies);
    }

    /**
     * Get symbol for a given currency code.
     */
    public static function symbol($currency = 'USD')
    {
        $code = strtoupper(trim((string)$currency));
        return static::$currencies[$code]['symbol'] ?? '$';
    }

    /**
     * Get display name for a currency.
     */
    public static function name($currency = 'USD')
    {
        $code = strtoupper(trim((string)$currency));
        return static::$currencies[$code]['name'] ?? $code;
    }

    /**
     * Format an amount with its currency symbol.
     */
    public static function format($amount, $currency = 'USD')
    {
        $code = strtoupper(trim((string)$currency));
        $symbol = static::symbol($code);
        $formattedNum = number_format((float)$amount, 2);
        return $symbol . $formattedNum;
    }

    /**
     * Get default routing / clearing identifier for currency.
     */
    public static function defaultRouting($currency = 'USD')
    {
        $code = strtoupper(trim((string)$currency));
        return static::$currencies[$code]['default_routing'] ?? '071923456';
    }

    /**
     * Validate if a currency code is supported.
     */
    public static function isValid($currency)
    {
        return isset(static::$currencies[strtoupper(trim((string)$currency))]);
    }
}
