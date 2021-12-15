# dsn
A simple DSN parser

[![Build Status](https://app.travis-ci.com/b2pweb/bdf-dsn.svg?branch=master)](https://app.travis-ci.com/b2pweb/bdf-dsn)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/b2pweb/bdf-dsn/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/b2pweb/bdf-dsn/?branch=master)
[![Packagist Version](https://img.shields.io/packagist/v/b2pweb/bdf-dsn.svg)](https://packagist.org/packages/b2pweb/bdf-dsn)
[![Total Downloads](https://img.shields.io/packagist/dt/b2pweb/bdf-dsn.svg)](https://packagist.org/packages/b2pweb/bdf-dsn)


## Install via composer
```bash
$ composer require b2pweb/bdf-dsn
```


## Usage Instructions

A basic use of DSN.

```PHP
<?php
$request = \Bdf\Dsn\Dsn::parse('mysql://john:doe@localhost/testdb?timeout=3');

var_dump($request->toArray());
```

Supports pdo dsn

```PHP
<?php
$request = \Bdf\Dsn\Dsn::parse('mysql:host=localhost;dbname=testdb;timeout=3');

var_dump($request->toArray());
```


## License

Distributed under the terms of the MIT license.
