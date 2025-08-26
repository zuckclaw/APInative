<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include("../../connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($id != "") {
            $read = $connect->query("SELECT * FROM film WHERE id = '$id'");
            $user = $read->fetch_assoc();

            if ($user) {
                $destroy = $connect->query("DELETE FROM film WHERE id = '$id'");
                $array_api = response_json(200, "Data berhasil dihapus");
            } else {
                $array_api = response_json(404, "Data tidak ditemukan");
            }
        } else {
            $array_api = response_json(400, "ID tidak boleh kosong");
        }
    } else {
        $array_api = response_json(400, "ID harus disertakan");
    }
} else {
    $array_api = response_json(405, "Method Not Allowed");
}

echo json_encode($array_api);

// fungsi bantu response
function response_json($status, $message) {
    return ["status" => $status, "message" => $message];
}
?>
