<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel;

use Illuminate\Support\Collection;
use Kogol1\RaiffeisenbankPremiumApiLaravel\Api\Transaction;

class BankAccount
{
    /** @var Collection<Transaction> */
    public Collection $transactions;

    public float $balance;

    public function __construct(
        public string $accountNumber,
        public string $bankCode,
        public string $iban,
    ) {}

    /** TODO: Implement balance api call */
    public function getBalance(): self
    {
        $this->balance = 1000.00;

        return $this;
    }

    public function getTransactions(?ApiClient $apiClient = null): self
    {
        if ($apiClient === null) {
            $apiClient = new ApiClient;
        }

        $this->transactions = $apiClient->getTransactions($this->accountNumber, 'CZK');

        return $this;
    }
}
