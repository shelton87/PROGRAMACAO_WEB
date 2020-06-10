<?php
    $servername = "localhost";
    $username = "root";
    $password = "D@nasa123";
    $dbname = "Exercicio_Aula_13";
    $table = "cadastro";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }    
    
    $nome = $_POST["nome"];
    $sql = "SELECT * FROM $table WHERE nome LIKE '%$nome%';";    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo " Nome: "                        . $row["nome"] . "<br>" .
                 " Sexo: "                        . $row["sexo"]. "<br>" . 
                 " Data de Nasimento: "           . $row["nasc"]. "<br>" . 
                 " Mensagem: "                    . $row["dmensagem"]. "<br>" . 
                 " Ling. de Programação: "        . $row["php"] . " / " . $row["vb"] . " / " . $row["c"];                 
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
?>