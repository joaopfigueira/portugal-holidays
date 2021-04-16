<?php

namespace Holidays\Clients;

use Holidays\Handlers\Xml;

class Json implements ClientInterface
{
    /**
     * @var Http
     */
    private $httpClient;

    /**
     * @var string
     */
    private $directory;

    public function __construct()
    {
        $this->directory = __DIR__.'/years';
    }

    /**
     * Returns holidays of a given year as a string
     *
     * @param  int year
     * @return string
     */
    public function fetch(int $year): string
    {
        return file_get_contents($this->directory.'/'.$year.'.json');
    }

    /**
     * Build holidays json file from http client
     *
     * @param Http
     * @param Xml
     * @param int year
     */
    public function buildFromHttp(Http $httpClient, Xml $xmlHandler, int $year)
    {
        $response = $httpClient->fetch($year);
        $parsed   = $xmlHandler->parse($response);
        $filename = $this->directory.'/'.$year.'.json';
        $this->writeFile($filename, json_encode($parsed));

        return $this;
    }

    /**
     * Write holidays tp file
     *
     * @param string filename, including path
     * @param string contents of file, json serialized
     */
    private function writeFile(string $filename, string $contents)
    {
        $yearFile = fopen($filename, "w") or die("Unable to open file!");
        fwrite($yearFile, $contents);
        fclose($yearFile);

        return $this;
    }
}
