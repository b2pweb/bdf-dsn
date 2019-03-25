<?php

namespace Bdf\Dsn;

use Bdf\Dsn\Exception\InvalidFormatException;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class DsnTest extends TestCase
{
    /**
     *
     */
    public function test_simplest_dsn()
    {
        $request = Dsn::parse('mysql');

        $this->assertSame('mysql', $request->getScheme());
    }

    /**
     * 
     */
    public function test_basic()
    {
        $request = Dsn::parse('mysql://john:doe@localhost/bus');

        $this->assertSame('mysql://john:doe@localhost/bus', $request->getUrl());
        $this->assertSame('mysql', $request->getScheme());
        $this->assertSame('john', $request->getUser());
        $this->assertSame('doe', $request->getPassword());
        $this->assertSame('localhost', $request->getHost());
        $this->assertSame('/bus', $request->getPath());
    }

    /**
     *
     */
    public function test_sqlite()
    {
        $request = Dsn::parse('sqlite::memory:');

        $this->assertSame('sqlite', $request->getScheme());
        $this->assertSame(':memory:', $request->getPath());
        $this->assertNull($request->getUser());
        $this->assertNull($request->getPassword());
        $this->assertNull($request->getHost());
    }

    /**
     *
     */
    public function test_sqlite_file()
    {
        $request = Dsn::parse('sqlite:/path/file.db');

        $this->assertSame('sqlite', $request->getScheme());
        $this->assertSame('/path/file.db', $request->getPath());
    }

    /**
     *
     */
    public function test_params()
    {
        $request = Dsn::parse('mysql://john:doe@localhost/bus?param1=value1&param2=value2');

        $this->assertSame('value1', $request->query('param1'));
        $this->assertSame('value2', $request->query('param2'));
    }

    /**
     *
     */
    public function test_full_request()
    {
        $request = Dsn::parse('mysql://john:Kk%26k%2a2%23Q@localhost.acme.com:25/bus?param1=value%231&param2=value%232');

        $this->assertSame('mysql', $request->getScheme());
        $this->assertSame('john', $request->getUser());
        $this->assertSame('Kk&k*2#Q', $request->getPassword());
        $this->assertSame('localhost.acme.com', $request->getHost());
        $this->assertSame('25', $request->getPort());
        $this->assertSame('/bus', $request->getPath());
        $this->assertSame('value#1', $request->query('param1'));
        $this->assertSame('value#2', $request->query('param2'));
    }

    /**
     *
     */
    public function test_array_params()
    {
        $request = Dsn::parse('mysql://localhost/bus?param%5bfoo%5d=value1&param%5bbar%5d=value2');

        $this->assertSame(['foo' => 'value1', 'bar' => 'value2'], $request->query('param'));
    }

    /**
     *
     */
    public function test_pdo_format()
    {
        $request = Dsn::parse('mysql:mysql_socket=/path/file;dbname=bus');

        $this->assertSame('mysql', $request->getScheme());
        $this->assertSame('bus', $request->query('dbname'));
        $this->assertSame('/path/file', $request->query('mysql_socket'));
        $this->assertNull($request->getPath());
    }

    /**
     *
     */
    public function test_multi_servers()
    {
        $request = Dsn::parse('mysql://127.0.0.1,127.0.0.2/bus');

        $this->assertSame('127.0.0.1,127.0.0.2', $request->getHost());
        $this->assertSame('/bus', $request->getPath());
    }

    /**
     *
     */
    public function test_invalid_dsn()
    {
        $this->expectException(InvalidFormatException::class);

        Dsn::parse('mysql:///');
    }

    /**
     *
     */
    public function test_shards()
    {
        $request = Dsn::parse('mysqli://192.168.0.151/B2P_SEARCH_OFFER?shards[shard1][host]=192.168.0.151&shards[shard2][host]=192.168.0.152');

        $shards = [
            'shard1' => ['host' => '192.168.0.151'],
            'shard2' => ['host' => '192.168.0.152'],
        ];

        $this->assertSame($shards, $request->query('shards'));
    }
}