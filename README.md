# People Manager App

A Laravel 12 web application for managing **employees** and **departments**, with authentication, CRUD operations, and a dark-themed UI.

---

## Features

- User authentication (login/register/logout)
- Manage departments and employees
- Add, edit, delete employees
- Assign employees to departments
- Dark-themed interface with Bootstrap 5
- Fully dynamic tables with AJAX for add/edit/delete operations
- Seeders for sample data

---

## Requirements

- PHP >= 8.1  
- Composer  
- Node.js & npm  
- MySQL (or any database supported by Laravel)  
- Git  

---

## Installation

### 1. Clone the repository

bash
git clone https://github.com/bdverwin/people-manager.git
cd people-manager

### 2. Install PHP dependencies

bash
composer install

## 3. Install Node dependencies and build assets
npm install
npm run dev

## 4. Copy .env file and configure environment
cp .env.example .env
Update .env with your database credentials:

ini
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

## 5. Generate application key
php artisan key:generate

## 6. Run migrations and seeders
php artisan migrate --seed
This will create the tables and populate them with sample departments and employees.

**Running the Application**

Start the development server:
php artisan serve


Open your browser and visit:
http://127.0.0.1:8000

**Usage**

Register a new account or login with a seeded user.

Navigate to Departments to see a list of departments.

Click a department to view employees in that department.

Use the Add, Edit, or Delete buttons to manage employees.

Logout using the button in the top-right corner.
