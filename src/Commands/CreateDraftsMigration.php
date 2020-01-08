<?php

namespace OptimistDigital\NovaDrafts\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use InvalidArgumentException;

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
     * @throws InvalidArgumentException
     */
    public function handle()
    {
        $this->tables = $this->getTables();
        $this->tableName = $this->getTableNameArgument();
        $this->className = $this->makeClassNameArgument();
        $this->path = $this->getPath();
        $this->files->put($this->path, $this->buildClass());
        $this->info('Migration Successfully created at' . $this->path);
    }

    public function getTables()
    {
        $tables = DB::select('SHOW TABLES');
        return array_map('current', $tables);
    }

    /**
     * Gets the table name argument - if missing or exists, asks the user to enter it.
     *
     * @return string
     **/
    public function getTableNameArgument()
    {
        if (!$this->argument('table')) {
            return $this->getTableChoice();
        }
        return $this->validateInsertedTableName();
    }

    public function getTableChoice()
    {
        return $this->choice('Please choose a table name you wish to add drafts to', $this->tables);
    }

    public function validateInsertedTableName()
    {
        if (Schema::hasTable($this->argument('table'))) return $this->argument('table');
        $this->error("[ERROR] Table '{$this->argument('table')}' does not exist in your database");
        return $this->getTableChoice();

    }

    public function makeClassNameArgument()
    {
        $class_name = $this->tableName;
        $class_name = join(array_map('ucfirst', explode('_', $class_name)));
        $class_name = "AddNovaDraftsTo{$class_name}";

        if (Schema::hasColumn($this->tableName, 'draft_parent_id')) throw new \Exception("Table '{$this->tableName}' already has drafts");
        return $class_name;
    }

    /**
     * Creates the directory for the migration files and returns the file path.
     *
     * @return string
     **/
    protected function getPath()
    {
        $file_name = date('Y') . '_' . date('m') . '_' . date('d') . '_' . mt_rand(100000, 999999) . '_' . 'add_nova_drafts_to_' . $this->tableName . '.php';
        return $this->makeDirectory(
            database_path('migrations/' . $file_name)
        );
    }

    /**
     * Creates the directory for the template file.
     *
     * @param string $path Expected path of the Migration file.
     * @return string
     **/
    protected function makeDirectory($path)
    {
        $directory = dirname($path);
        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true, true);
        }
        return $path;
    }


    /**
     * Create the migration file content.
     *
     * @return string
     */
    protected function buildClass()
    {
        $replace = [
            ':className' => $this->className,
            ':tableName' => $this->tableName,
        ];

        $migration = $this->files->get(__DIR__ . '/../Stubs/DraftMigrationStub.php');

        foreach ($replace as $key => $value) {
            $migration = str_replace($key, $value, $migration);
        }

        return $migration;
    }
}
