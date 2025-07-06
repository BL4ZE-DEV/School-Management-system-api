<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create {school_name} {subdomain} {location} {--manager=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new tenant (school) with its own database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $school_name = $this->argument('school_name');
        $subdomain = $this->argument('subdomain');
        $location = $this->argument('location');
        $managerId = $this->option('manager');
        $database_name = 'tenant_' . Str::slug($school_name, '_');

        DB::statement("Create Database `$database_name`");

        Config::set('database.connections.tenant',[
            'driver' => 'mysql',
            'host' => env('TENANTS_DB_HOST', 'localhost'),
            'port' => env('TENANTS_DB_PORT', '3306'),
            'database' => $database_name,
            'username' => env('TENANTS_DB_USERNAME', 'root'),
            'password' => env('TENANTS_DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
        ]);


        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => "database/migrations/tenants",
            '--force' => true
        ]);

        $h = DB::connection('central')->table('tenants')->insert([
            'tenant_id' => Str::uuid(),
            'subdomain' => $subdomain,
            'location' => $location,
            'database_name' => $database_name,
            'manager_id' => $managerId,
            'school_name' => $school_name,
            'created_at' => now(),
            'updated_at' => now()
    ]);

        $this->info("✅ Tenant [$school_name] created successfully!");
    }
}
