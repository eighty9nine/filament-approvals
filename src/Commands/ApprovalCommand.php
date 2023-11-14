<?php

namespace EightyNine\Approvals\Commands;

use Illuminate\Console\Command;

class ApprovalCommand extends Command
{
    public $signature = 'filament-approvals';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
