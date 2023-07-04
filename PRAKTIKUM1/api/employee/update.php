<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/employees.php';
$database = new Database();
$db = $database->getConnection();
$item = new employee($db);
$data = json_decode(file_get_contents("php://input"));
$item->id = $data->id;
// employee values
$item->Nama_Bengkel= $data->Nama_Bengkel;
$item->alamat_Bengkel = $data->alamat_Bengkel;
$item->Undangan_Bengkel = $data->Undangan_Bengkel;
$item->Specialist_Bengkel = $data->Specialist_Bengkel;
$item->created = date('Y-m-d H:i:s');
if($item->updateEmployee()){
echo json_encode(['message'=>" Employee data updated sucesfully."]);
} else{
echo json_encode(['message'=>"Data could not be updated"]);
}
?>