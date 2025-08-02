# Railway Deployment Troubleshooting Guide

## 🚨 Error: nix-env build failure

### Problem
```
✕ [ 4/11] RUN nix-env -if .nixpacks/nixpkgs-e24b4c09e963677b1beea49d411cd315a024ad3a.nix && nix-collect-garbage -d 
process "/bin/bash -ol pipefail -c nix-env -if .nixpacks/nixpkgs-e24b4c09e963677b1beea49d411cd315a024ad3a.nix && nix-collect-garbage -d" did not complete successfully: exit code: 1
```

### Solution 1: Use Dockerfile (Recommended)
1. **Update railway.toml**:
```toml
[build]
builder = "dockerfile"
```

2. **Use the provided Dockerfile** which is more stable than nixpacks

### Solution 2: Fix nixpacks configuration
1. **Update nixpacks.toml**:
```toml
[phases.setup]
nixPkgs = ["php82", "php82Extensions.composer", "nodejs_18", "npm"]

[phases.install]
cmds = [
    "composer install --no-dev --optimize-autoloader --no-interaction",
    "npm install --production=false --legacy-peer-deps"
]

[phases.build]
cmds = [
    "npm run build",
    "php artisan config:cache",
    "php artisan route:cache",
    "php artisan view:cache"
]

[start]
cmd = "php artisan serve --host=0.0.0.0 --port=$PORT"
```

### Solution 3: Use railway.json
```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "dockerfile",
    "buildCommand": "npm run build"
  },
  "deploy": {
    "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
    "healthcheckPath": "/",
    "healthcheckTimeout": 300,
    "restartPolicyType": "on_failure"
  }
}
```

## 🔧 Common Railway Deployment Issues

### 1. npm ci fails
**Problem**: `npm ci` command fails during build
**Solution**: 
- Use `npm install --legacy-peer-deps` instead
- Move dependencies from `devDependencies` to `dependencies` in package.json

### 2. PHP version conflicts
**Problem**: PHP version not compatible
**Solution**:
- Use PHP 8.2 in Dockerfile
- Ensure composer.json specifies correct PHP version

### 3. Memory issues during build
**Problem**: Build process runs out of memory
**Solution**:
- Use Dockerfile instead of nixpacks
- Optimize build process with .dockerignore

### 4. Environment variables not set
**Problem**: App fails to start due to missing env vars
**Solution**:
```bash
# Set in Railway dashboard
APP_ENV=production
APP_DEBUG=false
APP_KEY=your_generated_key
APP_URL=https://your-app-name.railway.app
WATSONX_API_KEY=your_watsonx_api_key
WATSONX_PROJECT_ID=your_project_id
WATSONX_REGION=us-south
WATSONX_INSTANCE_ID=your_instance_id
```

## 🛠️ Alternative Deployment Methods

### Method 1: Dockerfile (Most Stable)
```dockerfile
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev \
    zip unzip nodejs npm

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www

RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install --legacy-peer-deps
RUN npm run build

EXPOSE 9000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
```

### Method 2: Simplified nixpacks
```toml
[phases.setup]
nixPkgs = ["php82", "composer", "nodejs_18", "npm"]

[phases.install]
cmds = [
    "composer install --no-dev --optimize-autoloader",
    "npm install --legacy-peer-deps"
]

[phases.build]
cmds = ["npm run build"]

[start]
cmd = "php artisan serve --host=0.0.0.0 --port=$PORT"
```

### Method 3: Procfile only
```procfile
web: php artisan serve --host=0.0.0.0 --port=$PORT
```

## 📋 Deployment Checklist

### Before Deployment
- [ ] All dependencies in `dependencies` (not `devDependencies`)
- [ ] Environment variables configured
- [ ] Database migrations ready
- [ ] Frontend assets built (`npm run build`)
- [ ] Laravel cache cleared

### During Deployment
- [ ] Monitor build logs
- [ ] Check for specific error messages
- [ ] Verify environment variables are set
- [ ] Test health check endpoint

### After Deployment
- [ ] Verify app is accessible
- [ ] Test API endpoints
- [ ] Check logs for errors
- [ ] Monitor performance

## 🔍 Debugging Commands

### Check Railway Logs
```bash
# View deployment logs
railway logs

# View specific service logs
railway logs --service your-service-name
```

### Test Locally
```bash
# Test build process locally
docker build -t ai-job-analyst .

# Run locally
docker run -p 8000:9000 ai-job-analyst
```

### Verify Configuration
```bash
# Check if all files are present
ls -la

# Verify package.json
cat package.json

# Check environment variables
php artisan tinker
echo config('app.env');
```

## 🚀 Quick Fix Steps

1. **Switch to Dockerfile**:
   ```bash
   # Update railway.toml
   [build]
   builder = "dockerfile"
   ```

2. **Redeploy**:
   ```bash
   git add .
   git commit -m "Switch to Dockerfile deployment"
   git push origin main
   ```

3. **Set Environment Variables** in Railway dashboard

4. **Monitor Deployment** in Railway dashboard

## 📞 Support

If issues persist:
1. Check Railway documentation: https://docs.railway.app
2. Review Laravel deployment guide: https://laravel.com/docs/deployment
3. Check IBM watsonx.ai setup: https://watsonx.ai/docs

---

**Note**: The Dockerfile approach is recommended for stability and reliability. 