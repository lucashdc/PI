<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro de Exame dos Pacientes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
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

        .box .title {
            padding: 20px;
            font-size: 24px;
            border-bottom: thin solid #ccc;
        }

        .box form {
            display: flex;
            align-items: start;
            flex-wrap: wrap;
            padding: 20px;
        }

        body {
            padding: 0;
            background-color: #ffffff;
        }

        .form-group {
            position: relative;
        }

        .sugestoes {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            z-index: 1000;
            width: 100%;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            display: none;
        }

        .sugestoes li {
            padding: 10px;
            cursor: pointer;
            list-style-type: none;
        }

        .sugestoes li:hover {
            background-color: #eee;
        }
    </style>
    <script src="js/sugestoes.js"></script>
</head>
<body>
<div class="container d-flex">
    <div class="box">
        <h1 class="title">Cadastro de Exame dos Pacientes</h1>
        <form class="row g-3" method="post" action="cad_examesPacientes.php">
            <div class="col-md-6 form-group">
                <label for="idPaciente" class="form-label">Paciente:</label>
                <input class="form-control" type="text" id="idPaciente" name="idPaciente" autocomplete="off" required>
                <ul id="sugestoes" class="sugestoes"></ul>
            </div>
            <div class="col-md-6 form-group">
                <label for="idExame" class="form-label">Exame:</label>
                <input class="form-control" type="text" id="idExame" name="idExame" autocomplete="off">
                <ul id="sugestoesUsuario" class="sugestoes"></ul>
            </div>
            <div class="col-md-3">
                <label for="dataPedido" class="form-label">Data do Pedido:</label>
                <input type="date" class="form-control" name="dataPedido" autocomplete="off">
            </div>
            <div class="col-md-3">
                <label for="dataResultado" class="form-label">Data do Resultado:</label>
                <input type="date" class="form-control" name="dataResultado">
            </div>
            <div class="col-md-3">
                <label for="situacao" class="form-label">Situação</label>
                <select class="form-control" name="situacao" required>
                    <option value="Pronto">Pronto</option>
                    <option value="Entregue">Entregue</option>
                    <option value="Aguardando">Aguardando</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="dataEntrega" class="form-label">Data da Entrega:</label>
                <input type="date" class="form-control" name="dataEntrega">
            </div>
            <input type="hidden" id="idSelecionado" name="paciente" value="">
            <input type="hidden" id="idExameSelecionado" name="exame" value="">
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
