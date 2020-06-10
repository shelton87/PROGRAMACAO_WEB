<?php

// Variáveis
$nomeErr = $senhaErr = $rsenhaErr = $sexoErr = $nascErr = $dmensagemErr = $phpErr = $vbErr = $cErr = "";
$data = $nome = $senha = $rsenha = $sexo = $nasc = $nascTest = $dmensagem = $php = $vb = $c = "";

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

// Exibição do campo NOME
if (strlen($nomeErr) > 0) {
  echo "Erro no campo nome: " . $nomeErr;
} else {
  echo "Nome: " . $nome;
}

// Exibição do campo SENHA
if (strlen($senhaErr) > 0) {
  echo "<br>Erro no campo senha: " . $senhaErr;
} else {
  echo "<br>Senha: " . $senha;
}

// Exibição do campo REPITA A SENHA
if (strlen($rsenhaErr) > 0) {
  echo "<br>Erro no campo repita a senha: " . $rsenhaErr;
} else {
  echo "<br>Repita a Senha: " . $rsenha;
}

// Exibição do campo SEXO
if (strlen($sexoErr) > 0) {
  echo "<br>Erro no campo sexo: " . $sexoErr;
} else {
  echo "<br>Sexo: " . $sexo;
}

// Exibição do campo DATA DE NASCIMENTO
if (strlen($nascErr) > 0) {
  echo "<br>Erro no campo data de nascimento: " . $nascErr;
} else {
  echo "<br>Data de nascimento: " . $nasc;
}

// Exibição do campo MENSAGEM
echo "<br>Mensagem: " . $dmensagem;

// Exibição do campo LINGUAGENS DE PROGRAMAÇÃO
echo "<br>***Linguagens de Programação***";
if (strlen($phpErr) > 0) {
  echo "<br>  Erro no campo PHP: " . $phpErr;
} elseif (strlen($php) > 0) {
  echo "<br>  - " . $php;
}
if (strlen($vbErr) > 0) {
  echo "<br>  Erro no campo VB: " . $vbErr;
} elseif (strlen($vb) > 0) {
  echo "<br>  - " . $vb;
}
if (strlen($cErr) > 0) {
  echo "<br>  Erro no campo C: " . $cErr;
} elseif (strlen($c) > 0) {
  echo "<br>  - " . $c;
}
?>