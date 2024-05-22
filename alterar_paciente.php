<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $pacienteId = $_GET['id'];

    $sql = "SELECT * FROM pacientes WHERE id = $pacienteId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $paciente = $result->fetch_assoc();
    } else {
        echo "Paciente não encontrado.";
        exit;
    }
} else {
    echo "ID do paciente não especificado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $dataNasc = $_POST['dataNasc'];
    $cpf = $_POST['cpf'];
    $paisNasc = $_POST['paisNasc'];
    $cidadeNasc = $_POST['cidadeNasc'];
    $nomeMae = $_POST['nomeMae'];
    $nomePai = $_POST['nomePai'];
    $unidade = $_POST['unidade'];
    $prontuario = $_POST['prontuario'];
    $sus = $_POST['sus'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $telefone = $_POST['telefone'];
    $celular = $_POST ['celular'];

    $sql = "UPDATE pacientes SET 
                nome = '$nome', 
                genero = '$genero', 
                dataNasc = '$dataNasc', 
                cpf = '$cpf',
                paisNasc = '$paisNasc',
                cidadeNasc = '$cidadeNasc', 
                nomeMae = '$nomeMae', 
                nomePai = '$nomePai', 
                unidade = '$unidade', 
                prontuario = '$prontuario', 
                sus = '$sus',
                rua = '$rua', 
                bairro = '$bairro', 
                numero = '$numero', 
                telefone = '$telefone', 
                 celular = '$celular'
            WHERE id = $pacienteId";

    if ($conn->query($sql) === TRUE) {
        header("Location: lista_pacientes.php");
        exit;
    } else {
        echo "Erro ao atualizar o cadastro do Paciente: " . $conn->error;
    }
}

$conn->close();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container{
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 10em;
        }

        .box {
            width: 120vh;
            border-radius: 10px;
            box-shadow: 0 0 3px;
        }

        .box .title{
            padding: 20px;
            font-size: 24px;
            border-bottom: thin solid #ccc;
        }

        .box form{
            display: flex;
            align-items: start;
            flex-wrap: wrap;
            padding: 20px;
        }

        body{
            padding: 0;
        }
    </style>
</head>
<body>
<div class="container d-flex">
    <div class="box">
        <h1 class="title">Identificação</h1>
        <form class="row g-3" method="post" action="">
            <div class="col-md-6">
                <label for="inp_nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="inp_nome" name="nome"
                       value="<?= htmlspecialchars($paciente['nome']) ?>">
            </div>
            <div class="col-md-3">
                <label for="inp_date" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="inp_date" name="dataNasc"
                       value="<?= htmlspecialchars($paciente['dataNasc']) ?>">
            </div>
            <div class="col-md-3">
                <label for="inp_sex" class="form-label">Sexo</label>
                <select class="form-select" id="genero" name="genero" required>
                    <option value="Feminino" <?= $paciente['genero'] == 'Feminino' ? 'selected' : '' ?>>Feminino
                    </option>
                    <option value="Masculino" <?= $paciente['genero'] == 'Masculino' ? 'selected' : '' ?>>
                        Masculino
                    </option>
                    <option value="Outro" <?= $paciente['genero'] == 'Outro' ? 'selected' : '' ?>>Outro</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inp_cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="inp_cpf" name="cpf"
                       value="<?= htmlspecialchars($paciente['cpf']) ?>">
            </div>
            <div class="col-4">
                <label for="inp_sus" class="form-label">Nº SUS</label>
                <input type="text" class="form-control" id="inp_sus" name="sus"
                       value="<?= htmlspecialchars($paciente['sus']) ?>">
            </div>
            <div class="col-md-4">
                <label for="inp_pront" class="form-label">Nº Prontuário</label>
                <input type="text" class="form-control" id="inp_pront" name="prontuario"
                       value="<?= htmlspecialchars($paciente['prontuario']) ?>">
            </div>
            <div class="col-6">
                <label for="inp_mun_nasc" class="form-label">Município de Nascimento</label>
                <input type="text" class="form-control" id="inp_mun_nasc" name="cidadeNasc"
                       value="<?= htmlspecialchars($paciente['cidadeNasc']) ?>">
            </div>
            <div class="col-md-6">
                <label for="inp_pais_nasc" class="form-label">País de Nascimento</label><br>
                <input type="text" class="form-control" id="inp_pais_nasc" name="paisNasc"
                       value="<?= htmlspecialchars($paciente['paisNasc']) ?>">
            </div>
            <div class="col-md-6">
                <label for="inp_mae" class="form-label">Nome da Mãe</label>
                <input type="text" class="form-control" id="inp_mae" name="nomeMae"
                       value="<?= htmlspecialchars($paciente['nomeMae']) ?>">
            </div>
            <div class="col-md-6 mb3-3">
                <label for="inp_pai" class="form-label">Nome do Pai</label>
                <input type="text" class="form-control" id="inp_pai" name="nomePai"
                       value="<?= htmlspecialchars($paciente['nomePai']) ?>">
            </div>
            <h1 class="title">Logradouro</h1>
            <div class="col-md-12">
                <label for="inp_uni" class="form-label">Unidade de Saúde</label>
                <input type="text" class="form-control" id="inp_uni" name="unidade"
                       value="<?= htmlspecialchars($paciente['unidade']) ?>">
            </div>
            <div class="col-md-6">
                <label for="inp_rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="inp_rua" name="rua"
                       value="<?= htmlspecialchars($paciente['rua']) ?>">
            </div>
            <div class="col-md-3">
                <label for="inp_mun_resi" class="form-label">Número</label>
                <input type="text" class="form-control" id="inp_mun_resi" name="numero"
                       value="<?= htmlspecialchars($paciente['numero']) ?>">
            </div>
            <div class="col-md-3">
                <label for="inp_bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="inp_bairro" name="bairro"
                       value="<?= htmlspecialchars($paciente['bairro']) ?>">
            </div>
            <div class="col-md-3">
                <label for="inp_tel" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="inp_tel" placeholder="19 3333 3333" name="telefone"
                       value="<?= htmlspecialchars($paciente['telefone']) ?>">
            </div>
            <div class="col-md-3 mb-2">
                <label for="inp_cel" class="form-label">Celular</label>
                <input type="text" class="form-control" id="inp_cel" placeholder="19 9 9999 9999" name="celular"
                       value="<?= htmlspecialchars($paciente['celular']) ?>">
            </div>
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>