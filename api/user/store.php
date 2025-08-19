<?php
header('Content-Type: application/json');
include("helper.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../../connect.php");
    $input = json_decode(file_get_contents("php://input"));

    
    $judul = $input->judul;
    $sinopsis = $input->sinopsis;
    $tahun_rilis = $input->tahun_rilis;
    

    if ($judul == "" || $sinopsis == "" || $tahun_rilis == "") {
         $array_api = response_json(400, "Harus diisi");
    }
    else {
        $store = $connect->query("INSERT INTO film (judul, sinopsis, tahun_rilis) VALUES ('$judul', '$sinopsis', '$tahun_rilis')");

        $array_api = response_json(200, "Data berhasil disimpan");
    }
    
} else {
    $array_api = response_json(405, "Method Not Allowed");
}

echo json_encode($array_api);

?>
