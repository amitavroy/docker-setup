# Docker setup

This project is my Docker setup for a typical Laravel project.

However, this setup can be used for other kind of applications as well.

To work with this setup, do the following:

```
mkdir src data
docker-composer up -d
```

We will need the ```src``` folder to host the code. By default, ```nginx``` is configured to point to ```src/public``` folder because Laravel's index.php file is present in that folder.
