#! /bin/bash

if [[ "$1" == "test" ]]; then
    shift
    docker compose run --rm php vendor/bin/pest "$@"
elif [[ "$1" == "migrate" ]]; then
    shift
    docker compose run --rm php php artisan migrate "$@"
elif [[ "$1" == "composer" ]]; then
    shift
    docker compose run --rm php composer "$@"
elif [[ "$1" == "php" ]]; then
    shift
    docker compose run --rm php "$@"
elif [[ "$1" == "artisan" ]]; then
    shift
    docker compose run --rm php php artisan "$@"
elif [[ "$1" == "db:reset" ]]; then
    shift
    docker compose run --rm php php artisan migrate:fresh --seed "$@"
elif [[ "$1" == "vite" ]]; then
    shift
    docker compose run --rm vite npm run dev
elif [[ "$1" == "node" ]]; then
    shift
    docker compose run --rm node "$@"
elif [[ "$1" == "ps" ]]; then
    docker ps --format 'table {{.ID}}\t{{.Status}}\t{{.Names}}\t{{.Ports}}'
elif [[ "$1" == "up" ]]; then
    shift
    docker compose --env-file ./src/.env up "$@"
elif [[ "$1" == "down" ]]; then
    docker compose --env-file ./src/.env down --remove-orphans

# Add more elif blocks for other shortcuts
else
    echo "Usage: $0 <command>"
    echo "Available commands:"
    echo "
    ps         show the docker processes
    up         start the compose services
    down         stop the composer services
    composer   run composer commands
    php        run commands inside php container
    artisan    run artisan commands
    db:reset   run artisan migrate command to fresh the DB
    vite       run vite to compile assets
    test       run application tests and reach out to PEST binary
    node       run node container and any command on it
    migrate    run the migrations for the application
    "
fi
