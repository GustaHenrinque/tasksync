<?php
include("db/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>TaskSync - Painel Principal</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f4f8;
        }

        header {
            background-color:rgb(0, 0, 0);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        nav a {
            text-decoration: none;
            color: white;
            margin-left: 20px;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #1abc9c;
        }

        .welcome {
            max-width: 800px;
            margin: 60px auto 30px auto;
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .welcome h2 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .welcome p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <header>
    <img src="logo.png" alt="TaskSync Logo" style="height: 40px;">
    <nav>
        <a href="index.php">Início</a>
        <a href="tarefa.php">Nova Tarefa</a>
        <a href="cadastro.php">Novo Usuário</a>
        <a href="gerenciartarefas.php">Gerenciamento</a>
    </nav>
</header>

    <div class="welcome">
        <h2>Seja bem-vindo ao TaskSync!</h2>
        <p>
            O <strong>TaskSync</strong> é um sistema de gerenciamento de tarefas simples e eficiente, desenvolvido para facilitar o acompanhamento de atividades em equipe.<br><br>
            Crie tarefas, atribua responsáveis, controle o status, prioridade e setor de forma prática. Com uma interface intuitiva e funcionalidades essenciais, o TaskSync é ideal para empresas e equipes que desejam manter suas demandas organizadas.<br><br>
            Use os links acima para cadastrar tarefas, adicionar usuários ou gerenciar o andamento das atividades.
        </p>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> TaskSync - Sistema de Gerenciamento de Tarefas
    </footer>

</body>
</html>
