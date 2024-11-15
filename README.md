Task Management System
This is a simple Laravel-based Task Management System that allows users to manage tasks by creating, updating, assigning, and filtering tasks based on criteria like status, priority, and assignee. This project demonstrates essential backend development principles, including authentication, database management, caching, and the repository pattern.

Features
User Authentication: Allows users to log in and log out.
Task Creation and Management: Users can create, update, and delete tasks with fields like title, description, due date, and status.
Task Assignment: Users can assign tasks to other users.
Comments: Users can add comments to tasks for collaboration.
Dashboard with Filters: Dashboard view shows tasks assigned to or created by the user with filter and pagination options.
Search and Filter: Includes search and filter functionality based on status, priority, and assignee.
Caching: Cached responses for task lists to optimize performance.
API Standard Response Trait: Provides a consistent JSON response structure across all API endpoints.
Installation
Clone the repository:

bash
Copy code
git clone https://github.com/yourusername/task-management-system.git
cd task-management-system
Install dependencies:

bash
Copy code
composer install
Set up environment variables:

Copy the .env.example file to .env and configure your database and cache settings:

bash
Copy code
cp .env.example .env
Generate application key:

bash
Copy code
php artisan key:generate
Run migrations:

bash
Copy code
php artisan migrate
Run seeders (optional, if provided):

bash
Copy code
php artisan db:seed
Install Laravel Sanctum for API token authentication:

bash
Copy code
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
Start the application:

bash
Copy code
php artisan serve
API Endpoints
Authentication
Login: POST /api/login

Request Body:
json
Copy code
{ "email": "user@example.com", "password": "password" }
Response: Returns a user token on successful authentication.
Logout: POST /api/logout

Header: Authorization: Bearer {token}
Task Management
Create Task: POST /api/tasks

Request Body:
json
Copy code
{ "title": "Task Title", "description": "Task description", "due_date": "YYYY-MM-DD", "status": "open" }
Update Task: PUT /api/tasks/{task_id}

Request Body:
json
Copy code
{ "title": "Updated Title", "description": "Updated description", "due_date": "YYYY-MM-DD", "status": "completed" }
Delete Task: DELETE /api/tasks/{task_id}

Assign Task: POST /api/tasks/{task_id}/assign

Request Body:
json
Copy code
{ "user_ids": [1, 2, 3] }
Comment on Task: POST /api/tasks/{task_id}/comments

Request Body:
json
Copy code
{ "content": "This is a comment." }
Dashboard and Filters
Dashboard: GET /api/dashboard

Query Parameters (optional): status, priority, assignee_id, tasks_per_page
Example: /api/dashboard?status=open&priority=high&assignee_id=2&tasks_per_page=15
Get Users: GET /api/users

Response: Returns a list of users with id and name fields for use in task assignment or searching.
Project Structure
Repositories: Repositories handle data retrieval logic, separating it from controllers and promoting code reusability.
ApiResponseTrait: A trait providing consistent success and error response formats across the API.
Caching: Caches responses for dashboard queries to optimize performance and reduce database load.
Tech Stack
Backend Framework: Laravel
Authentication: Laravel Sanctum
Database: MySQL (or other supported databases)
Caching: Laravel Cache (configurable to use Redis, Memcached, etc.)
License
This project is open-source and available under the MIT License.


