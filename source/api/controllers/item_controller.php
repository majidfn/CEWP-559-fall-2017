<?php

class ItemController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->getAll();
    }

    public function getOne($id)
    {
        return $this->model->getOne($id);
    }

    public function create($payload)
    {
        // Validating the data inside the JSON
        // We make sure the `title` and `price` are provided

        if (!array_key_exists('name', $payload)) {
            throw new Exception('`name` should be provided!');
        } elseif (!array_key_exists('price', $payload)) {
            throw new Exception('`price` should be provided!');
        }

        return $this->model->create($payload);
    }

    public function upload($id, $file)
    {
        if ($file['error'] != 0) {
            throw new Exception('Error uploading a file: ' . $file['error'], 400);
        }
        
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileExtension = strtolower($fileExtension);
        
        $validFileExtensions = array('gif', 'jpg', 'png');
        
        if(!in_array($fileExtension, $validFileExtensions)) {
            throw new Exception('Only gif, jpg, png files are accepted!', 400);
        }

        $destination = __DIR__."/../../images/";
        $randomName = uniqid();
        $fileName = "{$randomName}.{$fileExtension}";

        $finalFile = "{$destination}{$fileName}";
        
        if (!is_dir($destination) && !@mkdir($destination, 0755, true)) {
            throw new Exception('Error creating the images folder!', 500);
        }
        
        $success = move_uploaded_file($file['tmp_name'], $finalFile);
        
        if(!$success){
            throw new Exception('Error moving the file to images folder!', 500);
        }

        $this->model->updateImage($id, $fileName);

        return $finalFile;
    }

    /**
     * getAllWithFilters checks for the valid filters and passes them to the Model to retrieve the records based on the filters
     * 
     * categoryid should be an integer value. All the values from $_GET are string we need `intval` function to extract the integer value.
     */
    public function getAllWithFilters($filters) {

        $categoryId = $filters['categoryid'];
        $categoryId = intval($categoryId);

        if ($categoryId == 0) {
            throw new Exception('Invalid categoryid. ', 400);
        }

        return $this->model->getFilteredItems($categoryId);
    }
}
