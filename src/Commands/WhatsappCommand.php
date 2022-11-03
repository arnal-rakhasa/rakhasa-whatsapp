<?php

namespace Rakhasa\Whatsapp\Commands;

use Illuminate\Console\Command;

class WhatsappCommand extends Command
{
    public $signature = 'whatsapp';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
