<?php

use Holidays\Holidays;
use Holidays\Clients\Http;
use Holidays\Clients\Json;
use Holidays\Handlers\Xml;
use Holidays\Handlers\File;
use PHPUnit\Framework\TestCase;


class HolidaysTest extends TestCase
{
    /**
     * @var ClientInterface
     */
    private $mockClient;

    /**
     * @var HandlerInterface
     */
    private $mockHandler;

    public function setUp(): void
    {
        $this->mockClient = $this->getMockBuilder('Holidays\Clients\ClientInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockHandler = $this->getMockBuilder('Holidays\Handlers\HandlerInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function yearsProvider()
    {
        return [
            [[2020,2021]]
        ];
    }

    /**
     * @dataProvider yearsProvider
     *
     * @covers \Holidays\Holidays::__construct
     * @covers \Holidays\Holidays::get
     * @covers \Holidays\Holidays::asArray
     */
    public function testGetAsArrayReturnsArray(array $years): void
    {
        $holidays = new Holidays($this->mockClient, $this->mockHandler);

        $result = $holidays->get($years)->asArray();

        $this->assertTrue(gettype($result) === 'array');
    }

    /**
     * @dataProvider yearsProvider
     *
     * @covers \Holidays\Holidays::__construct
     * @covers \Holidays\Holidays::get
     * @covers \Holidays\Holidays::asJson
     */
    public function testGetAsJsonReturnsString(array $years): void
    {
        $holidays = new Holidays($this->mockClient, $this->mockHandler);

        $result = $holidays->get($years)->asJson();

        $this->assertTrue(gettype($result) === 'string');
    }

    /**
     * @dataProvider yearsProvider
     *
     * @covers \Holidays\Holidays::__construct
     * @covers \Holidays\Holidays::get
     * @covers \Holidays\Holidays::asCsv
     */
    public function testGetAsCsvReturnsString(array $years): void
    {
        $holidays = new Holidays($this->mockClient, $this->mockHandler);

        $result = $holidays->get([])->asCsv();

        $this->assertTrue(gettype($result) === 'string');
    }

    /**
     * @dataProvider yearsProvider
     *
     * @covers \Holidays\Clients\Json::__construct
     * @covers \Holidays\Clients\Json::fetch
     * @covers \Holidays\Handlers\File::parse
     * @covers \Holidays\Holidays::__construct
     * @covers \Holidays\Holidays::asArray
     * @covers \Holidays\Holidays::get
     */
    public function testLiveFromJsonFile(array $years): void
    {
        $client  = new Json;
        $handler = new File;

        $holidays = new Holidays($client, $handler);

        $result = $holidays->get($years)->asArray();

        $this->assertTrue(gettype($result) === 'array');
    }
}
