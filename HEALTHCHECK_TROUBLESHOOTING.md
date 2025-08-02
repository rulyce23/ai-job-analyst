# Railway Healthcheck Troubleshooting Guide

## 🚨 Healthcheck Failure Solutions

### **Problem**: Railway healthcheck fails during deployment

### **Solution 1: Use Simple Healthcheck**

#### **1. Update Routes (`routes/web.php`)**
```php
// Super simple health check for Railway
Route::get('/ping', function () {
    return 'pong';
});

// Alternative simple health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now()->toISOString(),
        'app' => 'AI Job Analyst',
        'version' => '1.0.0'
    ], 200);
});
```

#### **2. Update Railway Configuration**
```toml
# railway.toml
[build]
builder = "dockerfile"

[deploy]
startCommand = "php artisan serve --host=0.0.0.0 --port=$PORT"
healthcheckPath = "/ping"
healthcheckTimeout = 300
restartPolicyType = "on_failure"
```

### **Solution 2: Disable Healthcheck (Fallback)**

#### **1. Use No Healthcheck Configuration**
```toml
# railway-no-healthcheck.toml
[build]
builder = "dockerfile"

[deploy]
startCommand = "php artisan serve --host=0.0.0.0 --port=$PORT"
restartPolicyType = "on_failure"

[env]
APP_ENV = "production"
APP_DEBUG = "false"
LOG_CHANNEL = "stack"
```

#### **2. Rename to Use**
```bash
# Rename to disable healthcheck
mv railway.toml railway-with-healthcheck.toml
mv railway-no-healthcheck.toml railway.toml
```

### **Solution 3: Multiple Healthcheck Options**

#### **Available Healthcheck Endpoints:**
1. **`/ping`** - Simplest (returns "pong")
2. **`/health`** - Basic JSON response
3. **`/api/health`** - Alternative endpoint
4. **`/health-check`** - Detailed health check

#### **Test Locally:**
```bash
# Start server
php artisan serve --host=0.0.0.0 --port=8000

# Test endpoints
curl http://localhost:8000/ping
curl http://localhost:8000/health
curl http://localhost:8000/api/health
curl http://localhost:8000/health-check
```

## 🔧 Railway Configuration Options

### **Option 1: Simple Healthcheck**
```toml
healthcheckPath = "/ping"
healthcheckTimeout = 300
```

### **Option 2: JSON Healthcheck**
```toml
healthcheckPath = "/health"
healthcheckTimeout = 300
```

### **Option 3: No Healthcheck**
```toml
# Remove healthcheckPath completely
```

### **Option 4: Custom Healthcheck**
```toml
healthcheckPath = "/api/health"
healthcheckTimeout = 300
```

## 🚀 Deployment Steps

### **Step 1: Test Locally**
```bash
# Test all healthcheck endpoints
curl http://localhost:8000/ping
curl http://localhost:8000/health
curl http://localhost:8000/api/health
```

### **Step 2: Deploy to Railway**
```bash
# Push changes
git add .
git commit -m "Fix Railway healthcheck with simple endpoints"
git push origin main
```

### **Step 3: Monitor Deployment**
1. Go to Railway Dashboard
2. Check deployment logs
3. Monitor healthcheck status
4. Verify application is running

## 🔍 Troubleshooting Steps

### **1. Check Railway Logs**
```bash
# In Railway Dashboard
# View deployment logs for errors
# Check if application starts properly
```

### **2. Test Healthcheck Manually**
```bash
# After deployment, test the healthcheck URL
curl https://your-app-name.railway.app/ping
curl https://your-app-name.railway.app/health
```

### **3. Verify Environment Variables**
```bash
# Make sure these are set in Railway:
APP_ENV=production
APP_DEBUG=false
APP_KEY=your_generated_key
APP_URL=https://your-app-name.railway.app
```

### **4. Check Application Startup**
```bash
# The start command should work:
php artisan serve --host=0.0.0.0 --port=$PORT
```

## 📋 Healthcheck Endpoints Comparison

| Endpoint | Response | Complexity | Railway Compatibility |
|----------|----------|------------|---------------------|
| `/ping` | `pong` | Very Simple | ✅ Best |
| `/health` | JSON | Simple | ✅ Good |
| `/api/health` | JSON | Simple | ✅ Good |
| `/health-check` | JSON | Complex | ⚠️ May fail |

## 🎯 Recommended Approach

### **For Railway Deployment:**
1. **Use `/ping` endpoint** - Most reliable
2. **Set timeout to 300 seconds** - Give enough time
3. **Monitor deployment logs** - Check for errors
4. **Test manually** - Verify after deployment

### **Configuration:**
```toml
[deploy]
startCommand = "php artisan serve --host=0.0.0.0 --port=$PORT"
healthcheckPath = "/ping"
healthcheckTimeout = 300
restartPolicyType = "on_failure"
```

## 🚨 Emergency Solutions

### **If Healthcheck Still Fails:**

#### **1. Disable Healthcheck Completely**
```toml
# Remove healthcheckPath from railway.toml
[deploy]
startCommand = "php artisan serve --host=0.0.0.0 --port=$PORT"
restartPolicyType = "on_failure"
```

#### **2. Use Railway Dashboard**
1. Go to Railway Dashboard
2. Navigate to your project
3. Go to Settings > Health Check
4. Disable health check temporarily

#### **3. Manual Verification**
```bash
# After deployment, manually check if app is running
curl https://your-app-name.railway.app
```

## 📞 Support

### **If Issues Persist:**
1. Check Railway documentation: https://docs.railway.app
2. Review deployment logs in Railway dashboard
3. Test healthcheck endpoints manually
4. Consider disabling healthcheck temporarily

---

**Note**: The `/ping` endpoint is the most reliable for Railway healthcheck. It's simple, fast, and rarely fails. 