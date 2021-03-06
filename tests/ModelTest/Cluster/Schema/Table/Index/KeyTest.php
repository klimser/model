<?php

namespace ModelTest\Cluster\Schema\Table\Index;
use ModelTest\Cluster\Schema\Table\Index\TestCase as TestCase;

/**
 * @group key
 */
class KeyTest extends TestCase
{
    /**
     * @var \Model\Cluster\Schema\Table
     */
    protected $_table;

    protected function setUp()
    {
        $this->getSchema();
        $this->_table  = self::$_schema->getTable('product');
    }

    protected function tearDown()
    {
        $this->_table  = null;
    }

    public function testGetName()
    {
        $idKey = new \Model\Cluster\Schema\Table\Index\Key('id', array($this->_table->getColumn('id')));

        $this->assertEquals('id', $idKey->getName());
    }

    /**
     * @expectedException Model\Cluster\Schema\Table\Index\Exception\ErrorException
     */
    public function testConstructException()
    {
        $idKey = new \Model\Cluster\Schema\Table\Index\Key('id', array('test'));
    }

    /**
     * @expectedException Model\Cluster\Schema\Table\Index\Exception\ErrorException
     */
    public function testConstructException2()
    {
        $idKey = new \Model\Cluster\Schema\Table\Index\Key('id', array());
    }

    public function testToArray()
    {
        $idKey = new \Model\Cluster\Schema\Table\Index\Key('id', array($this->_table->getColumn('id')));

        $array = $idKey->toArray(false);
        $this->assertArrayNotHasKey('columns', $array);

        $this->assertArrayHasKey('type', $array);
        $this->assertEquals('Model\Cluster\Schema\Table\Index\Key', $array['type']);

        $this->assertArrayHasKey('name', $array);
        $this->assertEquals('id', $array['name']);

        $array = $idKey->toArray();

        $this->assertArrayHasKey('columns', $array);
        $this->assertEquals('id', $array['columns'][0]['column_name']);

    }
}

