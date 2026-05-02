# URL Shortener

A URL shortener application built with **Laravel** as the backend.
The frontend is designed using **CSS + JavaScript with Vite**.

---

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/Anujkumawat/url-shortener-project.git
cd url-shortener-project
```

---

### 2. Install dependencies

```bash
composer install
npm install
```

---

### 3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

---

### 4. Configure Database

Update `.env` file with your database credentials:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

### 5. Run migrations & seeders

```bash
php artisan migrate --seed
```

---

### 🔑 Default Admin Login

```
Email: superadmin@example.com
Password: 12345678
```

---

### 6. Configure mail settings in `.env` for sending invitation emails (you can use https://mailtrap.io for testing)

For email testing, you can use Mailtrap:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
```

---

## ▶️ Running the Project

```bash
php artisan serve
```

Open the URL shown in terminal (e.g. http://127.0.0.1:8000) in your browser.

