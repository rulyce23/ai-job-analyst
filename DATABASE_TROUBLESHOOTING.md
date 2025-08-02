# Database Troubleshooting Guide

## 🚨 Error: Foreign Key Constraint is Incorrectly Formed

### Problem
```
SQLSTATE[HY000]: General error: 1005 Can't create table `db_aijob`.`candidates` 
(errno: 150 "Foreign key constraint is incorrectly formed") 
(Connection: mysql, SQL: alter table `candidates` add constraint 
`candidates_category_id_foreign` foreign key (`category_id`) references `categories` (`id`) on delete cascade)
```

### Root Cause
- Migration urutan tidak benar
- Table yang direferensikan belum dibuat
- Data type tidak cocok antara foreign key dan primary key
- Table sudah ada dari migration sebelumnya

### Solution 1: Fix Migration Order (Recommended)

**Problem**: Migration `candidates` dijalankan sebelum `categories`

**Solution**: Ubah timestamp migration file
```bash
# Rename migration file untuk mengubah urutan
mv database/migrations/2025_08_02_071055_create_categories_table.php \
   database/migrations/2025_08_02_063600_create_categories_table.php
```

**Urutan yang benar**:
1. `2025_08_02_063600_create_categories_table.php` (sebelumnya 071055)
2. `2025_08_02_071041_create_candidates_table.php`

### Solution 2: Fresh Migration
```bash
# Drop semua table dan jalankan ulang migration
php artisan migrate:fresh
```

### Solution 3: Rollback dan Migrate
```bash
# Rollback semua migration
php artisan migrate:rollback

# Jalankan migration lagi
php artisan migrate
```

### Solution 4: Drop Table Manual
```sql
-- Jika menggunakan MySQL
DROP TABLE IF EXISTS candidates;
DROP TABLE IF EXISTS categories;

-- Jalankan migration lagi
php artisan migrate
```

## 🔧 Common Database Issues

### 1. Foreign Key Constraint Errors
**Problem**: Foreign key tidak bisa dibuat
**Solution**: 
- Periksa urutan migration
- Pastikan table yang direferensikan sudah ada
- Periksa data type compatibility

### 2. Table Already Exists
**Problem**: `Base table or view already exists`
**Solution**:
```bash
# Fresh migration
php artisan migrate:fresh

# Atau drop table manual
php artisan db:wipe
php artisan migrate
```

### 3. Migration Order Issues
**Problem**: Migration dijalankan dalam urutan yang salah
**Solution**:
```bash
# Rollback semua
php artisan migrate:rollback

# Rename file migration untuk mengubah urutan
# Jalankan migrate lagi
php artisan migrate
```

### 4. Data Type Mismatch
**Problem**: Foreign key dan primary key data type tidak cocok
**Solution**:
```php
// Pastikan data type sama
$table->foreignId('category_id')->constrained(); // bigint
$table->id(); // bigint (default)
```

## 🛠️ Migration Best Practices

### 1. Proper Migration Order
```php
// Urutan yang benar
2025_08_02_063600_create_categories_table.php
2025_08_02_071041_create_candidates_table.php
```

### 2. Foreign Key Declaration
```php
// Cara yang benar
$table->foreignId('category_id')->constrained()->onDelete('cascade');

// Atau lebih spesifik
$table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
```

### 3. Migration File Naming
```bash
# Format yang benar
php artisan make:migration create_categories_table
php artisan make:migration create_candidates_table
```

## 📋 Database Setup Checklist

### Before Migration
- [ ] Database connection configured
- [ ] Database exists
- [ ] User has proper permissions
- [ ] Migration files in correct order

### During Migration
- [ ] Monitor migration logs
- [ ] Check for foreign key errors
- [ ] Verify table creation order
- [ ] Test foreign key constraints

### After Migration
- [ ] Verify all tables created
- [ ] Test foreign key relationships
- [ ] Check data integrity
- [ ] Run seeders if needed

## 🔍 Debugging Commands

### Check Migration Status
```bash
# View migration status
php artisan migrate:status

# View pending migrations
php artisan migrate:status --pending
```

### Check Database Tables
```bash
# List all tables
php artisan tinker
DB::select('SHOW TABLES');

# Check table structure
DB::select('DESCRIBE candidates');
DB::select('DESCRIBE categories');
```

### Test Foreign Keys
```bash
# Check foreign key constraints
DB::select('SHOW CREATE TABLE candidates');
```

### Reset Database
```bash
# Fresh start
php artisan migrate:fresh

# With seeders
php artisan migrate:fresh --seed
```

## 🚀 Quick Fix Steps

1. **Fix Migration Order**:
   ```bash
   # Rename migration file
   mv database/migrations/2025_08_02_071055_create_categories_table.php \
      database/migrations/2025_08_02_063600_create_categories_table.php
   ```

2. **Fresh Migration**:
   ```bash
   php artisan migrate:fresh
   ```

3. **Verify Tables**:
   ```bash
   php artisan tinker
   DB::select('SHOW TABLES');
   ```

4. **Test Foreign Keys**:
   ```bash
   # Insert test data
   php artisan tinker
   $category = App\Models\Category::create(['name' => 'Test Category']);
   $candidate = App\Models\Candidate::create([
       'category_id' => $category->id,
       'name' => 'Test Candidate',
       'email' => 'test@example.com'
   ]);
   ```

## 📞 Support

If issues persist:
1. Check Laravel documentation: https://laravel.com/docs/migrations
2. Review MySQL foreign key documentation
3. Check database connection settings in `.env`

---

**Note**: Always backup your database before running `migrate:fresh` in production. 