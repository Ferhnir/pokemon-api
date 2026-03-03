# Pokemon API – Laravel 12

POKEMON MANAGER - REST API project built with Laravel 12.

## 📦 Requirements

* PHP 8.2+
* Composer
* SQLite / MySQL
* Git

---

# 🚀 Installation

## 1️⃣ Clone repository

```bash
git clone git@github.com:Ferhnir/pokemon-api.git
cd pokemon-api
```

---

## 2️⃣ Install dependencies

```bash
composer install
```

---

## 3️⃣ Environment configuration

Copy example environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## 4️⃣ Configure database

In `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

Or configure MySQL accordingly.

---

## 5️⃣ Run migrations & seeders
(You will be asked to create sqlite db)
```bash
php artisan migrate --seed
```

---

## 6️⃣ Start development server

```bash
php artisan serve
```

API will be available at:

```
http://127.0.0.1:8000
```

---

# 🔐 Authorization

Some Endpoints require header:

```
X-SUPER-SECRET-KEY: your_secret_key
```

The key must match the value defined in `.env`:

```env
SUPER_SECRET_KEY=your_secret_key
```

```bash
php artisan config:cache
```

---

# ⚡ Cache

Pokemon data is cached and automatically expires daily at **12:00 (UTC+1)**.

If scheduler is configured, make sure CRON is running:

```bash
* * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1
```

---

# 🧪 Useful Commands

Clear cache:

```bash
php artisan optimize:clear
```

Refresh Pokemon cache manually:

```bash
php artisan refresh:pokemon-cache
```

---

# 📌 Main Features

* Banned Pokemon registry (`/api/banned`)
* API key authorization
* Pokemon list endpoint (`/api/info`)
* Daily cache refresh (12:00 UTC+1)
* Filtering & pagination support

---

# 🛠 Production Notes

* Configure proper database
* Ensure scheduler CRON is active

---

# 👤 Author

Maksymilian Zdunski
