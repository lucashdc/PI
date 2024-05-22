<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $exameId = $_GET['id'];

    $sqlCheck = "SELECT COUNT(*) AS count FROM pacientes_exames WHERE idExame = $exameId";
    $resultCheck = $conn->query($sqlCheck);
    $row = $resultCheck->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        echo "<script>alert('O exame não pode ser excluído pois está associado a pacientes.');</script>";
        echo "<script>window.location.href = 'listar_exames.php';</script>";
        exit;
    }

    $sql = "DELETE FROM exame WHERE id = $exameId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Exame Excluido com Sucesso');</script>";
        echo "<script>window.location.href = 'listar_exames.php';</script>";
        exit;
    } else {
        echo "Erro ao excluir o exame: " . $conn->error;
    }
} else {
    echo "ID do exame não especificado.";
}

$conn->close();
