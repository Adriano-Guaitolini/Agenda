<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbCalen";


$conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection

    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Check connection
    }

$mes = $_GET['mes'];
$ano = $_GET['ano'];
$id = $_GET['id'];


    
$sqlDelete = "DELETE FROM compromisso WHERE id = $id";
    
    if($conn->query($sqlDelete) === TRUE){
        header("location: /agenda/Calen2.php?mes=" . $mes . "&ano=" . $ano);
        die();
    }else{
        echo "Error: " . $sqlDelete . "<br>" . $conn->error;
    }
    
    $conn->close();
    
    ?>