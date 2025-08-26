<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');

include("helper.php");
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include("../../connect.php");

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        if ($id != "") {
            $read = $connect->query(query: "SELECT * FROM film WHERE id = '$id'");
            $user = $read->fetch_assoc();

            if($user){
                $input = json_decode(file_get_contents("php://input"));

                $film = $input->film;
                $sinopsis = $input->sinopsis;
                $tahun_rilis = $input->tahun_rilis;

                if($name == "" || $sinopsis == "" || $tahun_rilis == "") {
                    $array_api = response_json(status: 400, message: "Harus diisi");
                }
                else {
                    $update = $connect->query(query: "UPDATE film SET judul = '$judul', sinopsis = '$sinopsis', tahun_rilis = '$tahun_rilis' WHERE id = '$id'");

                    $array_api = response_json(status: 200, message: "Data berhasil diupdate");
                }
            }
            else {
                $array_api = response_json(status: 404, message: "Data tidak ditemukan");
            }
        }
        else {
            $array_api = response_json(status: 400, message: "ID tidak boleh kosong");
        }
    }
    else {
        $array_api = response_json(status: 400, message: "ID tidak diberikan");
    }
} else {
    $array_api = response_json(status: 405, message: "Method Not Allowed");
}

echo json_encode($array_api);

?>