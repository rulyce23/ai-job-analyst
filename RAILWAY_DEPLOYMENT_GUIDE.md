# Railway Deployment Guide for AI Job Analyst

## Overview

This guide provides instructions for deploying the AI Job Analyst application to Railway.

## Configuration Files

- `railway.toml` - Main Railway configuration file
- `railway.json` - Alternative Railway configuration in JSON format
- `Dockerfile` - Docker configuration for building the application
- `.env.production` - Production environment variables

## Deployment Steps

### 1. Push to Repository

```bash
git add .
git commit -m "Update Railway deployment configuration"
git push origin main
```

### 2. Deploy to Railway

1. Go to [Railway Dashboard](https://railway.app)
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Choose your repository
5. Railway will automatically detect the configuration

### 3. Environment Variables

Ensure these environment variables are set in the Railway dashboard:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY` (from your .env.production file)
- `APP_URL=https://your-railway-app-url.railway.app`

### 4. Verify Deployment

1. Check the deployment logs in Railway dashboard
2. Test the application by visiting the URL provided by Railway
3. Test the health check endpoint: `/ping`

## Troubleshooting

### 502 Bad Gateway

If you encounter a 502 Bad Gateway error:

1. Check the deployment logs in Railway dashboard
2. Verify that the application is starting correctly
3. Ensure the health check endpoint is responding
4. Check that the port configuration is correct

### Application Failed to Respond

If the application fails to respond:

1. Check if the Dockerfile is using the correct port configuration
2. Verify that the `$PORT` environment variable is being used
3. Check the health check configuration
4. Review the application logs for errors

### Health Check Failures

If health checks are failing:

1. Test the health check endpoint locally
2. Increase the health check timeout in railway.toml
3. Consider using a simpler health check endpoint

## Current Configuration

### Dockerfile

The Dockerfile is configured to:

1. Use PHP 8.2
2. Install all necessary dependencies
3. Build the frontend assets
4. Start the Laravel development server on the port specified by Railway

### Railway Configuration

The Railway configuration is set to:

1. Use the Dockerfile for building the application
2. Start the application with `php artisan serve --host=0.0.0.0 --port=$PORT`
3. Use `/ping` as the health check endpoint
4. Set a health check timeout of 300 seconds
5. Restart the application on failure

## Support

If issues persist:

1. Check Railway documentation: https://docs.railway.app
2. Review Laravel deployment guide: https://laravel.com/docs/deployment
3. Check the application logs for detailed error messages