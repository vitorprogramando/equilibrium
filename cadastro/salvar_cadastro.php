<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Dados de conexão ao banco de dados
$servername = "localhost";
$username = "root"; // Nome de usuário padrão do MySQL no XAMPP
$password = ""; // Deixe vazio se não tiver uma senha configurada
$dbname = "cadastro_db"; // Nome do banco de dados

// Conexão ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$assinatura = $_POST['assinatura'];

// Preparar e executar a consulta SQL para inserir os dados na tabela
$sql = "INSERT INTO cadastro (nome, email, assinatura) VALUES ('$nome', '$email', '$assinatura')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro salvo com sucesso!";
} else {
    echo "Erro ao salvar o cadastro: " . $conn->error;
}

// Fechar conexão com o banco de dados
$conn->close();
?>
