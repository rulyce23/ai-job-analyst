# Spatie Laravel Health Check Guide

## 🚀 Overview

Spatie Laravel Health Check digunakan untuk monitoring kesehatan aplikasi di Railway deployment. Package ini menyediakan berbagai health checks yang dapat digunakan untuk memastikan aplikasi berjalan dengan baik.

## 📦 Installation

### 1. Install Package
```bash
composer require spatie/laravel-health
```

### 2. Publish Configuration
```bash
php artisan vendor:publish --provider="Spatie\Health\HealthServiceProvider"
```

### 3. Run Migration
```bash
php artisan migrate
```

## 🔧 Configuration

### Health Check Configuration
```php
// config/health.php
return [
    'checks' => [
        'database' => [
            'class' => \Spatie\Health\Checks\Checks\DatabaseCheck::class,
        ],
        'cache' => [
            'class' => \Spatie\Health\Checks\Checks\CacheCheck::class,
        ],
        'environment' => [
            'class' => \Spatie\Health\Checks\Checks\EnvironmentCheck::class,
        ],
    ],

    'route' => [
        'enabled' => true,
        'path' => 'health',
    ],
];
```

### Railway Configuration
```toml
# railway.toml
[build]
builder = "dockerfile"

[deploy]
startCommand = "php artisan serve --host=0.0.0.0 --port=$PORT"
healthcheckPath = "/health-check"
healthcheckTimeout = 300
restartPolicyType = "on_failure"
```

## 📡 Health Check Routes

### 1. Basic Health Check
```php
// routes/web.php
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now(),
        'app' => 'AI Job Analyst',
        'version' => '1.0.0',
        'environment' => config('app.env'),
        'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected'
    ]);
});
```

### 2. Advanced Health Check
```php
Route::get('/health-check', function () {
    try {
        $checks = [
            'database' => DB::connection()->getPdo() ? true : false,
            'cache' => Cache::store()->has('health_check') !== false,
            'app_key' => config('app.key') && config('app.key') !== 'base64:',
            'environment' => config('app.env') ? true : false,
        ];

        $allHealthy = !in_array(false, $checks);

        return response()->json([
            'status' => $allHealthy ? 'healthy' : 'unhealthy',
            'timestamp' => now(),
            'checks' => $checks,
            'app' => 'AI Job Analyst'
        ], $allHealthy ? 200 : 503);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'unhealthy',
            'error' => $e->getMessage(),
            'timestamp' => now()
        ], 503);
    }
});
```

### 3. Spatie Health Route
```php
// Otomatis tersedia di /health setelah konfigurasi
// Menggunakan Spatie Health Check
```

## 🛠️ Custom Health Check Command

### Health Check Command
```php
// app/Console/Commands/HealthCheckCommand.php
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
```

## 🚀 Usage

### 1. Command Line
```bash
# Run health check via command
php artisan health:check

# Expected output:
# Starting health check...
# Database Connection: ✅ PASS
# Cache Connection: ✅ PASS
# Storage Connection: ✅ PASS
# Environment Variables: ✅ PASS
# Application Key: ✅ PASS
# All health checks passed!
```

### 2. HTTP Endpoints
```bash
# Basic health check
curl http://localhost:8000/health

# Advanced health check
curl http://localhost:8000/health-check

# Spatie health check
curl http://localhost:8000/health
```

### 3. Railway Deployment
```bash
# Railway akan otomatis menggunakan /health-check untuk health check
# Pastikan environment variables sudah diset di Railway dashboard
```

## 📋 Health Check Types

### 1. Database Check
- Memverifikasi koneksi database
- Mengecek apakah database dapat diakses
- Memastikan query dapat dieksekusi

### 2. Cache Check
- Memverifikasi koneksi cache
- Mengecek apakah cache dapat diakses
- Memastikan cache berfungsi dengan baik

### 3. Environment Check
- Memverifikasi environment variables
- Mengecek konfigurasi aplikasi
- Memastikan semua variabel yang diperlukan tersedia

### 4. Application Key Check
- Memverifikasi APP_KEY sudah diset
- Mengecek apakah key valid
- Memastikan aplikasi dapat dienkripsi

### 5. Storage Check
- Memverifikasi koneksi storage
- Mengecek apakah file system dapat diakses
- Memastikan upload/download berfungsi

## 🔍 Troubleshooting

### 1. Health Check Fails
```bash
# Cek logs
php artisan log:clear
php artisan health:check

# Cek environment variables
php artisan tinker
echo config('app.key');
echo config('app.env');
```

### 2. Database Connection Issues
```bash
# Test database connection
php artisan tinker
DB::connection()->getPdo();

# Cek database configuration
php artisan config:cache
php artisan config:clear
```

### 3. Cache Issues
```bash
# Test cache
php artisan tinker
Cache::put('test', 'value', 60);
Cache::get('test');

# Clear cache
php artisan cache:clear
```

### 4. Railway Health Check Issues
```bash
# Test health check endpoint
curl -X GET http://localhost:8000/health-check

# Expected response:
{
    "status": "healthy",
    "timestamp": "2025-08-02T12:00:00.000000Z",
    "checks": {
        "database": true,
        "cache": true,
        "app_key": true,
        "environment": true
    },
    "app": "AI Job Analyst"
}
```

## 📊 Monitoring

### 1. Railway Dashboard
- Monitor health check status di Railway dashboard
- Cek logs untuk error details
- Verifikasi environment variables

### 2. Health Check Logs
```bash
# View health check logs
tail -f storage/logs/laravel.log | grep health

# Check specific health check
php artisan health:check --verbose
```

### 3. Custom Monitoring
```php
// Tambahkan custom monitoring
Route::get('/monitor', function () {
    return response()->json([
        'status' => 'healthy',
        'uptime' => now()->diffInSeconds(app()->startTime()),
        'memory' => memory_get_usage(true),
        'checks' => [
            'database' => DB::connection()->getPdo() ? true : false,
            'cache' => Cache::store()->has('health_check') !== false,
        ]
    ]);
});
```

## 🚀 Deployment Checklist

### Before Deployment
- [ ] Spatie Health Check installed
- [ ] Health check routes configured
- [ ] Environment variables set
- [ ] Database connection tested
- [ ] Cache connection tested

### During Deployment
- [ ] Monitor Railway build logs
- [ ] Check health check endpoint
- [ ] Verify environment variables
- [ ] Test database connection

### After Deployment
- [ ] Verify health check passes
- [ ] Monitor application logs
- [ ] Test all endpoints
- [ ] Check performance metrics

## 📞 Support

If issues persist:
1. Check Spatie Health documentation: https://spatie.be/docs/laravel-health
2. Review Railway health check documentation
3. Check Laravel logs for detailed error messages

---

**Note**: Health checks are crucial for Railway deployment. Make sure all checks pass before deploying to production. 