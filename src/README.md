This is where the code will come.

We can use the set in two ways

1. Remove this README file and then do composer install

```
docker compose run --rm composer create-project laravel/laravel .
```

2. Git clone or copy your existing codebase inside this folder. To git clone inside this folder

```
git clone https://github.com/amitavdevzone/gitlabmx.git .
```

This will ensure, the code is checkout out inside this folder.

Do note: The PHP container is looking for index.php inside `/var/www/html/public` folder.
