Description:
    This is a simple RESTful API for a blog application built with Laravel. It supports user authentication, CRUD operations for posts and comments, and returns data in JSON format.

Prerequisites
    Before you begin, ensure you have met the following requirements:
    -PHP >= 8.0
    -Composer
    -Laravel 9.x
    -MySQL or any other supported database
    -Node.js and npm (for frontend development, if applicable)

Installation
1-Clone the repository
2-Install dependencies
3-Set up the environment file: Copy the .env.example file to .env
4-Generate the application key
5-Set up the database(DB name is technicaltask)
6-Run migrations

Configuration
    For Laravel Sanctum for API authentication, run the following command to publish the Sanctum configuration:php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
