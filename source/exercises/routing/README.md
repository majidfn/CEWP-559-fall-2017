## Exercises ##

Browse the `ABbout` page using `page=about` query string.

### Exercise - 1 ###

Create `IndexController`, `IndexModel`, `IndexView`. Route user to see the index when there is no page specified. 

### Exercise - 2 ###

Wire the template file inside the `templates` folder to output the results.

### Exercise - 3 ###

Create a new page with all the required classes for `Contact` and the menu option.

### Exercise - 4 ###

We would like to have our URLs instead of `index.php?page=about` to be like `/about`.

Setup the `.htaccess` file according to the README (below)

Parse the Path using `explode('/', $_SERVER['REQUEST_URI'])` and react to the following paths. Use `array_filter` to get rid of empty elements and use `array_values` to get a new re-indexed array.

- /about
- /contact


# Enabling the Rewrite engine in Apache #

## Using DockerFile ##

If you're using the docker container for the Apache, add the following to your configuration file `dockerfile_php_7`:

```
RUN sudo a2enmod rewrite
```

and rebuild the image and run it:

```
docker-compose down
docker-compose build
docker-compose up
```


## Using a2enmod directly in the server ##

In the server running Apache (ssh to the server) run the following:

```
a2enmod rewrite
```

and then restart the Apache with the following:

```
sudo systemctl restart apache2
or
sudo apache2ctl restart
or
/etc/init.d/apache2 restart
```

# Using the .htaccess to rewrite #

Create a `.htaccess` file in the root of your server and paste the following:

```
Options -MultiViews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
```

- *QSA* : Query String Append

