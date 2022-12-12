# PHP-TEST

This project contains a series of php scripts to resolve some challenges. Every challenge starts with the number 01 and 
a brief description of the use case. You can find these scripts in the `/src` directory.

## PHP Cli

All challenge should be executed using the CLI. You can use your local php interpreter `>= 8.0`, or use the *Docker Compose* included in this repository.

## PHP Composer

This project don't require a huge number of dependencies, I tried to build big part of the code from scratch,
but you will run `composer install` to install the dependencies and create the autoload.

If you are using the php interpreter installed in your computer, you should have Composer
[installed](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) in your computer and run:

    composer install

If you are using Docker Compose run:
    
    docker-compose run php composer install

## MySQL Database

As the same way that with the php interpreter, you can use your local MySQL or use the provided version for the
*Docker Compose*.

If you are using the **local database**, you could find the required scripts in the `./db-scripts/` directory.

**DB CONNECTION CONFIG:** If you are using your own DB server instead the *Docker Compose* service,  you must configure 
the connection in the `.env` file with your connection parameters. 

If instead you chose *Docker Compose* simply start the service with:

    docker-compose up db -d

After use, remember to stop to service with:

    docker-compose stop db

## Run the challenges 

If you are using the local interpreter you can run the challengess with:

    php ./src/01-prime-numbers.php
    php ./src/02-ascii-array.php
    php ./src/03-tv-series.php

If you are using docker: 

    docker-compose run php php src/01-prime-numbers.php
    docker-compose run php php src/02-ascii-array.php
    docker-compose run php php src/03-tv-series.php

## Tests

To run the test you can use the composer script, if you are using the local interpreter run:

    php vendor/bin/phpunit

If you are using *Docker Compose*:

    docker-compose run php composer test
