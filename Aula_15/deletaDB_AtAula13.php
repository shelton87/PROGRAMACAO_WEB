<?php
    $servername = "localhost";
    $username = "root";
    $password = "D@nasa123";
    $dbname = "Exercicio_Aula_13";
    $table = "cadastro";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }    
    
    // sql to delete a record
    $nome = $_POST["nome"];   
    $sql = "DELETE FROM $table WHERE nome=$nome";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>