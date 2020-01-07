<?php

namespace OptimistDigital\NovaDrafts\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;

class CreateDraftsMigration extends Command
{

    protected $signature = 'drafts:migration
                    { table? : Which table you would like to add drafts logic to }';


    protected $description = 'Add migration for nova-draft package';

    protected $tableName, $tables, $className, $files, $path;


    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

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
