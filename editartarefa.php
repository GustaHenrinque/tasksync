<?php
include("db/conexao.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM tarefas WHERE id_tarefa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$tarefa = $result->fetch_assoc();

if (!$tarefa) {
    die("Tarefa não encontrada.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = trim($_POST['descricao']);
    $setor = trim($_POST['setor']);
    $prioridade = $_POST['prioridade'];

    if ($descricao && $setor && in_array($prioridade, ['baixa', 'média', 'alta'])) {
        $update = $conn->prepare("UPDATE tarefas SET descricao = ?, setor = ?, prioridade = ? WHERE id_tarefa = ?");
        $update->bind_param("sssi", $descricao, $setor, $prioridade, $id);

        if ($update->execute()) {
            header("Location: gerenciartarefas.php?mensagem=Tarefa atualizada com sucesso");
            exit();
        } else {
            $erro = "Erro ao atualizar tarefa.";
        }
    } else {
        $erro = "Preencha todos os campos corretamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa - TaskSync</title>
    <style>
        body {
            background: #fff;
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #000;
        }
        .form-container {
            max-width: 350px;
            margin: auto;
            background: #fff;
            padding: 18px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #000;
        }
        h2 {
            text-align: center;
            color: #000;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #000;
            font-size: 14px;
        }
        input[type="text"], select {
            width: 90%;
            padding: 6px;
            margin-top: 4px;
            border-radius: 3px;
            border: 1px solid #000;
            background: #fff;
            color: #000;
            font-size: 14px;
        }
        .btn {
            margin-top: 16px;
            width: 100%;
            background-color: #000;
            color: #fff;
            padding: 8px;
            border: none;
            border-radius: 3px;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn:hover {
            background-color: #222;
        }
        .erro {
            color: #c00;
            margin-top: 10px;
            text-align: center;
        }
        a.voltar {
            display: block;
            margin: 16px auto 0;
            text-align: center;
            background: #fff;
            color: #000;
            padding: 8px;
            border-radius: 4px;
            width: 120px;
            text-decoration: none;
            border: 1px solid #000;
            font-size: 14px;
        }
        a.voltar:hover {
            background: #000;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Editar Tarefa</h2>
        <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
        <form method="post">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" value="<?= htmlspecialchars($tarefa['descricao']) ?>" required>

            <label for="setor">Setor</label>
            <input type="text" name="setor" id="setor" value="<?= htmlspecialchars($tarefa['setor']) ?>" required>

            <label for="prioridade">Prioridade</label>
            <select name="prioridade" id="prioridade" required>
                <option value="baixa" <?= $tarefa['prioridade'] == 'baixa' ? 'selected' : '' ?>>Baixa</option>
                <option value="média" <?= $tarefa['prioridade'] == 'média' ? 'selected' : '' ?>>Média</option>
                <option value="alta" <?= $tarefa['prioridade'] == 'alta' ? 'selected' : '' ?>>Alta</option>
            </select>

            <button type="submit" class="btn">Salvar Alterações</button>
        </form>

        <a href="gerenciartarefas.php" class="voltar">Cancelar</a>
    </div>
</body>
</html>
