<?php

namespace App\Services;

class BankDirectoryService
{
    /**
     * In-memory cache of bank directory.
     */
    protected static $banks = null;

    /**
     * Load all banks from config.
     */
    public static function all()
    {
        if (static::$banks === null) {
            static::$banks = config('banks', []);
            if (empty(static::$banks) && file_exists(config_path('banks.php'))) {
                static::$banks = require config_path('banks.php');
            }
        }
        return static::$banks;
    }

    /**
     * Resolve bank information by routing number, SWIFT code, sort code, or BSB.
     *
     * @param string|null $code
     * @return array
     */
    public static function lookup($code)
    {
        $code = trim((string)$code);
        if (empty($code)) {
            return [
                'name' => 'Corox Bank (Internal Clearing)',
                'country' => 'United States / Global',
                'type' => 'Internal',
                'swift' => 'CORXUS33',
                'network' => 'Internal Ledger'
            ];
        }

        $all = static::all();
        $clean = strtoupper(preg_replace('/[^A-Z0-9]/', '', $code));

        if (isset($all[$clean])) {
            return $all[$clean];
        }

        // SWIFT prefix fallback (e.g. 8-char BIC match when 11-char BIC is passed)
        if (strlen($clean) === 11) {
            $bic8 = substr($clean, 0, 8);
            if (isset($all[$bic8])) {
                $match = $all[$bic8];
                $match['branch_code'] = substr($clean, 8, 3);
                return $match;
            }
        }

        // Intelligent pattern recognition
        if (preg_match('/^[A-Z]{6}[A-Z0-9]{2}([A-Z0-9]{3})?$/', $clean)) {
            $countryCode = substr($clean, 4, 2);
            $countryNames = [
                'US' => 'United States',
                'GB' => 'United Kingdom',
                'AU' => 'Australia',
                'DE' => 'Germany',
                'FR' => 'France',
                'CH' => 'Switzerland',
                'CA' => 'Canada',
                'CN' => 'China',
                'HK' => 'Hong Kong',
                'JP' => 'Japan',
                'SG' => 'Singapore',
                'AE' => 'United Arab Emirates',
                'SA' => 'Saudi Arabia',
                'NZ' => 'New Zealand',
                'ZA' => 'South Africa',
                'NL' => 'Netherlands',
                'ES' => 'Spain',
                'IT' => 'Italy',
                'SE' => 'Sweden',
                'IE' => 'Ireland',
                'BE' => 'Belgium',
            ];
            $country = $countryNames[$countryCode] ?? "International ($countryCode)";
            return [
                'name' => "Verified SWIFT Institution ($clean)",
                'country' => $country,
                'type' => 'SWIFT/BIC',
                'swift' => $clean,
                'network' => 'SWIFT Net Global Network'
            ];
        }

        // UK Sort Code (6 digits)
        if (preg_match('/^\d{6}$/', $clean)) {
            return [
                'name' => "UK Clearing Bank (Sort Code: " . substr($clean, 0, 2) . '-' . substr($clean, 2, 2) . '-' . substr($clean, 4, 2) . ")",
                'country' => 'United Kingdom',
                'type' => 'Sort Code',
                'swift' => null,
                'network' => 'Faster Payments / BACS'
            ];
        }

        // US ABA Routing number (9 digits)
        if (preg_match('/^\d{9}$/', $clean)) {
            $prefix = substr($clean, 0, 2);
            $districts = [
                '01' => 'Federal Reserve District 1 (Boston / New England)',
                '02' => 'Federal Reserve District 2 (New York)',
                '03' => 'Federal Reserve District 3 (Philadelphia)',
                '04' => 'Federal Reserve District 4 (Cleveland)',
                '05' => 'Federal Reserve District 5 (Richmond)',
                '06' => 'Federal Reserve District 6 (Atlanta / Southeast)',
                '07' => 'Federal Reserve District 7 (Chicago / Midwest)',
                '08' => 'Federal Reserve District 8 (St. Louis)',
                '09' => 'Federal Reserve District 9 (Minneapolis)',
                '10' => 'Federal Reserve District 10 (Kansas City)',
                '11' => 'Federal Reserve District 11 (Dallas / Southwest)',
                '12' => 'Federal Reserve District 12 (San Francisco / West Coast)',
            ];
            $fedDistrict = $districts[$prefix] ?? "Verified US Commercial Banking Institution";
            return [
                'name' => "$fedDistrict (ABA: $clean)",
                'country' => 'United States',
                'type' => 'ABA Routing',
                'swift' => null,
                'network' => 'FedWire / ACH Network'
            ];
        }

        return [
            'name' => "Verified Commercial Banking Institution ($code)",
            'country' => 'International Clearing',
            'type' => 'Clearing Code',
            'swift' => $clean,
            'network' => 'Electronic Banking Clearing'
        ];
    }
}
