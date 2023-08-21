<?php
header("Content-Type:application/json");

include_once("connectapi.php");
if(!empty($_GET['name'])) {
$name=$_GET['name'];
$items = getItems($name, $conn);
if(empty($items)) {
jsonResponse(200,"Items Not Found",NULL);
} else {
jsonResponse(200,"Item Found",$items);
}
} else {
jsonResponse(400,"Invalid Request",NULL);
}

function jsonResponse($status,$status_message,$data) {
$json_response = json_encode($data);
echo ($json_response);

}
function getItems($name, $conn) {
if ($name=='bangunan') {
$sql = "SELECT id_permohonan,nomor_registrasi,tgl_permohonan,nama_perusahaan,alamat_perusahaan,alamat_bg,status,nama_provinsi,nama_kabkota,nama_bangunan FROM vpermohonanimb";
}



$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$data[] = $rows;
}
return $data;
}
?>