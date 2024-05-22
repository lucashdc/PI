<?php
require_once 'db_connection.php';

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exame = $_POST["exame"];
    $sql = "INSERT INTO exame (exame) VALUES ('$exame')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Exame cadastrado com sucesso!"); window.location.href = "listar_exames.php";</script>';
    } else {
        echo "Erro ao cadastrar o exame: " . $conn->error;
    }
}

$conn->close();
