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

Once this is done, we need to delete the README.md file from inside the `src` directory and using the composer service to create a new Laravel project. We have a script which will do this for you.

Here is what the script will do:
1. remove the README file
1. create a new laravel project
1. initialise git on that project
1. make your first commit as well

```
./q crp # This will create the project
```

## The vite configuration

This project keeps a node container up with `npm run dev` command. This means any changes that you do to the CSS or JS file would automatically reflect through vite.
However, for this to happen, you have to make a small change to your `vite` config.

Add this after the `plugins` array.

```
server: {
    hmr: {
        host: 'localhost', port: 5173
    },
    host: '0.0.0.0',
    port: 5173,
}
```
