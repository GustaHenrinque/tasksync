<?php include("db/conexao.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 520px;
            background: #fff;
            margin: 0 auto;
            padding: 40px 50px 30px 50px;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.10), 0 1.5px 4px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            text-align: center;
            color: #111;
            margin-bottom: 30px;
            letter-spacing: 1px;
            font-size: 2rem;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: 600;
            color: #111;
            margin-bottom: 6px;
            align-self: flex-start;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 22px 0;
            border: 1.5px solid #222;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
            background: #fff;
            color: #111;
            transition: border 0.2s;
        }

        input[type="text"]:focus {
            border: 1.5px solid #000;
            outline: none;
            background: #fff;
            color: #000;
        }

        button {
            background: #111;
            color: #fff;
            padding: 14px 0;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            transition: background 0.3s, transform 0.2s;
            margin-top: 8px;
        }

        button:hover {
            background: #000;
            transform: translateY(-2px) scale(1.02);
        }

        .msg {
            text-align: center;
            margin-top: 18px;
            font-weight: bold;
            font-size: 1.05rem;
            width: 100%;
        }

        .msg.success {
            color: #111;
        }

        .msg.error {
            color: #000;
        }

        .back-link {
            text-align: center;
            margin-top: 24px;
            width: 100%;
        }

        .back-link a {
            text-decoration: none;
            color: #111;
            font-weight: bold;
            font-size: 1.05rem;
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
        <h2>Cadastro de Usuário</h2>
        <form method="POST" action="">
            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Setor:</label>
            <input type="text" name="setor" required>

            <button type="submit" name="cadastrar">Cadastrar</button>
        </form>

        <?php
        if (isset($_POST['cadastrar'])) {
            $nome = $_POST['nome'];
            $setor = $_POST['setor'];

            $sql = "INSERT INTO usuarios (nome, setor) VALUES ('$nome', '$setor')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='msg success'>Usuário cadastrado com sucesso!</p>";
            } else {
                echo "<p class='msg error'>Erro: " . $conn->error . "</p>";
            }
        }
        ?>

        <div class="back-link">
            <a href="index.php">← Voltar ao Painel Principal</a>
        </div>
    </div>

</body>
</html>
