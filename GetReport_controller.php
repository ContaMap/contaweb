<?php // Training module for map in Conta System
include 'Report_Model.php';

$reportModel = new Report_model();
$reportModel->getReports();
$reportModel->closeConnect();
die();

?>