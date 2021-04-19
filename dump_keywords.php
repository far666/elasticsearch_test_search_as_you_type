<?php
include("./vendor/autoload.php");

$es_endpoit = "localhost:9200";
$client = new GuzzleHttp\Client;

$fp = fopen($argv[1], "r"); // a csv file and with one column for keywords
while(!feof($fp)) {
    $data = fgetcsv($fp);
    try {
        $input = array("my_field" => $data[0]);
        $result = $client->post($es_endpoit . "/test_search_as_you_type/_doc", array("json" => $input));
        print_r($result->getBody()->getContents());
    } catch(Exception $e) {
        print_r($e->getMessage());
    }
}

?>
