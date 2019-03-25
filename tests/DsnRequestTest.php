<?php

namespace Bdf\Dsn;

use PHPUnit\Framework\TestCase;

/**
 *
 */
class DsnRequestTest extends TestCase
{
    /**
     *
     */
    public function test_constructor()
    {
        $request = new DsnRequest('url', 'scheme');

        $this->assertSame('url', $request->getUrl());
        $this->assertSame('scheme', $request->getScheme());
        $this->assertNull($request->getHost());
        $this->assertNull($request->getPort());
        $this->assertNull($request->getUser());
        $this->assertNull($request->getPassword());
        $this->assertNull($request->getPath());
        $this->assertSame([], $request->getQuery());
    }

    /**
     *
     */
    public function test_setters_getters()
    {
        $request = new DsnRequest('url', 'scheme');

        $request->setHost('host');
        $this->assertSame('host', $request->getHost());

        $request->setPort('port');
        $this->assertSame('port', $request->getPort());

        $request->setUser('user');
        $this->assertSame('user', $request->getUser());

        $request->setPassword('password');
        $this->assertSame('password', $request->getPassword());

        $request->setPath('path');
        $this->assertSame('path', $request->getPath());

        $request->setQuery(['key' => 'value']);
        $this->assertSame(['key' => 'value'], $request->getQuery());
        $this->assertSame('value', $request->query('key'));
        $this->assertSame('foo', $request->query('unknow', 'foo'));
    }

    /**
     *
     */
    public function test_to_array()
    {
        $request = new DsnRequest('url', 'scheme');

        $request->setHost('host');
        $request->setPort('port');
        $request->setUser('user');
        $request->setPassword('password');
        $request->setPath('path');
        $request->setQuery(['key' => 'value']);

        $expected = [
            'scheme' => 'scheme',
            'host' => 'host',
            'port' => 'port',
            'user' => 'user',
            'password' => 'password',
            'path' => 'path',
            'query' => ['key' => 'value'],
        ];

        $this->assertSame($expected, $request->toArray());
    }
}
