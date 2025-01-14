<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel\Api;

class Transaction
{
    public function __construct(
        public string $reference,
        public string $bankTransactionCode,
        public string $originAccount,
        public string $originBankCode,
        public string $originAccountHolderName,
        public string $date,
        public string $amount,
        public string $variableSymbol = '',
        public string $constantSymbol = '',
        public string $specificSymbol = '',
        public string $currency = 'CZK',
        public string $type = '',
        public string $message = '',
    ) {}

    public static function fromArray(array $transaction): self
    {
        return new self(
            reference: $transaction['entryReference'],
            bankTransactionCode: $transaction['bankTransactionCode']['code'],
            originAccount: $transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty']['account']['accountNumber'],
            originBankCode: $transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty']['organisationIdentification']['bankCode'],
            originAccountHolderName: $transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty']['name'] ?? '',
            date: $transaction['valueDate'],
            amount: $transaction['amount']['value'],
            variableSymbol: $transaction['entryDetails']['transactionDetails']['remittanceInformation']['creditorReferenceInformation']['variable'] ?? '',
            constantSymbol: $transaction['entryDetails']['transactionDetails']['remittanceInformation']['creditorReferenceInformation']['constant'] ?? '',
            specificSymbol: $transaction['entryDetails']['transactionDetails']['remittanceInformation']['creditorReferenceInformation']['specific'] ?? '',
            currency: $transaction['amount']['currency'],
            type: $transaction['creditDebitIndication'],
            message: $transaction['entryDetails']['transactionDetails']['remittanceInformation']['originatorMessage'],
        );
    }

    public function storeTransaction(bool $notify = true): ?\App\Models\Transaction
    {
        if (\Kogol1\RaiffeisenbankPremiumApiLaravel\Models\Transaction::query()
            ->where('reference', $this->reference)
            ->exists()) {
            return null;
        }

        $transaction = \Kogol1\RaiffeisenbankPremiumApiLaravel\Models\Transaction::create([
            'reference' => $this->reference,
            'bank_transaction_code' => $this->bankTransactionCode,

            'amount' => $this->amount,
            'currency' => $this->currency,
            'payment_date' => $this->date,
            'origin_account_holder_name' => $this->originAccountHolderName,
            'origin_account_number' => $this->originAccount,
            'destination_account_number' => '',
            'message' => $this->message,
            'variable_symbol' => $this->variableSymbol,
            'constant_symbol' => $this->constantSymbol,
            'specific_symbol' => $this->specificSymbol,
            'origin_bank_code' => $this->originBankCode,
            'destination_bank_code' => '',
        ]);

        $this->afterStore();

        return $transaction;
    }

    public function afterStore(): void
    {
        // Override this method in your application, you can use it to send notifications or do other actions after the transaction is stored.
    }
}
