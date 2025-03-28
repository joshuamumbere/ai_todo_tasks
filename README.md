# Task Manager

A simple task management application where you can create tasks, assign priorities, set due dates, and mark tasks as completed. The application also integrates with OpenAI's API to suggest a priority based on the task description.

## Features

- **Create tasks** with a title, description, priority, and due date.
- **View tasks** ordered by priority.
- **Mark tasks as completed**.
- **Suggest task priority** using OpenAI’s API based on the task description.
- **Responsive UI** built with Laravel and Livewire.

## Installation

Follow these steps to get the project up and running on your local machine:

### 1. Clone the repository

```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager
```

### 2. Install dependencies

Install the required dependencies using Composer and npm.

```bash
composer install
npm install
```

### 3. Set Up your environment
```bash
cp .env.example .env
```
Add your OPENAPI_KEY = youe_api_key to the .env file

### 4. Run the migrations
```bash
php artisan migrate
```

### 5. Serve the application
```bash
php artisan serve
```
Visit http://localhost:8000 in your browser to use the application.



