<?php

declare(strict_types=1);

namespace Bdf\Dsn;

use Bdf\Dsn\Exception\InvalidFormatException;

/**
 * Dsn
 * 
 * a dsn parser
 */
final class Dsn
{
    /**
     * Returns the Data Source Name as a structure containing the various parts of the DSN.
     *
     * Additional keys can be added by appending a URI query string to the end of the DSN.
     *
     * The allowed formats:
     * <code>
     *  scheme://user:password@host/path?foo=bar
     *  scheme://user:password@host
     *  scheme://user@host
     *  scheme://host/path
     *  scheme://host
     *  scheme:var1=value1;var2=value2
     *  scheme:path
     *  scheme
     * </code>
     *
     * @param string $dsn Data Source Name to be parsed
     *
     * @return DsnRequest
     */
    public static function parse(string $dsn): DsnRequest
    {
        // Only parsing dsn as url
        if (false === strpos($dsn, ':')) {
            return new DsnRequest($dsn, $dsn);
        }

        $url = parse_url($dsn);

        if (false === $url) {
            throw new InvalidFormatException('Invalid DSN.');
        }

        $url = array_map('rawurldecode', $url);

        // Manage the "driver:var1=value1;var2=value2" synthax
        if (isset($url['path']) && !isset($url['query']) && false !== strpos($url['path'], ';')) {
            $url['query'] = str_replace(';', '&', $url['path']);
            unset($url['path']);
        }

        $request = new DsnRequest($dsn, $url['scheme']);

        // Parse the query string as additionnal options
        if (isset($url['query'])) {
            $query = [];
            parse_str($url['query'], $query);

            $request->setQuery($query);
        }

        if (isset($url['host'])) {
            $request->setHost($url['host']);
        }
        if (isset($url['port'])) {
            $request->setPort($url['port']);
        }
        if (isset($url['user'])) {
            $request->setUser($url['user']);
        }
        if (isset($url['pass'])) {
            $request->setPassword($url['pass']);
        }
        if (isset($url['path'])) {
            $request->setPath($url['path']);
        }

        return $request;
    }
}
