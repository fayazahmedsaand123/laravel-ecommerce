# Laravel E-Commerce System

A full-featured multi-role E-Commerce web application built with **Laravel**, **Bootstrap**, **MySQL**, and **Ajax**.

---

## Features

- **Multi-Role System** — Admin, Seller, Customer
- **Admin Panel** — Manage users, orders, customers
- **Seller Dashboard** — Add/Edit/Delete products, view earnings, sales notifications
- **Customer Panel** — Browse products, add to cart, place orders
- **Shopping Cart** — Ajax-based add, update, delete with live grand total
- **Order Management** — Place orders, OTP email verification for order confirmation
- **Email Notifications** — Order confirmation via Gmail SMTP (OTP system)
- **Authentication** — Custom login, register, forgot password, password reset
- **Product Management** — Full CRUD with image upload
- **Responsive UI** — Bootstrap 5

---

## Tech Stack

| Layer      | Technology              |
|------------|-------------------------|
| Backend    | Laravel, PHP            |
| Frontend   | Bootstrap 5, Blade      |
| Database   | MySQL                   |
| Ajax       | jQuery Ajax             |
| Mail       | Gmail SMTP              |
| Auth       | Custom Session-Based    |

---

## Roles & Access

| Role     | Access |
|----------|--------|
| Admin    | Manage all users, orders, customers |
| Seller   | Manage own products, view earnings and sales |
| Customer | Browse products, cart, place orders |

---

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/fayazahmedsaand123/laravel-ecommerce.git

# 2. Navigate to project folder
cd laravel-ecommerce

# 3. Install dependencies
composer install

# 4. Copy environment file
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Set up your database in .env file
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 7. Set up Gmail SMTP in .env file
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls

# 8. Run migrations and seeders
php artisan migrate --seed

# 9. Start the server
php artisan serve
```

---

## Screenshots

> Add screenshots here

---

## Developer

**Fayaz Ahmed Saand**
Full-Stack Web Developer | Laravel · PHP · MySQL · JavaScript · Ajax · Bootstrap
📧 Fayazahmedsaand93@gmail.com
🔗 [GitHub](https://github.com/fayazahmedsaand123)

---

## License

This project is open-source and available under the [MIT License](LICENSE).
