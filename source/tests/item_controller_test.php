<?php

use PHPUnit\Framework\TestCase;

require __DIR__.'/../api/controllers/item_controller.php';
require __DIR__.'/../api/models/base_model.php';
require __DIR__.'/../api/models/item_model.php';

final class ItemControllerTest extends TestCase
{
    public function testCreateWithNoPrice(): void
    {
        $controller = new ItemController(null);
        
        $payload = array('name' => 'something');
        
        $this->expectException(Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('`price` should be provided!');
        
        $controller->create($payload);
    }
    
    public function testCreateWithValidData(){
        
        // Setting Up the Mock Object for ItemModel
        $mockModel = $this->createMock(ItemModel::class);
        
        $mockModel->expects($this->once())
                  ->method('create');
        
        $payload = array('name' => 'something', 'price' => 12);
        
        $controller = new ItemController($mockModel);
        $controller->create($payload);
    }


    public function testCreateWithValidDataReturnedValue(){
        
        $expectedDBResponse = new ItemModel(null);
        $expectedDBResponse->name = 'something';
        $expectedDBResponse->price = '12';

        // Setting Up the Mock Object for ItemModel
        $mockModel = $this->createMock(ItemModel::class);
        
        $mockModel->method('create')
                  ->will($this->returnValue($expectedDBResponse));
        
        $payload = array('name' => 'something', 'price' => 12);
        
        $controller = new ItemController($mockModel);
        $retrurnedValue = $controller->create($payload);

        $this->assertEquals($retrurnedValue->name, $expectedDBResponse->name);
        $this->assertEquals($retrurnedValue->price, $expectedDBResponse->price);
    }    


}