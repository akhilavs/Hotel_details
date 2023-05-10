<?php
$dsn="mysql:host=localhost; dbname=hotels_details";
$user="root";
$password="";
$options=[];

try {
    $connection=new PDO($dsn,$user,$password,$options);
    // echo "Connection Successfull";
}
catch (PDOException){
    echo "Connection Unsuccessfull";
}
?>