# E-Commerce Website project #

## Items ##

Endpoints:

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