# Portugal Holidays
Lists holidays of Portugal for a given year or a series of years.

## Installation
Install using [Composer](https://getcomposer.org/)
```
$ composer require joaofigueira/portugal-holidays
```

## Usage
### List using internal reference files:
```php
use Holidays\Holidays;
use Holidays\Clients\Json;
use Holidays\Handlers\File;

$client  = new Json;
$handler = new File;

$holidays = new Holidays($client, $handler);

$result = $holidays->get($years)->asArray();
```
### List using external webservice call:
```php
use Holidays\Holidays;
use Holidays\Clients\Http;
use Holidays\Handlers\Xml;

$client  = new Http;
$handler = new Xml;

$holidays = new Holidays($client, $handler);

$result = $holidays->get($years)->asArray();
```

## Contribute
You can clone and contribute to this project.
### Setup local environment:
* make sure you have docker installed in your machine.
* clone the project.
* run setup: `$ ./setup.sh`. You may have to `$ chmod +x setup.sh` to be able to run the script. This will create the docker container and run composer install for you.
* run tests: `$ ./run-tests.sh`.
