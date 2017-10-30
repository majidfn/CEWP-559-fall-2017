# PHP / MySQL II #

⚠️ You can read more about the Project [here](PROJECT.md).

Here is the repository for the course `PHP PROGRAMMING WITH MYSQL II (CEWP 559)`. 

## Installation ##

## Docker ##
In this course we will be using `Docker` for setting up our environment. 

To install Docker you can follow the instructions as follow:

- Windows 7 or Windows 10 without virtualization: [Docker toolbox](https://docs.docker.com/toolbox/toolbox_install_windows/)
- Windows 10 with virtualization: [Docker for Windows](https://docs.docker.com/docker-for-windows/)
- Mac OSX: [Docker for Mac](https://docs.docker.com/docker-for-mac/)

After a successful installation of docker, use `bash` or `git bash` (on windows) to go to the root of the project and execute the followings:

```
docker-compose build
docker-compose up
```

After a successful initialization, in your browser you can anvigate to `http://localhost` and you should be able to see the `phpinfo` page. Also navigating to `http://localhost/test_db.php` should give you 2 record that are already in the database. 

If you want to check the execution of docker images inside your system, in a new instance of terminal or git bash, you can execute the following to see what's running:

```
docker ps 
```

and to ssh to the (php) machine:

```
docker ps
docker exec -it 7faf3ec980be /bin/bash
```

`7faf3ec980be` is the ID of the machine retrieved from `docker ps`. Replace it with your own Container ID.

⚠️ In windows you probably need to do the following instead of the above:

```
winpty docker exec -it 7faf3ec980be bash
```


If you want to kill everything and start Fresh?
```
docker-compose down
```

and start from the beginning.


## Vagrant ##

If fo any reason, you have difficulties installing Docker on your machine and get yourself setup, you can fall back to Vagrant. 
You need to install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/) then all you need to run:

```
vagrant up
```
