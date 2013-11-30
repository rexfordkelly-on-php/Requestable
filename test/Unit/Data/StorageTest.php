<?php

namespace RequestableTest\Unit\Data;

use Requestable\Data\Storage;

class StorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Requestable\Data\Storage::__construct
     */
    public function testConstructCorrectInterface()
    {
        $storage = new Storage([]);

        $this->assertInstanceOf('\\Requestable\\Data\\Request', $storage);
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     */
    public function testConstructCorrectInstance()
    {
        $storage = new Storage([]);

        $this->assertInstanceOf('\\Requestable\\Data\\Storage', $storage);
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::getUri
     */
    public function testGetUri()
    {
        $storage = new Storage([['uri' => 'foo']]);

        $this->assertSame('foo', $storage->getUri());
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::getMethod
     */
    public function testGetMethodCustom()
    {
        $storage = new Storage([['method' => 'custommethod']]);

        $this->assertSame('CUSTOMMETHOD', $storage->getMethod());
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::redirectsEnabled
     */
    public function testRedirectsEnabledTrue()
    {
        $storage = new Storage([['follow' => true]]);

        $this->assertTrue($storage->redirectsEnabled());
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::redirectsEnabled
     */
    public function testRedirectsEnabledFalse()
    {
        $storage = new Storage([['follow' => false]]);

        $this->assertFalse($storage->redirectsEnabled());
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::cookiesEnabled
     */
    public function testCookiesEnabledTrue()
    {
        $storage = new Storage([['cookies' => true]]);

        $this->assertTrue($storage->cookiesEnabled());
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::cookiesEnabled
     */
    public function testCookiesEnabledFalse()
    {
        $storage = new Storage([['cookies' => false]]);

        $this->assertFalse($storage->cookiesEnabled());
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::getHeaders
     */
    public function testGetHeadersEmpty()
    {
        $storage = new Storage([['header' => null]]);

        $this->assertSame([], $storage->getHeaders());
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::getHeaders
     */
    public function testGetHeadersFilled()
    {
        $storage = new Storage([
            ['header' => 'Header1: 1'],
            ['header' => 'Header2: 2'],
            ['header' => 'connection: close'],
        ]);

        $headers = $storage->getHeaders();

        $this->assertSame(3, count($headers));
        $this->assertSame(['1'], $headers['header1']);
        $this->assertSame(['2'], $headers['header2']);
        $this->assertTrue(isset($headers['connection']));
    }

    /**
     * @covers Requestable\Data\Storage::__construct
     * @covers Requestable\Data\Storage::getBody
     */
    public function testBody()
    {
        $storage = new Storage([['body' => 'foo']]);

        $this->assertSame('foo', $storage->getBody());
    }
}