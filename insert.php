<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbCalen";


$conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection

    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Check connection
    }

$compromissoInsert = $_POST['compromisso']; 

$descricaoInsert = $_POST['descricao']; 

$dataInsert = $_POST['data'];

$data = explode("/", $dataInsert);

$databd = $data[2] . $data[1] . $data[0];

$sqlInsert = "INSERT INTO compromisso (compromisso, descricao, data)
VALUES ('$compromissoInsert', '$descricaoInsert', '$databd')";

    if($conn->query($sqlInsert) === TRUE){
        header("location: /teste/Calen2.php?mes=" . $data[1]. "&ano=" . $data[2]);
        die();
    }else{
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
    
    $conn->close();




?>