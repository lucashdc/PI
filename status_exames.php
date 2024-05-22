<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status de Exames Realizados</title>
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
        <h1 class="title">Consultar Exames Realizados</h1>
        <form class="row g-3" method="POST" action="">
            <div class="col-md-8">
                <input type="text" class="form-control" id="inp_busca" name="busca"
                       placeholder="Nome Completo ou Exame Realizado">
            </div>
            <div class="col-md-4 btn-group">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href=window.location.href">
                    Cancelar
                </button>
            </div>
        </form>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">Paciente</th>
                    <th scope="col">Exame</th>
                    <th scope="col">Data Pedido</th>
                    <th scope="col">Data Resultado</th>
                    <th scope="col">Data Entrega</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once 'db_connection.php';

                if (isset($_POST['busca'])) {
                    $pesq = '%' . $conn->real_escape_string($_POST['busca']) . '%';


                    $sql = "SELECT pacientes_exames.id, pacientes.nome, exame.exame, pacientes_exames.dataPedido, 
            pacientes_exames.dataResultado, pacientes_exames.dataEntrega, pacientes_exames.situacao
            FROM pacientes_exames
            INNER JOIN pacientes ON pacientes_exames.idPaciente = pacientes.id
            INNER JOIN exame ON pacientes_exames.idExame = exame.id
            WHERE pacientes.nome LIKE '$pesq' OR exame.exame LIKE '$pesq'";
                } else {

                    $sql = "SELECT pacientes_exames.id, pacientes.nome, exame.exame, pacientes_exames.dataPedido, 
            pacientes_exames.dataResultado, pacientes_exames.dataEntrega, pacientes_exames.situacao
            FROM pacientes_exames
            INNER JOIN pacientes ON pacientes_exames.idPaciente = pacientes.id
            INNER JOIN exame ON pacientes_exames.idExame = exame.id";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['exame'] . "</td>";
                        echo "<td>" . $row['dataPedido'] . "</td>";
                        echo "<td>" . $row['dataResultado'] . "</td>";
                        echo "<td>" . $row['dataEntrega'] . "</td>";
                        echo "<td>" . $row['situacao'] . "</td>";
                        echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' 
      data-id='" . $row['id'] . "' data-situacao='" . $row['situacao'] . "' 
      data-data-entrega='" . $row['dataEntrega'] . "'>Editar</button> 
      <a href='excluir_examePaciente.php?id=" . $row['id'] . "' class='btn btn-danger'>Excluir</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum exame encontrado</td></tr>";
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


<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Situação e Data de Entrega</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="atualizar_exame.php">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editSituacao" class="form-label">Situação</label>
                        <select class="form-control" name="situacao" required>
                            <option value="Pronto">Pronto</option>
                            <option value="Entregue">Entregue</option>
                            <option value="Aguardando">Aguardando</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDataEntrega" class="form-label">Data de Entrega</label>
                        <input type="date" class="form-control" id="editDataEntrega" name="dataEntrega">
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var situacao = button.getAttribute('data-situacao');
        var dataEntrega = button.getAttribute('data-data-entrega');
        var modalId = editModal.querySelector('#editId');
        var modalSituacao = editModal.querySelector('#editSituacao');
        var modalDataEntrega = editModal.querySelector('#editDataEntrega');
        modalId.value = id;
        modalSituacao.value = situacao;
        modalDataEntrega.value = dataEntrega;
    });
</script>

</body>
</html>
