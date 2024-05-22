<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $exameId = $_GET['id'];

    $sql = "SELECT * FROM exame WHERE id = $exameId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $exame = $result->fetch_assoc();
    } else {
        echo "Exame não encontrado.";
        exit;
    }
} else {
    echo "ID do exame não especificado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novoNome = $_POST['exame'];

    $sql = "UPDATE exame SET exame = '$novoNome' WHERE id = $exameId";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar_exames.php");
        exit;
    } else {
        echo "Erro ao atualizar o exame: " . $conn->error;
    }
}

$conn->close();
?>



<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Exames</title>
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
        <h1 class="title">Exames</h1>
        <form class="row g-3" action="" method="POST">
            <div class="col-md-6">
                <label for="exame" class="form-label">Nome do Exame</label>
                <input type="text" class="form-control" id="exame" name="exame" value="<?php echo $exame['exame']; ?>" required>
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
>
