<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $pacienteId = $_GET['id'];


    $sqlCheck = "SELECT COUNT(*) AS count FROM pacientes_exames WHERE idPaciente = $pacienteId";
    $resultCheck = $conn->query($sqlCheck);
    $row = $resultCheck->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        echo "<script>alert('O Paciente não pode ser excluído pois está associado a exames.');</script>";
        echo "<script>window.location.href = 'lista_pacientes.php';</script>";
        exit;
    }


    $sql = "DELETE FROM pacientes WHERE id = $pacienteId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Paciente Excluido com Sucesso');</script>";
        echo "<script>window.location.href = 'lista_pacientes.php';</script>";
        exit;
    } else {
        echo "Erro ao excluir o Paciente: " . $conn->error;
    }
} else {
    echo "ID do Paciente não especificado.";
}

$conn->close();
