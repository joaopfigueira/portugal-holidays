<?php

namespace Holidays\Handlers;

use SimpleXMLElement;

class Xml implements HandlerInterface
{
    /**
     * parses the input string and returns a php array
     *
     * @param string holiday data
     * @return array
     */
    public function parse(string $xml): array
    {
        $year = new SimpleXMLElement($xml);

        $result = [];
        foreach ($year->GetNationalHolidaysResult->Holiday as $holiday) {
            $result[] = [
                'date'        => (string) $holiday->Date,
                'name'        => (string) $holiday->Name,
                'description' => (string) $holiday->Description,
                'type'        => (string) $holiday->Type
            ];
        }

        return $result;
    }

}
