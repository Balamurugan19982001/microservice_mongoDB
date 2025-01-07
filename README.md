# Laravel 11 MongoDB JWT Microservice

A Laravel 11 microservice implementing CRUD operations with MongoDB and JWT authentication.

## Requirements

- PHP 8.2+
- MongoDB 4.4+
- MongoDB PHP Driver
- Composer

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd laravel-mongodb-jwt
```

2. Install dependencies:
```bash
composer install
```

3. Configure environment:
```bash
cp .env.example .env
```

4. Generate JWT secret:
```bash
php artisan jwt:secret
```

5. Update .env with MongoDB credentials and JWT settings

6. Run migrations:
```bash
php artisan migrate
```

## API Endpoints

### Authentication
- POST /api/auth/register - Register new user
- POST /api/auth/login - Login user
- POST /api/auth/logout - Logout user
- POST /api/auth/refresh - Refresh token

### Tasks (Protected Routes)
- GET /api/tasks - List all tasks
- POST /api/tasks - Create new task
- GET /api/tasks/{id} - Get single task
- PUT /api/tasks/{id} - Update task
- DELETE /api/tasks/{id} - Delete task

## Authentication

All protected routes require a JWT token in the Authorization header:
```
Authorization: Bearer <token>
```

Once login you will be see any error just go into the reloate folder (vendor/nesbot/carbon/src/carbon/Traits/Units.php)
and search this line 'self::rawAddUnit' and replace the $value parameter to 60, now you can see login successfull message and the bearer token as well.

## Request Examples

### Register User
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Create Task
```bash
curl -X POST http://localhost:8000/api/tasks \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "New Task",
    "description": "Task Description",
    "status": "pending",
    "due_date": "2024-02-01"
  }'
```

## Code Quality

The project follows PSR-12 coding standards and includes:
- Request validation
- JWT authentication
- Policy-based authorization
- Unit and Feature tests
- Repository pattern
- Comprehensive error handling
```