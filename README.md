## Prerequisites
You must have installed on your computer:
 - [git](https://git-scm.com/downloads)
 - [docker](https://www.docker.com/get-started)
 - [docker-compose](https://docs.docker.com/compose/install/)

## Installation
Open the terminal of your preference

### Clone repository
    git clone https://github.com/joaorezends/phpchallenge.git
    
### Enter in project folder
    cd phpchallenge
    
### Create file environment
    cp .env.example .env

### Set up docker image
    docker-compose up --build

### Tcharamm!
You now have access by [http://localhost:8000/](http://localhost:8000/)

## Tests
Open the terminal of your preference

### Enter in laravel docker image
    docker exec -it laravel /bin/bash

### Write app key inside testing environment
    php artisan key:generate --env=testing

### Exec migrations
    php artisan migrate --path=app/Infrastructure/Migrations --env=testing
    
### Run tests
    php artisan test

## Notes
Consider the possibility of having to run the commands under the root user if linux environment.