<?php
$servername="localhost";
$username="root";
$password="";
$databasename="kindercare";
$dbc=mysqli_connect($servername,$username,$password,"$databasename");

if(!$dbc){
    die("could not connect to database:".mysql_error());
}
else{
    echo "connection was successful";
}
?>