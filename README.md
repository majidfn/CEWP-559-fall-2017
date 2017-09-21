# PHP / MySQL II #

Here is the repository for the course `PHP PROGRAMMING WITH MYSQL II (CEWP 559)`

## Vagrant ##

Based on the template [here](https://github.com/spiritix/vagrant-php7).

```
vagrant up
```

If it's needed to re-provision your machine run:
```
vagrant reload --provision
```

to ssh to the machine:

```
vagrant ssh
```

Need to complete start fresh?
```
vagrant destroy
```


## Docker ##

Based on the template [here](https://github.com/wdekkers/docker-php7-httpd-apache2-mysql)

In Docker Terminal execute the followings:

```
docker-compose build
docker-compose up -d
```

to ssh to the (php) machine:

```
docker ps
docker exec -it 7faf3ec980be /bin/bash
```

`7faf3ec980be` is the ID of the machine retrieved from `docker ps`. Replace it with your own Container ID.

Start Fresh?
```
docker-compose down
```
