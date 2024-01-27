<?php
if ( isset($_GET["id"])){
    $id =$_GET["id"];

    $servername="localhost";
    $username="root";
    $password="";
    $database="login";

    //create connection 
    $connection = new mysqli ($servername,$username,$password,$database);

    $sql ="DELETE FROM idstudent WHERE id=$id";
    $connection->query($sql);

}
?>