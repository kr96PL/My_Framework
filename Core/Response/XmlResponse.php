<?php 

declare(strict_types = 1);

namespace Framework\Core\Response;

use Framework\Core\Interfaces\ResponseInterface;

class XmlResponse implements ResponseInterface
{
    public function return(array $data)
    {
        $xml = $this->arrayToXml($data[0]);
        header('Content-Type: text/xml');
        return $xml;
    }

    private function arrayToXml(array $data, string $root = 'root') 
    {
        $content = "<$root>";
        foreach ($data as $key => $value)
        {
            if (is_array($value)) {
                $content .= $this->arrayToXml($value, $key);
            } else {
                $content .= is_numeric($key) ? "<$value></$value>" : "<$key>$value</$key>";
            }
        }
        $content .= "</$root>";
        return $content;
    }
}