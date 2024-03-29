<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Collect\Collect;

class CollectTest extends TestCase
{
    private $collection;

    protected function setUp(): void
    {
        $this->collection = new Collect([
            'id' => 2135,
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    public function testGetMethod()
    {
        $this->assertEquals('John', $this->collection->get('first_name')); // сравнение значения по ключу
        $this->assertEquals($this->collection->toArray(), $this->collection->get()); // сравнение всего массива
    }

    public function testExceptMethod() //удаляет по ключу
    {
        $result = $this->collection->except(['id', 'first_name']);
        $this->assertInstanceOf(Collect::class, $result);
        $this->assertEquals(['last_name' => 'Doe'], $result->toArray());
    }

    public function testOnlyMethod() //оставляет элементы по ключу
    {
        $result = $this->collection->only(['first_name', 'last_name']);
        $this->assertInstanceOf(Collect::class, $result);
        $this->assertEquals(['first_name' => 'John', 'last_name' => 'Doe'], $result->toArray());
    }

    public function testFirstMethod()
    {
        $result = $this->collection->first(['first_name' => 'John', 'last_name' => 'Doe']);
        $this->assertEquals($result, $this->collection->first());
    }

    public function testCountMethod()
    {
        $this->assertEquals(3, $this->collection->count());
    }

    public function testToArrayMethod()
    {
        $this->assertEquals([
            'id' => 2135,
            'first_name' => 'John',
            'last_name' => 'Doe',
        ], $this->collection->toArray());
    }

    public function testPushMethod() //добавляет новый элемент в конец
    {
        $this->collection->push('new_value', 'new_key');
        $this->assertEquals('new_value', $this->collection->get('new_key'));
    }

    public function testUnshiftMethod() //доб в нач
    {
        $this->collection->unshift('new_value');
        $this->assertEquals('new_value', $this->collection->first());
    }

    public function testShiftMethod()//удл перв элм
    {
        $this->collection->shift();
        $this->assertEquals(['first_name' => 'John', 'last_name' => 'Doe'], $this->collection->toArray());
    }

    public function testPopMethod()//удл в конц
    {
        $this->collection->pop();
        $this->assertEquals(['id' => 2135, 'first_name' => 'John'], $this->collection->toArray());
    }

    public function testKeysMethod()
    {
        $keys = $this->collection->keys();
        $this->assertInstanceOf(Collect::class, $keys);
        $this->assertEquals(['id', 'first_name', 'last_name'], $keys->toArray());
    }
}