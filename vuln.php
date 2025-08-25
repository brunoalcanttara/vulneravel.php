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

// **Vulnerabilidade de SQL Injection** (sem prepared statements)
$username = $_GET['username'];
$password = $_GET['password'];
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'"; // SQL Injection
$result = $conn->query($sql);

// **Vulnerabilidade de Cross-Site Scripting (XSS)** na saída
$comment = $_GET['comment'];
echo "<div class='comment'>" . $comment . "</div>"; // XSS possível

// **Command Injection** com exec()
$command = $_GET['command'];
exec($command); // Command injection

// **Vulnerabilidade de Path Traversal** na inclusão de arquivos
$path = $_GET['path'];
include($path); // Path Traversal possível, incluindo arquivos fora da pasta do site

// **Vulnerabilidade de Cookie Injection** (sem verificação adequada de dados)
$cookie_value = $_GET['cookie_value'];
setcookie("user", $cookie_value, time() + 3600); // Cookie Injection possível

// **Vulnerabilidade de File Upload** sem validação de tipo de arquivo
if (isset($_FILES['file'])) {
    $file_tmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($file_tmp, "uploads/" . $_FILES['file']['name']); // Upload inseguro, sem validação de tipo
}

// **Vulnerabilidade de CSRF (Cross-Site Request Forgery)**
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Atualização de perfil sem verificação de CSRF
    $username = $_POST['username'];
    $email = $_POST['email'];
    // Atualiza o perfil do usuário com dados não verificados
    $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id'";
    $conn->query($sql);
}

?>
