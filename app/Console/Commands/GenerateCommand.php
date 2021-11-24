<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:generate {--with-all} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('migrate:fresh');

        $tables = \DB::connection()->getDoctrineSchemaManager()->listTableNames();
        $out_of_scope_tables = ['taken_curriculums','failed_jobs', 'migrations','password_resets','personal_access_tokens','sessions', 'team_user', 'team_invitations'];
        $tables = array_diff($tables, $out_of_scope_tables);

        // blade,js,sassのstubを事前に読み込む。bladeのmakeはないため自作
        $blade_index_stub = \File::get('stubs/blade.index.stub');
        $blade_create_edit_stub = \File::get('stubs/blade.create_edit.stub');

        $webphp = "";

        foreach ($tables as $table_name) {
            $singular_name = \Str::studly(\Str::singular($table_name));
            $singular_kebab_name = \Str::kebab(\Str::studly(\Str::singular($table_name)));


            // Userの場合は認証処理があるので動作を変えるphp artisan stub:publish
            $base_class_name = 'App\\Models\\BaseModel';
            if ($singular_name === 'User') {
                $base_class_name = 'App\\Models\\BaseUserModel';
            } elseif ($singular_name === 'Team') {
                $base_class_name = 'App\\Models\\BaseTeamModel';
            }

            try {
                // こちらを呼び出す(composer.jsonで差し替える)
                // https://github.com/rytskywlkr/eloquent-model-generator
                $this->call(
                    'krlove:generate:model',
                    [
                        'class-name' => $singular_name,
                        '--output-path' => 'Models/generated',
                        '--namespace' => 'App\\Models\\generated',
                        '--base-class-name' => $base_class_name
                    ]
                );
            } catch (\Krlove\EloquentModelGenerator\Exception\GeneratorException $exception) {
                echo "中間テーブルであれば問題なし：" . $exception->getMessage();
                continue;
            }

            if ($this->option("with-all")) {
                $this->call('make:model', ['name' => $singular_name, '--force' => $this->option("force")]);
                $this->call('make:controller', ['name' => $singular_name . 'Controller', '--resource' => true, '--model' => $singular_name, '--force' => $this->option("force")]);
                // $this->call('make:seeder', ['name' => $singular_name]);
                // try {
                //     $this->call('generate:factory', ['model' => [$singular_name], '--force' => $this->option("force"), '--dir' => 'app/Models']);
                // } catch (\Error $error) {
                //     echo "テーブル名順に実行されるので依存するModelがまだできていないだけかも。再実行してみて：" . $error->getMessage();
                //     continue;
                // }


                // blade生成
                if (!\File::isDirectory(resource_path() . '/views/pages/' . $singular_kebab_name)) {
                    \File::makeDirectory(resource_path() . '/views/pages/' . $singular_kebab_name);
                }
                $blade_index = resource_path() . '/views/pages/' . $singular_kebab_name . '/index.blade.php';
                \File::put($blade_index, $blade_index_stub);
                echo $blade_index . ' created successfully';
                $blade_create_edit = resource_path() . '/views/pages/' . $singular_kebab_name . '/create-edit.blade.php';
                \File::put($blade_create_edit, $blade_create_edit_stub);
                echo $blade_create_edit . ' created successfully';

            }
            // web.php
            $webphp = $webphp . "\n" . "Route::resource('/" . $singular_kebab_name . "', '" . $singular_name . "Controller');";
        }

        $this->call('db:seed');

        print_r($webphp);
    }
}
