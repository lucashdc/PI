<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Pedidos Retirados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            width: auto;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 10em;
        }

        .box {
            width: 130vh;
            border-radius: 10px;
            box-shadow: 0 0 3px;
            height: auto;
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

        .box form .btn-group {
            display: flex;
            gap: 10px;
        }

        body {
            padding: 0;
        }

        .table-container {
            padding: 20px;
        }

        .table {
            width: 100%;
        }

        .table thead th {
            background-color: #f8f9fa;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
<div class="container d-flex py-3">
    <div class="box">
        <h1 class="title">Consultar Paciente</h1>
        <form class="row g-3" method="POST" action="">
            <div class="col-md-8">
                <input type="text" class="form-control" id="inp_busca" name="busca" placeholder="Nome Completo ou Nº Prontuário">
            </div>
            <div class="col-md-4 btn-group">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href=window.location.href">Cancelar</button>
            </div>
        </form>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Data Nasc.</th>
                    <th scope="col">Prontuário</th>
                    <th scope="col">Unidade</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once 'db_connection.php';

                $sql = "SELECT * FROM pacientes";

                if (!empty($_POST['busca'])) {
                    $busca = $_POST['busca'];
                    $sql .= " WHERE nome LIKE '%$busca%' OR prontuario LIKE '%$busca%'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "
                <tr>";
                        echo "
                    <td>" . $row['nome'] . "</td>
                    ";
                        echo "
                    <td>" . $row['genero'] . "</td>
                    ";
                        echo "
                    <td>" . $row['dataNasc'] . "</td>
                    ";
                        echo "
                    <td>" . $row['prontuario'] . "</td>
                    ";
                        echo "
                    <td>" . $row['unidade'] . "</td>
                    ";
                        echo "
                    <td>" . $row['rua'] . ", " . $row['numero'] . ", " . $row['bairro'] . ", " . $row['complemento']
                            . ", " . $row['cidade'] . "
                    </td>
                    ";
                        echo "
                    <td><a href='alterar_paciente.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Editar</a> 
                    <a href='excluir_paciente.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Excluir</a></td>
                    ";
                        echo "
                </tr>
                ";
                    }
                } else {
                    echo "
                <tr>
                    <td colspan='7'>Nenhum paciente encontrado.</td>
                </tr>
                ";
                }

                $conn->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
