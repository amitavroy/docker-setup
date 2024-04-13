# Docker setup

This project is my Docker setup for a typical Laravel project.

We can copy all the files directly inside the root of the Laravel codebase.

The docker folder has configurations and data folder for all the services that I am using.

The docker-compose.yml file as all the service definitions.

## Environment file requirement

This Docker setup allows you to configure ports used by different servers. I have kept most of them to some defaults.
However, you can add these to your .env file and customise.

```
APP_PORT=9001
DB_PORT=3306
NODE_PORT=5173
MAILPIT_WEBUI=8025
MAILPIT_SMTP=1025
MAILPIT_MESSAGES=100
```

## How to install composer dependencies

The composer container is in stopped state by default. To run any composer command including composer install we can do the following:

```
docker-compose run composer install
```
