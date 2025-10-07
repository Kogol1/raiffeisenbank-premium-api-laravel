<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel\Data;

class Transaction
{
    public function __construct(
        public string $reference,
        public string $bankTransactionCode,
        public string $counterPartyAccount = '',
        public string $counterPartyBankCode = '',
        public string $counterPartyName,
        public string $date,
        public string $amount,
        public string $variableSymbol = '',
        public string $constantSymbol = '',
        public string $specificSymbol = '',
        public string $currency = 'CZK',
        public string $type = '',
        public string $message = '',
    ) {
    }

    public static function fromArray(array $transaction): self
    {
        return new self(
            reference: $transaction['entryReference'],
            bankTransactionCode: $transaction['bankTransactionCode']['code'],
            counterPartyAccount: isset($transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty']) ? $transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty']['account']['accountNumber'] : '',
            counterPartyBankCode: isset($transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty']) ? $transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty']['organisationIdentification']['bankCode'] : '',
            counterPartyName: isset($transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty'])
                ? $transaction['entryDetails']['transactionDetails']['relatedParties']['counterParty']['name']
                : $transaction['entryDetails']['transactionDetails']['remittanceInformation']['unstructured'] ?? '',
            date: $transaction['valueDate'],
            amount: $transaction['amount']['value'],
            variableSymbol: $transaction['entryDetails']['transactionDetails']['remittanceInformation']['creditorReferenceInformation']['variable'] ?? '',
            constantSymbol: $transaction['entryDetails']['transactionDetails']['remittanceInformation']['creditorReferenceInformation']['constant'] ?? '',
            specificSymbol: $transaction['entryDetails']['transactionDetails']['remittanceInformation']['creditorReferenceInformation']['specific'] ?? '',
            currency: $transaction['amount']['currency'],
            type: $transaction['creditDebitIndication'],
            message: $transaction['entryDetails']['transactionDetails']['remittanceInformation']['originatorMessage'] ?? '',
        );
    }
}
