<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel\Commands;

use Illuminate\Console\Command;

class RaiffeisenbankPremiumApiLaravelCommand extends Command
{
    public $signature = 'rb-api:test-connection';

    public $description = 'Performs a test connection to the Raiffeisenbank Premium API';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
