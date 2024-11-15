# Task Management System

This is a simple **Laravel-based Task Management System** that allows users to manage tasks by creating, updating, assigning, and filtering tasks based on criteria like status, priority, and assignee. This project demonstrates essential backend development principles, including authentication, database management, caching, and the repository pattern.

---

## Features

- **User Authentication**: Allows users to log in and log out securely.
- **Task Creation and Management**: Create, update, and delete tasks with fields like title, description, due date, and status.
- **Task Assignment**: Assign tasks to other users for collaboration.
- **Comments**: Add comments to tasks for effective communication.
- **Dashboard with Filters**: View tasks with filter and pagination options.
- **Search and Filter**: Search and filter tasks by status, priority, and assignee.
- **Caching**: Cached responses for task lists to improve performance.
- **API Standard Response Trait**: Consistent JSON response structure across all API endpoints.

---

## Installation

1. **Clone the repository**:

   ```
   git clone https://github.com/Alaa2518/Simple-Task-Management-System.git
   cd Task-Management-System

## Installation

1. **Install dependencies**:

   ```
   composer install

2. **Set up environment variables**:

    ```Copy the .env.example file to .env and configure your database and cache settings:
    cp .env.example .env
    Generate application key:


    php artisan key:generate
    Run migrations:


    php artisan migrate
    Run seeders (optional, if provided):


    php artisan db:seed
    Install Laravel Sanctum for API token authentication:

    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    php artisan migrate
    Start the application:

    php artisan serve
### API Endpoints
1. **Authentication**
    ```Login: POST /api/login

    Request Body:

    {
    "email": "user@example.com",
    "password": "password"
    }
    Response: Returns a user token on successful authentication.

    ```Logout: POST /api/logout

    Authorization: Bearer {token}
2. **Task Management**
    ```Create Task: POST /api/tasks

    Request Body:


    {
    "title": "Task Title",
    "description": "Task description",
    "due_date": "YYYY-MM-DD",
    "status": "open"
    }
    ```Update Task: PUT /api/tasks/{task_id}

    Request Body:

    {
    "title": "Updated Title",
    "description": "Updated description",
    "due_date": "YYYY-MM-DD",
    "status": "completed"
    }
    ```Delete Task: DELETE /api/tasks/{task_id}

    ```Assign Task: POST /api/tasks/{task_id}/assign

    Request Body:
    {
    "user_ids": [1, 2, 3]
    }
    ```Comment on Task: POST /api/tasks/{task_id}/comments

    Request Body:


    {
    "content": "This is a comment."
    }
3. **Dashboard and Filters**
    ```Dashboard: GET /api/dashboard

    Query Parameters (optional):

    lua

    status, priority, assignee_id, tasks_per_page
    Example:

    lua

    /api/dashboard?status=open&priority=high&assignee_id=2&tasks_per_page=15
    Get Users: GET /api/users

    Response:
    {
    "id": 1,
    "name": "User Name"
}
### Project Structure
Repositories: Handle data retrieval logic, separating it from controllers for better code reusability.
ApiResponseTrait: Provides consistent success and error response formats across the API.
Caching: Caches responses for dashboard queries to reduce database load.
Tech Stack
Backend Framework: Laravel
Authentication: Laravel Sanctum
Database: MySQL (or other supported databases)
Caching: Laravel Cache (configurable to use Redis, Memcached, etc.)
markdown


### Changes Made:
1. **Code blocks for commands** (e.g., ``, `json`).
2. Used proper indentation and formatting for consistency.
3. Added separators (`---`) for better visual distinction between sections.
4. Applied Markdown headings and bullet points properly. 

Let me know if additional modifications are needed!

### Key Improvements:
1. Structured headings and subheadings for readability.
2. Used code blocks for commands, JSON payloads, and examples.
3. Highlighted features and steps for easy navigation.
4. Ensured consistent formatting throughout the document.

Feel free to customize further based on specific needs!
