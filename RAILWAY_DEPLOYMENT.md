# Railway Deployment Guide untuk AI Job Analyst

## Konfigurasi yang Sudah Diperbaiki

### 1. Package.json
- ✅ Dependencies dipindahkan dari `devDependencies` ke `dependencies`
- ✅ Versi Vite dan Laravel Vite Plugin disesuaikan untuk kompatibilitas
- ✅ Node.js engine version diupdate untuk mendukung versi yang lebih fleksibel
- ✅ Script `postinstall` ditambahkan untuk auto-build

### 2. File Konfigurasi Railway
- ✅ `railway.toml` - Konfigurasi utama Railway
- ✅ `nixpacks.toml` - Konfigurasi build process
- ✅ `railway.json` - Alternatif konfigurasi JSON
- ✅ `Procfile` - Konfigurasi startup command
- ✅ `.railwayignore` - File yang diabaikan saat deployment

### 3. Vite Configuration
- ✅ `vite.config.js` diupdate untuk production build
- ✅ Output directory diset ke `public/build`
- ✅ HMR configuration untuk development

## Langkah Deployment ke Railway

### 1. Push ke Repository
```bash
git add .
git commit -m "Fix Railway deployment configuration"
git push origin main
```

### 2. Deploy ke Railway
1. Buka [Railway Dashboard](https://railway.app)
2. Klik "New Project"
3. Pilih "Deploy from GitHub repo"
4. Pilih repository `ai-job-analyst`
5. Railway akan otomatis mendeteksi konfigurasi

### 3. Environment Variables
Setelah deployment, atur environment variables di Railway:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY` (generate dengan `php artisan key:generate`)
- `APP_URL=https://your-app-name.railway.app`

### 4. Database Setup
Jika menggunakan database:
- Tambahkan database service di Railway
- Update `DB_*` environment variables
- Jalankan migration: `php artisan migrate`

## Troubleshooting

### Jika masih gagal di `npm ci`:
1. Pastikan Node.js version di Railway sesuai (18.x atau lebih)
2. Cek log build di Railway dashboard
3. Jika masih error, coba deploy ulang

### Jika build berhasil tapi app tidak jalan:
1. Cek environment variables
2. Pastikan `APP_KEY` sudah diset
3. Cek log aplikasi di Railway dashboard

## File Konfigurasi yang Dibuat

- `package.json` - Dependencies dan scripts
- `railway.toml` - Konfigurasi Railway utama
- `nixpacks.toml` - Build process configuration
- `railway.json` - Alternatif konfigurasi
- `Procfile` - Startup command
- `.railwayignore` - Ignore file
- `vite.config.js` - Vite build configuration

## Perubahan Utama

1. **Dependencies**: Semua dependencies dipindahkan ke `dependencies` agar terinstall di production
2. **Versi Compatibility**: Vite 5.x dan Laravel Vite Plugin 1.x untuk kompatibilitas
3. **Build Process**: Menggunakan `npm install` alih-alih `npm ci` untuk menghindari error
4. **Node.js Version**: Fleksibel untuk versi 18.x atau lebih
5. **Auto Build**: Script `postinstall` untuk auto-build setelah install

Sekarang deployment ke Railway seharusnya berhasil tanpa error `npm ci`! 