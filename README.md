# HMCTS Task Manager – Backend API

## Overview

This project is a RESTful API built using Laravel 12. It provides task management functionality including creation, retrieval, updating and deletion of tasks.

The architecture follows clean separation of concerns principles with validation, service layer abstraction and resource-based API responses.

## Tech Stack

	•	PHP 8.3+
    •	Composer
	•	Laravel 12
	•	SQLite (local development)
	•	RESTful API design
	•	FormRequest validation
	•	Pagination support

## Prerequisites
	•	PHP 8.3+
	•	Composer
	•	Git

## Installing Composer

#### macOS

Using Homebrew:
brew install composer

#### Linux
sudo apt update
sudo apt install composer

#### Windows

Download installer from:

https://getcomposer.org/download/

Verify installation:
composer -v

## Installation & Setup

### 1️⃣ Clone repository
git clone https://github.com/YOUR_USERNAME/hmcts-task-api.git
cd hmcts-task-api

### 2️⃣ Install dependencies

composer install

### 3️⃣ Configure environment

cp .env.example .env
php artisan key:generate

## Setup database (SQLite)

touch database/database.sqlite

Update .env:

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

Run migrations:

php artisan serve

API available at:
http://127.0.0.1:8000/api

## Features
	•	Create task
	•	Retrieve paginated tasks
	•	Filter by status
	•	Update task status
	•	Delete task
	•	Proper 422 validation handling
	•	REST-compliant responses

## Architectural Decisions
	•	FormRequest used for validation separation
	•	Service layer handles business logic
	•	Resource classes standardise JSON output
	•	Pagination implemented for scalability
	•	Controllers kept thin
	•	Proper HTTP status codes used

## Possible Future Enhancements
	•	Authentication
	•	Role-based access control
	•	Sorting support
	•	Advanced filtering
	•	Test coverage expansion



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
