# Docker setup

This project is my Docker setup for a typical Laravel project.

We can copy all the files directly inside the root of the Laravel codebase.

The docker folder has configurations and data folder for all the services that I am using.

The docker-compose.yml file as all the service definitions.

## How to install composer dependencies

The composer container is in stopped state by default. To run any composer command including composer install we can do the following:

```
docker-compose run composer install
```
