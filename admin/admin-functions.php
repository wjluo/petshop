<?php

function generateRawXML($dataset, $dataset2)
{
    $xml = new DOMImplementation;
    $dtd = $xml->createDocumentType('data', '', 'orders_products.dtd');
    $dom = $xml->createDocument('', '', $dtd);

    $rootNode = $dom->appendChild($dom->createElement("data"));

    foreach ($dataset as $order) {
        if (!empty($order)) {
            $itemNode = $rootNode->appendChild($dom->createElement("order"));
            foreach ($order as $key => $value) {
                $itemNode->appendChild($dom->createElement($key, $value));
            }
        }
    }
    foreach ($dataset2 as $popular_product) {
        if (!empty($popular_product)) {
            $itemNode = $rootNode->appendChild($dom->createElement("popular_product"));
            foreach ($popular_product as $key => $value) {
                $itemNode->appendChild($dom->createElement($key, $value));
            }
        }
    }

    $dom->formatOutput = true;
    $dom->encoding = "UTF-8";

    $dom->save("xml/orders_products.xml");
}

function validateXMLwithDTD($xmlFilepath)
{
    $validator = new DOMDocument;
    $validator->load($xmlFilepath);
    return $validator->validate();
}


function styleXMLwithXSL($xmlFilepath, $xlsFilepath)
{
    // Load XML file
    $xml = new DOMDocument;
    $xml->load($xmlFilepath);

    // Load XSL file
    $xsl = new DOMDocument;
    $xsl->load($xlsFilepath);

    // Configure the transformer
    $proc = new XSLTProcessor;

    // Attach the xsl rules
    $proc->importStyleSheet($xsl);

    // Transform XML
    echo $proc->transformToXML($xml);
}

function parseXML($xmlFilepath) {

    if(file_exists($xmlFilepath)) {

        $xml = simplexml_load_file($xmlFilepath);
        
        $data = array();

        $number_of_orders = 0;
        $total_turnover = 0;

        foreach($xml->order as $order) {
            
            $number_of_orders++;            
            $total_turnover += $order->total_cost;
        }

        $data[0] = $number_of_orders;
        $data[1] = $total_turnover;
        
        return $data;
    }

    return null;
}