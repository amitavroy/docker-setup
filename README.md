# Docker setup

This project is my Docker setup for a typical Laravel project.

However, this setup can be used for other kind of applications as well.

To work with this setup, do the following:

```
mkdir src data
docker-composer up -d
```

Because `nginx` depends on other serivces like `php` and `database`, you can also run the following to spin up the entire docker containers:

```
docker-compose up nginx
```

The setup assumes that the entire project codebase is inside folders. For example, the Laravel codebase will be inside the `src` folder. All Docker files will be one level above the Laravel codebase.

We will need the `src` folder to host the code. By default, `nginx` is configured to point to `src/public` folder because Laravel's index.php file is present in that folder.

## What does this project give out of the box

This project right now gives the following pre-configured containers to work with:

1. nginx - the web server
2. php 8.2
3. mysql - database
4. adminer - standalone app to view database
5. composer - yes, you get composer as a container rather than inside php container
