<?php

namespace Xi\Netvisor\Resource\Xml\Component;

use Xi\Netvisor\Resource\Xml\Component\AttributeElement;

class AttributeElementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testConstructor()
    {
        $value = 'Test value';
        $attributes = [
            'Test' => 'Attribute'
        ];

        $attributeElement = new AttributeElement(
            $value,
            $attributes
        );

        $this->assertSame($value, $attributeElement->getValue());
        $this->assertSame($attributes, $attributeElement->getAttributes());
    }

    /**
     * @test
     */
    public function testSetAttribute()
    {
        $key = 'test';
        $attribute = 'First Attribute';

        $attributeElement = new AttributeElement('', [$key => $attribute]);
        $this->assertSame($attribute, $attributeElement->getAttributes()[$key]);

        $attribute = 'Second Attribute';
        $attributeElement->setAttribute($key, $attribute);
        $this->assertSame($attribute, $attributeElement->getAttributes()[$key]);
    }
}
