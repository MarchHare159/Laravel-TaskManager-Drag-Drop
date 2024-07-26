<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

## About Task Manager

This project is a task management application built with Laravel. It allows users to create, edit, delete, and reorder tasks. The application utilizes Laravel’s features such as routing, Eloquent ORM, and Blade templating.

## Features

- **Task Management**: Create, update, delete, and reorder tasks.
- **User Interface**: Stylish and responsive UI using Bootstrap.
- **AJAX Reordering**: Tasks can be reordered using drag-and-drop functionality.

## Learning Laravel

To get started with Laravel, refer to the extensive [documentation](https://laravel.com/docs) and [video tutorial library](https://laracasts.com). You can also explore the [Laravel Bootcamp](https://bootcamp.laravel.com) for a guided introduction.

## Installation

Follow these steps to set up the project on your local machine:

## Running Locally

### Clone the Project

```bash
git clone https://github.com/loonglim/Laravel-TaskManager.git
```

### Go to the project directory

```bash
cd Laravel-TaskManager
```

### Install PHP Dependencies

```bash
composer install
```

### Install JavaScript Dependencies

```bash
npm install
```

### Set Up Environment Variables
Copy the example environment file and adjust the settings:

```bash
cp .env.example .env
# Edit .env to configure database settings and other environment variables
```

### Generate Application Key

```bash
php artisan key:generate
```

### Run Migrations
Apply database migrations to set up the required tables:

```bash
php artisan migrate
```

### Build Frontend Assets
Compile and build the frontend assets:

```bash
npm run dev
```

### Serve the Application
Start the Laravel development server:

```bash
php artisan serve
```

Visit http://localhost:8000 in your web browser to access the application.

<img src="https://github.com/loonglim/Laravel-TaskManager/blob/main/screenshots/1.png?raw=true" alt="screenshot/1">
<img src="https://github.com/loonglim/Laravel-TaskManager/blob/main/screenshots/2.png?raw=true" alt="screenshot/2">
<img src="https://github.com/loonglim/Laravel-TaskManager/blob/main/screenshots/3.png?raw=true" alt="screenshot/3">