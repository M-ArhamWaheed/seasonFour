<?php
date_default_timezone_set("Asia/Karachi");
$localhost = "localhost";
// $username = "freeiuse_accounting2";
// $password = "freeiuse_accounting2";
// $dbname = "freeiuse_accounting2";
// $localhost = "localhost";
$username = "twcppabi_erp";
$password = "twcppabi_erp";
$dbname = "twcppabi_erp";

$connect = new mysqli($localhost, $username, $password, $dbname);
$dbc =  mysqli_connect($localhost, $username, $password, $dbname);

@session_start();
if ($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  //echo "Done";
}
