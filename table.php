<?php 
$host="xxx.xxx.xxx.xxx";
    $conn = mysqli_connect($host, 'xxxxxxx', 'xxxxxx', 'xxxxxx');
$sql = "SELECT * FROM `file`";
$result = mysqli_query($conn, $sql);
$riga = array();
while($r = mysqli_fetch_assoc($result)) {
    $riga[] = $r;
}
echo json_encode($riga);
?>