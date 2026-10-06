<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class GeoIpService
{
    /**
     * Resolve timezone and location data for a given IP address.
     *
     * @param string|null $ip
     * @return array
     */
    public static function resolveLocation($ip = null)
    {
        $ip = trim((string) $ip);

        // Check for local or private addresses
        if (empty($ip) || in_array($ip, ['127.0.0.1', '::1']) || static::isPrivateIp($ip)) {
            return [
                'ip' => $ip ?: '127.0.0.1',
                'country' => 'United States',
                'region' => 'California',
                'city' => 'Los Angeles',
                'timezone' => 'America/Los_Angeles',
            ];
        }

        return Cache::remember("geoip_lookup_{$ip}", 86400, function () use ($ip) {
            try {
                $response = Http::timeout(2)->get("http://ip-api.com/json/{$ip}?fields=status,country,regionName,city,timezone");
                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['status']) && $data['status'] === 'success') {
                        return [
                            'ip' => $ip,
                            'country' => $data['country'] ?? 'Unknown',
                            'region' => $data['regionName'] ?? '',
                            'city' => $data['city'] ?? '',
                            'timezone' => $data['timezone'] ?? 'UTC',
                        ];
                    }
                }
            } catch (\Throwable $e) {
                // Ignore network timeouts or external lookup issues
            }

            return [
                'ip' => $ip,
                'country' => 'Unknown',
                'region' => '',
                'city' => '',
                'timezone' => 'UTC',
            ];
        });
    }

    /**
     * Resolve just the timezone identifier for an IP address.
     *
     * @param string|null $ip
     * @return string
     */
    public static function resolveTimezone($ip = null)
    {
        $info = static::resolveLocation($ip);
        return $info['timezone'] ?? 'America/Los_Angeles';
    }

    /**
     * Check if an IP address is in a private network range.
     *
     * @param string $ip
     * @return bool
     */
    protected static function isPrivateIp($ip)
    {
        return !filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );
    }
}
