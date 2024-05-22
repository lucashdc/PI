<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $dataNasc = $_POST['dataNasc'];
    $genero = $_POST['genero'];
    $cpf = $_POST['cpf'];
    $sus = $_POST['sus'];
    $prontuario = $_POST['prontuario'];
    $cidadeNasc = $_POST['cidadeNasc'];
    $paisNasc = $_POST['paisNasc'];
    $nomeMae = $_POST['nomeMae'];
    $nomePai = $_POST['nomePai'];
    $unidade = $_POST['unidade'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];

    $sql = "INSERT INTO pacientes (nome, dataNasc, genero, cpf, sus, prontuario, cidadeNasc, paisNasc, nomeMae, nomePai, unidade, rua, numero, bairro, telefone, celular) VALUES ('$nome', '$dataNasc', '$genero', '$cpf', '$sus', '$prontuario', '$cidadeNasc', '$paisNasc', '$nomeMae', '$nomePai', '$unidade', '$rua', '$numero', '$bairro', '$telefone', '$celular')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Paciente Cadastrado com sucesso!"); window.location.href = "lista_pacientes.php";</script>';
    } else {
        echo "Erro ao cadastrar paciente: " . $conn->error;
    }

    $conn->close();
}