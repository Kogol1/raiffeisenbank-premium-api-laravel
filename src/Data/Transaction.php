<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel\Data;

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
}
