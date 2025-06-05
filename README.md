
# To-Do List App

This is a simple To-Do List application built using **Laravel 11.3** and **PHP 8.3**. The app provides basic functionality for users to manage their tasks, including task creation, listing, marking tasks as completed, and deletion. Authentication and authorization are implemented to ensure that each user can manage only their own tasks.

---


## Features

The To-Do List App includes the following features:

- **User Authentication**: Basic user registration and login functionalities (if using Laravel Breeze or Jetstream, these will be pre-configured).
- **Task Management**:
  - **Create Tasks**: Users can add new tasks with a title and description.
  - **List Tasks**: Users can view a list of all their tasks.
  - **Mark Task Completion**: Users can mark tasks as completed.
  - **Delete Tasks**: Users can remove tasks.
- **Validation**: Ensures tasks have valid titles and descriptions.
- **Data Persistence**: Tasks and user information are stored in a MySQL or SQLite database.
- **Secure Access**: Basic security measures restrict users to managing only their own tasks.
- **Error Handling**: Errors are handled gracefully with user-friendly messages.
- **Testing**: Unit tests help ensure code reliability.

## Technologies Used

- **Laravel**: Backend framework for routing, authentication, and MVC structure.
- **PHP 8.3**: Server-side scripting language.
- **MySQL / SQLite**: Database for storing user and task information.
- **Blade Templates**: Templating engine for views.
- **Tailwind CSS**: Utility-first CSS framework for styling.
- **Composer**: Dependency manager for PHP.
- **Git**: Version control system.

 Requirements

- PHP 8.3 or higher
- Composer
- MySQL (or SQLite)
- Git

---

## Installation

### 1. Clone the Repository

First, clone the repository from GitHub:

```bash
git clone https://github.com/nacosseruib/todo-list-app-Laravel.git
cd todo-list-app


2. Install Dependencies
Install PHP and JavaScript dependencies:
composer install
npm install


3. Set Up Environment Variables
Create a .env file and set your environment variables by copying the example file:
cp .env.example .env
Open .env and update the following variables as needed:

APP_NAME="To-Do List App"
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password


4. Generate Application Key
Run the following command to generate an application key:
php artisan key:generate

5. Run Migrations and Seeders
Set up the database structure and seed the database with a sample user:
php artisan migrate --seed

Configuration
Make sure the database is running and accessible by Laravel as per your .env configuration.

Usage
Running the Development Server
To start the application on http://localhost:8000, run:

php artisan serve


Accessing the Application
Open a web browser and navigate to http://localhost:8000. Use the seeded user credentials or register a new user to access the app.

Task Management
Once logged in, you can:

Create new tasks.
Mark tasks as complete or delete them.
Only your tasks will be visible to you, ensuring data security.
Additional Features and Notes
Validation and Error Handling: Forms have validation rules, and the app displays informative error messages.
Unit Testing: Tests are set up for key functionality (run with php artisan test).
Security: Basic security measures restrict access to only authorized users' tasks.
Tailwind CSS: Provides a clean and responsive design.


Author
This project was developed by Samson at Dogstar Digital Limited.


Notes
If you are deploying to production, remember to run:
php artisan config:cache
php artisan route:cache
php artisan view:cache
These commands will cache configuration, routes, and views to optimize performance.


Enjoy using the To-Do List App to manage your tasks effectively!

This `README.md` file provides all necessary information for cloning, installing, configuring, and running the To-Do List app. It also includes details about the features and the author's information.
