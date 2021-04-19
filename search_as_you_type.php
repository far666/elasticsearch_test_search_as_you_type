<?php
include("./vendor/autoload.php");

$key = $_GET["key"];
$es_endpoit = "localhost:9200";
$client = new GuzzleHttp\Client;

try {
    $input = array(
        "query" => array(
            "multi_match" => array(
                "query" => $key,
                "type" => "bool_prefix", 
                "fields" => array(
                    "my_field",
                    "my_field._2gram",
                    "my_field._3gram",
                )
            )
        )
    );
    $response = $client->get($es_endpoit . "/test_search_as_you_type/_search", array("json" => $input));
    $data = json_decode($response->getBody()->getContents(), true);
    $search_for = array();
    foreach ($data["hits"]["hits"] as $row) {
        print_r($row["_source"]["my_field"]);
        echo "<br>";
    }
} catch(Exception $e) {
    print_r($e->getMessage());
}

?>
