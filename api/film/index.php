<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

include("helper.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include("../../connect.php"); 

    $read = $connect->query("SELECT * FROM film");
    $data = $read->fetch_all(MYSQLI_ASSOC);

    $array_api = response_json(200, "Data successfully retrieved", $data);
    } 
    else {
        $array_api = response_json(405, "Method Not Allowed");
    }

    echo json_encode($array_api);
?>