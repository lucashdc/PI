<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $situacao = $_POST['situacao'];
    $dataEntrega = $_POST['dataEntrega'];

    $sql = "UPDATE pacientes_exames SET situacao='$situacao', dataEntrega='$dataEntrega' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Exame atualizado com sucesso!"); window.location.href = "status_exames.php";</script>';
    } else {
        echo "Erro ao atualizar exame: " . $conn->error;
    }

    $conn->close();
}
?>
<?php
