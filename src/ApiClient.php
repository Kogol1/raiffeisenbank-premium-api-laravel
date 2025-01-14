<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Kogol1\RaiffeisenbankPremiumApiLaravel\Api\Transaction;

class ApiClient
{
    public string $baseUrl;

    public bool $sandbox;

    public function __construct()
    {
        $this->baseUrl = config('raiffeisenbank-premium-api-laravel.base_uri');
        $this->sandbox = config('raiffeisenbank-premium-api-laravel.use_sandbox');
    }

    public function getAccounts(): Collection
    {
        $url = 'rbcz/premium/%environment%/accounts';

        $response = collect($this->get($url)['accounts']);

        $accounts = collect();

        foreach ($response as $account) {
            $accounts->push(new BankAccount(accountNumber: $account['accountNumber'], bankCode: $account['bankCode'], iban: $account['iban']));
        }

        return $accounts;
    }

    public function getTransactions(string $accountNumber, string $currencyCode, ?string $from = null, ?string $to = null, ?int $page = null): Collection
    {
        if (empty($from)) {
            $from = now()->subMonth()->format('Y-m-d');
        }
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

    private function get($url): array
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

        // TODO: Handle Rate limiting

        if ($response->failed()) {
            throw new \Exception('RB request failed');
        }

        return $response->json();
    }
}
