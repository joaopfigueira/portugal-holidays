<?php

use Holidays\Holidays;
use Holidays\Clients\Json;
use Holidays\Clients\Http;
use Holidays\Handlers\Xml;
use PHPUnit\Framework\TestCase;

class ClientJsonTest extends TestCase
{
    public function yearsProvider()
    {
        return [
            [1970]
        ];
    }

    /**
     * @dataProvider yearsProvider
     */
    public function testCanCreateAYearFile($year)
    {
        $xmlHandler = new Xml;
        $client     = new Json;
        $httpClient = new Http;

        $handler = $this->getMockBuilder('Holidays\Handlers\HandlerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $holidays = new Holidays($client, $handler);

        $holidays->getClient()->buildFromHttp($httpClient, $xmlHandler, $year);

        $filename = __DIR__.'/../src/Clients/years/'.$year.'.json';

        $yearFile = file_get_contents($filename);

        $this->assertTrue(gettype($yearFile) === 'string');
    }
}
