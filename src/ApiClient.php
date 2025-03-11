<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Kogol1\RaiffeisenbankPremiumApiLaravel\Data\BankAccount;
use Kogol1\RaiffeisenbankPremiumApiLaravel\Data\Transaction;
use Kogol1\RaiffeisenbankPremiumApiLaravel\Exceptions\CertificateIsInvalidException;
use Kogol1\RaiffeisenbankPremiumApiLaravel\Exceptions\RateLimitExceededException;

class ApiClient
{
    public string $baseUrl;

    public bool $sandbox;

    public function __construct()
    {
        $this->baseUrl = config('raiffeisenbank-premium-api-laravel.base_uri');
        $this->sandbox = config('raiffeisenbank-premium-api-laravel.use_sandbox');
    }

    public function getTransactions(string $accountNumber, string $currencyCode, ?string $from = null, ?string $to = null, ?int $page = null): Collection
    {
        /** $from is required parameter, you can see only transaction which are not older than 90 days */
        if (empty($from)) {
            $from = now()->subMonth()->format('Y-m-d');
        } elseif (now()->diffInDays($from) > 90) {
            throw new \Exception('You can see only transaction which are not older than 90 days');
        }

        /** $to is required parameter */
        if (empty($to)) {
            $to = now()->format('Y-m-d');
        }

        $url = "rbcz/premium/%environment%/accounts/{$accountNumber}/{$currencyCode}/transactions?from={$from}&to={$to}".(empty($page) ? '' : "&page={$page}");

        $response = $this->get($url);

        $transactions = collect();

        if (filled($response)) {
            $data = $response['transactions'];

            foreach ($data as $transaction) {
                $transactions->push(Transaction::fromArray($transaction));
            }
        }

        return $transactions;
    }

    private function get($url)
    {
        $url = str_replace('%environment%', $this->sandbox ? 'mock' : 'api', $url);

        $response = Http::acceptJson()
            ->contentType('application/json')
            ->withOptions([
                'base_uri' => $this->baseUrl,
                'cert' => [config('raiffeisenbank-premium-api-laravel.cert_file_path'), config('raiffeisenbank-premium-api-laravel.cert_password')],
                'ssl_key' => config('raiffeisenbank-premium-api-laravel.ssl_key_file_path'),
            ])
            ->withHeaders([
                'X-IBM-Client-Id' => config('raiffeisenbank-premium-api-laravel.client_id'),
                'PSU-IP-Address' => request()->ip(),
                'X-Request-Id' => Str::random(32),
            ])
            ->get($url);

        if ($response->failed()) {
            match ($response->status()) {
                401 => throw new CertificateIsInvalidException,
                403 => throw new \Exception('No access rights to perform the operation.'),
                429 => throw new RateLimitExceededException,
                default => throw new \Exception('RB request failed: '.$response->json('error')),
            };
        }

        return $response->json();
    }
}
