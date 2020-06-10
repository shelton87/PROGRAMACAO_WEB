<?php

echo "Nome: " . $_POST["nome"];
echo "<br>";
echo "Senha: " . $_POST["senha"];
echo "<br>";
echo "Repita a senha: " . $_POST["rsenha"];
echo "<br>";
echo "Sexo: " . $_POST["sexo"];
echo "<br>";
echo "Data de nascimento: " . $_POST["dia"] . " / ". $_POST["mes"] . " / ". $_POST["ano"];
echo "<br>";
echo "Deixe sua mensagem: " . $_POST["dmensagem"];
echo "<br>";

echo "Linguagens de programação: ";

if($_POST["php"] != null) {
  echo $_POST["php"];
}
echo " / ";

if($_POST["vb"] != null) {
  echo $_POST["vb"];
}

echo " / ";

if($_POST["c"] != null) {
  echo $_POST["c"];
}
  
?>