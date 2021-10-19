## Introduction

Building an SSP that lets you create and manage your campaigns. App was built using Laravel and Inertia Vue.

## Requirements

- PHP 7.4 (Optional).
- Composer (Optional).
- MySQL 5.7 (Optional).
- Docker.

## Installation guide using Docker.

- Clone the repository and cd into project
- Run docker-compose up.
- App would be running on 7000.

## Installation guide using Valet or an Apache server.

- Clone the repository.
- CD into project directory
- Run cp .env.example .env
- Run php artisan key: generate
- Run composer install
- Run php artisan migrate
- Run php artisan db:seed
- Run php artisan storage:link
- Run php artisan serve
- App would be running on 8000.

## Login using credentials

- Email: me@biduwe.com
- Password: password

Testing the application in a Docker container
docker exec -it {containerID} bash.
composer test

Testing the application
Follow the default installation guide.
Run composer test.
