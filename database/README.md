# Databse files #

This folder includes the database schemas updates. 
We use incremental versioning for any changes to the database. 

Please note that because we are using Docker, this folder is automatically get executed and inserted in to the databse because we have the mapping in the following configuration in our `docker-sompose.yaml` file:

```
  volumes: 
    - ./database:/docker-entrypoint-initdb.d
```

In an actual database we have to manually run these files in the same incremental order.