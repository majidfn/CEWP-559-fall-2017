# E-Commerce Website project #

## Items ##

Endpoints:
# E-Commerce project #

To evaluate students based on the materials we have learnded during this class, a final E-Commrce project is defined. The whole functioning project is defined as the deliverables for the project. 

The final project should have the following sections:

- Products Catalog / Single Product view
- Categories
- Reviews
- Orders and History
- Shopping Cart with ability to restore
- User management and Authentication
- Search
- Administration
    - New Item
    - New Category
- Front-End: Is described below

## Front-End ##

The front end of the application could be eaither of the following choices:

### 1 - Single Page Application & RESTful APIs ###

You can use the modern approach of making web sites and create a front-end which communicates with the back-end using the REST APIs.

### 2 - Generated pages using templating ###

You can also follow the traditional approach of building web applications and generate the HTML pages in the back-end. If you follow that approach the HTML pages should follow templating rules.


## RESTful APIs ##

### Get all items ###

```
GET http://localhost/api/items
```

### Get one item by ID ###

```
GET http://localhost/api/items/{{ID}}
```
 where `{{ID}}` should be replaced by ID of the item you want to retrieve. For example:

 ```
 http://localhost/api/items/1
 ```

### Create a new Item ###

To create a new item you have to do an HTTP POST to the following endpoint:

```
POST http://localhost/api/items/
```

and you have to spceify the `body` of the request as:

```
{
    "name": "Sample Book",
    "description": "Sample Book Description",
    "price": 23.45
}
```