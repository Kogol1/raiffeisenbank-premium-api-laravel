<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel\Data;

use Illuminate\Support\Collection;
use Kogol1\RaiffeisenbankPremiumApiLaravel\ApiClient;

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

    public function getTransactions(?string $from = null, ?string $to = null, ?int $page = null): self
    {

        $this->transactions = (new ApiClient)->getTransactions($this->accountNumber, 'CZK',$from, $to, $page);

        return $this;
    }
}
