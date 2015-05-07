<?php
/**
 * @author Marco Troisi
 * @created 04.04.15
 */

namespace MicroTranslator\Test;


class BaseTest extends \PHPUnit_Framework_TestCase
{
    public function testHello()
    {
        $var = "Hello World";

        $this->assertEquals($var, "Hello World");
    }
}
