<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HealthCheckCommand extends Command
{
    protected $signature = 'health:check';
    protected $description = 'Check application health for Railway deployment';

    public function handle()
    {
        $this->info('Starting health check...');

        $checks = [
            'Database Connection' => $this->checkDatabase(),
            'Cache Connection' => $this->checkCache(),
            'Storage Connection' => $this->checkStorage(),
            'Environment Variables' => $this->checkEnvironment(),
            'Application Key' => $this->checkAppKey(),
        ];

        $allPassed = true;
        foreach ($checks as $name => $result) {
            $status = $result ? '✅ PASS' : '❌ FAIL';
            $this->line("{$name}: {$status}");
            if (!$result) {
                $allPassed = false;
            }
        }

        if ($allPassed) {
            $this->info('All health checks passed!');
            return 0;
        } else {
            $this->error('Some health checks failed!');
            return 1;
        }
    }

    private function checkDatabase(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function checkCache(): bool
    {
        try {
            Cache::store()->has('health_check');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function checkStorage(): bool
    {
        try {
            Storage::disk()->exists('health_check');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function checkEnvironment(): bool
    {
        $required = ['APP_ENV', 'APP_KEY', 'DB_CONNECTION'];
        foreach ($required as $var) {
            if (!config($var)) {
                return false;
            }
        }
        return true;
    }

    private function checkAppKey(): bool
    {
        return config('app.key') && config('app.key') !== 'base64:';
    }
} 