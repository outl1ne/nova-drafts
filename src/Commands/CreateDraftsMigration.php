<?php

namespace OptimistDigital\NovaDrafts\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateDraftsMigration extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'drafts:migration
                    { table : Which table you would like to add drafts logic to }';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add migration for nova-draft package';


    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function handle()
    {
        if(! $this->hasOption('table')) {
            return $this->test();
        }

    }

    protected function test()
    {
        return $this->info('test');
    }
}
