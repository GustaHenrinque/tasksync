<?php
include("db/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Tarefa</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 400px;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            width: 100%;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            width: 70%;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 4px;
            font-size: 0.98rem;
        }

        input[type="text"], select {
            width: 100%;
            padding: 6px;
            margin: 0 0 0 0;
            border: 1.5px solid #222;
            border-radius: 6px;
            box-sizing: border-box;
            background: #fff;
            color: #111;
            font-size: 0.97rem;
            transition: border 0.2s;
        }

        input[type="text"]:focus, select:focus {
            border: 1.5px solid #000;
            outline: none;
            background: #fff;
            color: #000;
        }

        button {
            background: #111;
            color: #fff;
            padding: 8px 0;
            width: 70%;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: background 0.3s, transform 0.2s;
            margin-top: 12px;
        }

        button:hover {
            background: #000;
            transform: translateY(-2px) scale(1.02);
        }

        .msg {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            width: 100%;
        }

        .msg.green {
            color: #111;
        }

        .msg.red {
            color: #000;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            width: 100%;
        }

        .back-link a {
            text-decoration: none;
            color: #111;
            font-weight: bold;
            transition: color 0.2s;
        }

        .back-link a:hover {
            text-decoration: underline;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Criar Nova Tarefa</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Usuário Responsável:</label>
                <select name="id_usuario" required>
                    <option value="">Selecione</option>
                    <?php
                    $usuarios = $conn->query("SELECT id_usuario, nome, setor FROM usuarios");
                    while ($usuario = $usuarios->fetch_assoc()) {
                        echo "<option value='{$usuario['id_usuario']}'>{$usuario['nome']} - {$usuario['setor']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Descrição:</label>
                <input type="text" name="descricao" required>
            </div>

            <div class="form-group">
                <label>Setor:</label>
                <input type="text" name="setor" required>
            </div>

            <div class="form-group">
                <label>Prioridade:</label>
                <select name="prioridade" required>
                    <option value="baixa">Baixa</option>
                    <option value="média">Média</option>
                    <option value="alta">Alta</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status:</label>
                <select name="status" required>
                    <option value="a fazer">A Fazer</option>
                    <option value="fazendo">Fazendo</option>
                    <option value="concluído">Concluído</option>
                </select>
            </div>

            <button type="submit" name="cadastrar">Cadastrar</button>
        </form>

        <?php
        if (isset($_POST['cadastrar'])) {
            $id_usuario = $_POST['id_usuario'];
            $descricao = $_POST['descricao'];
            $setor = $_POST['setor'];
            $prioridade = $_POST['prioridade'];
            $status = $_POST['status'];

            $sql = "INSERT INTO tarefas (id_usuario, descricao, setor, prioridade, status, data_cadastro) 
                    VALUES ('$id_usuario', '$descricao', '$setor', '$prioridade', '$status', NOW())";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='msg green'>Tarefa cadastrada com sucesso!</p>";
            } else {
                echo "<p class='msg red'>Erro: " . $conn->error . "</p>";
            }
        }
        ?>

        <div class="back-link">
            <a href="index.php">← Voltar ao Painel Principal</a>
        </div>
    </div>

</body>
</html>
