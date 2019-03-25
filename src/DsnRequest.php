<?php

declare(strict_types=1);

namespace Bdf\Dsn;

/**
 * DsnRequest
 */
final class DsnRequest
{
    /**
     * The request uri
     *
     * @var string
     */
    private $url;

    /**
     * The protocol to use
     *
     * @var string
     */
    private $scheme;

    /**
     * Host specification
     *
     * @var string|null
     */
    private $host;

    /**
     * Port specification
     *
     * @var string|null
     */
    private $port;

    /**
     * User name for login
     *
     * @var string|null
     */
    private $user;

    /**
     * Password for login
     *
     * @var string|null
     */
    private $password;

    /**
     * Path info from the dsn
     *
     * @var string|null
     */
    private $path;

    /**
     * The query bag
     *
     * @var array
     */
    private $query = [];


    /**
     * DsnRequest constructor.
     *
     * @param string $url
     * @param string $scheme
     */
    public function __construct(string $url, string $scheme)
    {
        $this->url = $url;
        $this->scheme = $scheme;
    }

    /**
     * Gets the request url
     *
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Gets the scheme part
     *
     * @return null|string
     */
    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    /**
     * Gets the host part
     *
     * @return null|string
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * Sets the host part
     *
     * @param string $host
     *
     * @return $this
     */
    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Gets the port part
     *
     * @return null|string
     */
    public function getPort(): ?string
    {
        return $this->port;
    }

    /**
     * Sets the port part
     *
     * @param string $port
     *
     * @return $this
     */
    public function setPort(string $port): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Gets the user part
     *
     * @return null|string
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * Sets the user part
     *
     * @param string $user
     *
     * @return $this
     */
    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Gets the password part
     *
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets the password part
     *
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the path part
     *
     * @return null|string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Sets the path part
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Gets the query part
     *
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * Sets the query part
     *
     * @param array $query
     *
     * @return $this
     */
    public function setQuery(array $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Sets the query part
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function query(string $key, $default = null)
    {
        return $this->query[$key] ?? $default;
    }

    /**
     * Gets array representation
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'scheme' => $this->scheme,
            'host' => $this->host,
            'port' => $this->port,
            'user' => $this->user,
            'password' => $this->password,
            'path' => $this->path,
            'query' => $this->query,
        ];
    }
}