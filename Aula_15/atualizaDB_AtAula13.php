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


  // Variáveis ************************************************************************************************************
  $nomeErr = $senhaErr = $rsenhaErr = $sexoErr = $nascErr = $dmensagemErr = $phpErr = $vbErr = $cErr = "";
  $data = $nome = $senha = $rsenha = $sexo = $nasc = $nascTest = $dmensagem = $php = $vb = $c = $verifica = "";

  // Funções de validação
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Validação dados do formulário
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // NOME
    if (empty($_POST["nome"])) {
      $nomeErr = "O campo nome é obrigatório.";
    } else {
      $nome = test_input($_POST["nome"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $nome)) {
        $nomeErr = "Somente letras e espaços em branco são permitidos.";
      }
    }

    // SENHA
    if (empty($_POST["senha"])) {
      $senhaErr = "O campo senha é obrigatório.";
    } else {
      $senha = $_POST["senha"];
      if (!preg_match("/^[a-zA-Z0-9!@#$%^& ]*$/", $senha)) {
        $senhaErr = "Somente letras, números, '!@#$%^&' e espaços em branco são permitidos.";
      }
    }

    // CONFIRMAÇÃO DA SENHA
    if (empty($_POST["rsenha"])) {
      $rsenhaErr = "O campo repita a senha é obrigatório.";
    } else {
      $rsenha = $_POST["rsenha"];
      if (!preg_match("/^[a-zA-Z0-9!@#$%^& ]*$/", $rsenha)) {
        $rsenhaErr = "Somente letras, números, '!@#$%^&' e espaços em branco são permitidos.";
      }
      if ($rsenha != $senha) {
        $rsenhaErr = "Senha e Confirmação de Senha não são iguais.";
      }
    }

    // SEXO
    if (empty($_POST["sexo"])) {
      $sexoErr = "O campo sexo é obrigatório.";
    } else {
      $sexo = $_POST["sexo"];    
    }
    
    // DATA DE NASCIMENTO
    if (empty($_POST["nasc"])) {
      $nascErr = "O campo data de nascimento é obrigatório.";
    } else {
      $nascTest = $_POST["nasc"];
      $nascTest = explode("/","$nascTest"); 
      if($nascTest[0] <= 2020) {
        $nasc = $_POST["nasc"];
      } else {
        $nascErr = "Data inválida.";
      }
    }

    // MENSAGEM
    if (empty($_POST["dmensagem"])) {
      $dmensagem = "";
    } else {
      $dmensagem = $_POST["dmensagem"];    
    }

    // LINGUAGEM DE PROGAMAÇÃO
    if ((!empty($_POST["php"])) && (($_POST["php"]) != "php")) {
      $phpErr = "Inconsistência no valor selecionado.";
    } elseif ((!empty($_POST["php"])) && (($_POST["php"]) == "php")) {
      $php = $_POST["php"];
    }
    if ((!empty($_POST["vb"])) && (($_POST["vb"]) != "vb")) {
      $vbErr = "Inconsistência no valor selecionado.";
    } elseif ((!empty($_POST["vb"])) && (($_POST["vb"]) == "vb")) {
      $vb = $_POST["vb"];
    }
    if ((!empty($_POST["c"])) && (($_POST["c"]) != "c")) {
      $cErr = "Inconsistência no valor selecionado.";
    } elseif ((!empty($_POST["c"])) && (($_POST["c"]) == "c")) {
      $c = $_POST["c"];
    }
    
  }

  // Verificação de erro do campo NOME ******************************************************
  if (strlen($nomeErr) > 0) {
    echo "Erro no campo nome: " . $nomeErr;
    $verifica++;
  } 

  // Verificação de erro do campo SENHA
  if (strlen($senhaErr) > 0) {
    echo "<br>Erro no campo senha: " . $senhaErr;
    $verifica++;
  }

  // Verificação de erro do campo REPITA A SENHA
  if (strlen($rsenhaErr) > 0) {
    echo "<br>Erro no campo repita a senha: " . $rsenhaErr;
    $verifica++;
  }

  // Verificação de erro do campo SEXO
  if (strlen($sexoErr) > 0) {
    echo "<br>Erro no campo sexo: " . $sexoErr;
    $verifica++;
  }

  // Verificação de erro do campo DATA DE NASCIMENTO
  if (strlen($nascErr) > 0) {
    echo "<br>Erro no campo data de nascimento: " . $nascErr;
    $verifica++;
  }

  // Verificação de erro do campo LINGUAGENS DE PROGRAMAÇÃO
  if (strlen($phpErr) > 0) {
    echo "<br>  Erro no campo PHP: " . $phpErr;
    $verifica++;
  }
  if (strlen($vbErr) > 0) {
    echo "<br>  Erro no campo VB: " . $vbErr;
    $verifica++;
  }
  if (strlen($cErr) > 0) {
    echo "<br>  Erro no campo C: " . $cErr;
    $verifica++;
  }

  // Envio das informações para DB ******************************************************

  if (empty ($verifica)) {
    $sql = "UPDATE $table SET senha='$senha', rsenha='$rsenha', sexo='$sexo', nasc='$nasc', dmensagem='$dmensagem', php='$php', vb='$vb', 
            c='$c' WHERE nome='$nome';";    
    if (mysqli_query($conn, $sql)) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
?>
