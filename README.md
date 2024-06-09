# Docker setup

This project is my Docker setup for a typical Laravel project.

The approach for this setup is to have the Docker setup-related files outside the main codebase. This allows me to have a unified Docker setup for all my projects using this main repository. I consider this as my Docker-based development environment. And, this also allows me to have Docker files inside the main source folder which is project-specific and might also go to production.

# The q file

I have a `q` sh file which has some shortcuts for easy use of the docker commands. I used q because this is the most easy to reach character for me and with just that one alphabet, I would be able to get into the commands that the file exposes.

# How to setup a project

## Start with a clean setup - Clone and create new Laravel project

Clone the repository with your project name using the following command

```
git clone https://github.com/amitavroy/docker-setup.git my-blog
```

Once this is done, we will delete the README.md file from inside the `src` directory and using the composer service to create a new Laravel project.

```
rm src/README.md
./q composer create-project laravel/laravel .
```
