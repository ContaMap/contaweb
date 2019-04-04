<?php // Training module for map in Conta System
include 'Report_Model.php';

 $lat = $_POST["campo1"];
 $lng = $_POST["campo2"];
 $desciption = $_POST["campo3"];

$reportModel = new Report_model();
$reportModel->saveReport($lat,$lng,$desciption,1);
$reportModel->closeConnect();


die();


?>
