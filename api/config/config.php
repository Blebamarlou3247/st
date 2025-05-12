<?php
$servername="localhost";
$us="cs";
$pass="cs";
$db="togo-api";
$conn = mysqli_connect($servername,$us,$pass,$db);
if(!$conn){
    die("Connection Faialed".mysqli_connect_error());
}else{
    "norm";
}?>