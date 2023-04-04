<?php

$dbhost ='127.0.0.1';
$dbuser='root';
$dbpass='';
$dbname='my_test';

mysqli_report(MYSQLI_REPORT_OFF);  //show clearfully if error

$conn = mysqli_connect($dbhost,$dbuser,$dbpass);
if(!$conn){
   die("error");
}
if(!mysqli_select_db($conn,$dbname)){
    die("Cannot fail with selected db.");
}else{
   // echo "Connect successfully.";
}