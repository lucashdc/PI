<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $statusId = $_GET['id'];


      $sql = "DELETE FROM pacientes_exames WHERE id = $statusId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Exame Excluido com Sucesso');</script>";
        echo "<script>window.location.href = 'status_exames.php';</script>";
        exit;
    } else {
        echo "Erro ao excluir o Exame: " . $conn->error;
    }
} else {
    echo "ID do Exame não especificado.";
}

$conn->close();
