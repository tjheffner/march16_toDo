<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Category.php";

$DB = new PDO ('pgsql:host=localhost;dbname=to_do_test');

class CategoryTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Category::deleteAll();
    }

    function test_getName()
    {
        //Arrange
        $name = "Work stuff";
        $id = null;
        $test_Category = new Category($name, $id);

        //Act
        $result = $test_Category->getName();

        //Assert
        $this->assertEquals($name, $result);
    }

    function test_getId()
    {
        //Arrange
        $name = "Work stuff";
        $id = 1;
        $test_Category = new Category($name, $id);

        //Act
        $result = $test_Category->getId();

        //Assert
        $this->assertEquals(1, $result);

    }

    function test_setId()
    {
        //Arrange
        $name = "Home stuff";
        $id = null;
        $test_Category = new Category($name, $id);

        //Act
        $test_Category->setId(2);

        //Assert
        $result = $test_Category->getId();
        $this->assertEquals(2, $result);
    }

    function test_save()
    {
        //Arrange
        $name = "Work stuff";
        $id = null;
        $test_Category = new Category($name, $id);
        $test_Category->save();

        //Act
        $result = Category::getAll();

        //Assert
        $this->assertEquals($test_Category, $result[0]);
    }

    function test_getAll()
    {
        //Arrange
        $name = "Work stuff";
        $id = null;
        $name2 = "Home stuff";
        $id2 = null;
        $test_Category = new Category($name, $id);
        $test_Category->save();
        $test_Category2 = new Category($name2, $id2);
        $test_Category2->save();

        //Act
        $result = Category::getAll();

        //Assert
        $this->assertEquals([$test_Category, $test_Category], $result);
    }

    function test_deleteAll()
    {
        //Arrange
        $new = "Wash the dog";
        $id = null;
        $name2 = "Home stuff";
        $id2 = null;
        $test_Category = new Category($name, $id);
        $test_Category->save();
        $test_Category2 = new Category($name2, $id2);
        $test_Category->save();

        //Act
        Category::deleteAll();
        $result = Category::getAll();

        //Assert
        $this->assertEquals([], $result);
    }

    function test_find()
    {
        //Arrange
        $name = "Wash the dog";
        $id = 1;
        $name2 = "Home stuff";
        $id2 = 2;
        $test_Category = new Category($name, $id);
        $test_Category->save();
        $test_Category2 = new Category($name2, $id2);
        $test_Category2->save();

        //Act
        $result = Category::find($test_Category->getId());

        //Assert
        $this->assertEquals($test_Category, $result);
    }
}


?>
