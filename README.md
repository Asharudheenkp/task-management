Task Management API

Installation

### 1. Clone the Repository
git clone https://github.com/Asharudheenkp/task-management.git
cd task-management

### 2. Install Dependencies

Run Composer to install the required packages.

composer update


### 3. Configure Environment File

Copy the example environment file and create a new .env file.

cp .env.example .env

Then update the database configuration in .env:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=your_database

DB_USERNAME=your_username

DB_PASSWORD=your_password

### 4. Generate Application Key

Generate the Laravel application key.

php artisan key:generate
### 5. Run Database Migration

Create the required database tables.

php artisan migrate
### 6. Start the Development Server

Run the Laravel development server.

php artisan serve

The application will be available at:

http://localhost:8000
API Routes

## All API endpoints are defined in:

routes/api.php

Scheduler

Scheduled tasks are defined in:

routes/console.php

## Api routes

## Task list
GET http://127.0.0.1:8000/api/tasks

### Parameters
assigned_to

status

title

## Task Create
POST http://127.0.0.1:8000/api/tasks

### Body
title

description

status

due_date

assigned_to


## Task Assign
http://127.0.0.1:8000/api/tasks/3/assign

### Body

assigned_to

## Task Mark As Complete
http://127.0.0.1:8000/api/tasks/1/complete



## User Registration
http://127.0.0.1:8000/api/user/registration

### Body

name

email

password

## User Login
http://127.0.0.1:8000/api/user/login

### Body

email

password


