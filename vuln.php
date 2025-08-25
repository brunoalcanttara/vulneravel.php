<?php
// Conexão com banco de dados (sem prepared statements)
$conn = new mysqli("localhost", "user", "password", "database");

// Entrada do usuário via GET (sem validação)
$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($query);

// Exibição de resultados (vulnerável a XSS)
while ($row = $result->fetch_assoc()) {
    echo "Nome: " . $row["name"] . "<br>";
}

// Código perigoso com eval
$code = $_GET['code'];
eval($code); // NUNCA faça isso

// Inclusão de arquivos arbitrários
$file = $_GET['file'];
include($file); // RCE possível
?>
