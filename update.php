<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbCalen";


$conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection

    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Check connection
    }

$id = $_POST['id'];

$compromissoUpdate = $_POST['compromisso']; 

$descricaoUpdate = $_POST['descricao']; 

$dataUpdate = $_POST['data'];

$data = explode("/", $dataUpdate);

$databd = $data[2] . "-" . $data[1] . "-" . $data[0];

$sqlUpdate = "UPDATE compromisso SET compromisso = '$compromissoUpdate', descricao = '$descricaoUpdate' WHERE id = '$id'";

    if($conn->query($sqlUpdate) === TRUE){
        header("location: /teste/Calen2.php?mes=" . $data[1]. "&ano=" . $data[2]);
    die();
    }else{
        echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
}

$conn->close();

?>