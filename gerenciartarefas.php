<?php
include("db/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Gerenciamento de Tarefas - TaskSync</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f0f2f5;
        margin: 0;
        padding: 0;
        color: #333;
    }
    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
        margin-top: 40px;
    }
    .container {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .coluna {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        width: 300px;
        max-height: 80vh;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }
    .coluna h3 {
        margin-top: 0;
        margin-bottom: 15px;
        font-weight: 700;
        color: #34495e;
        border-bottom: 2px solid #3498db;
        padding-bottom: 8px;
    }
    .tarefa-card {
        background: #fafafa;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.3s ease;
    }
    .tarefa-card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .tarefa-info p {
        margin: 5px 0;
        font-size: 0.9rem;
        line-height: 1.3;
    }
    .prioridade-baixa { color: #111; font-weight: 600; }
    .prioridade-media { color: #111; font-weight: 600; }
    .prioridade-alta { color: #111; font-weight: 600; }

    .botoes {
        margin-top: 12px;
        display: flex;
        justify-content: space-between;
        gap: 6px;
    }
    .botoes a {
        flex: 1;
        padding: 7px 8px;
        text-align: center;
        text-decoration: none;
        border-radius: 6px;
        font-size: 1.15rem;
        color: #222;
        font-weight: 600;
        user-select: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        background: transparent;
        border: none;
        transition: background 0.3s, color 0.2s;
    }
    .botoes a:hover {
        background: #f0f0f0;
        color: #000;
    }
    .editar, .excluir, .status {
        background: transparent !important;
    }
    .editar:hover, .excluir:hover, .status:hover {
        background: #f0f0f0 !important;
        color: #000 !important;
    }

    a.voltar {
        display: block;
        max-width: 120px;
        margin: 30px auto 0;
        text-align: center;
        background: #111;
        color: #fff;
        padding: 10px 0;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 3px 8px rgba(0,0,0,0.10);
        transition: background 0.3s ease;
    }
    a.voltar:hover {
        background: #000;
    }

    header {
        background-color: rgb(0, 0, 0);
        color: white;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 60px;
        margin-bottom: 0;
    }
    header img {
        height: 40px;
    }
    header nav a {
        text-decoration: none;
        color: white;
        margin-left: 20px;
        font-weight: bold;
        transition: color 0.3s;
    }
    header nav a:hover {
        color: #1abc9c;
    }
    @media (max-width: 1024px) {
    .container {
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }

    .coluna {
        width: 45%;
    }
}

@media (max-width: 768px) {
    .coluna {
        width: 100%;
        max-height: none;
    }

    header {
        flex-direction: column;
        align-items: flex-start;
        height: auto;
    }

    header nav {
        display: flex;
        flex-direction: column;
        margin-top: 10px;
        width: 100%;
    }

    header nav a {
        margin: 8px 0;
    }

    .botoes {
        flex-direction: column;
        gap: 8px;
    }

    .botoes a,
    .botoes select {
        width: 100%;
    }
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

<h2>Gerenciamento de Tarefas</h2>

<div class="container">
<?php
$statusList = ['a fazer' => 'A Fazer', 'fazendo' => 'Fazendo', 'concluído' => 'Concluído'];

foreach ($statusList as $statusKey => $statusLabel) {
    echo "<div class='coluna'>";
    echo "<h3>$statusLabel</h3>";

    $sql = "SELECT t.*, u.nome AS nome_usuario FROM tarefas t 
            JOIN usuarios u ON t.id_usuario = u.id_usuario
            WHERE t.status = '$statusKey'
            ORDER BY t.data_cadastro DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($tarefa = $result->fetch_assoc()) {
            $prioridade_class = '';
            switch ($tarefa['prioridade']) {
                case 'baixa': $prioridade_class = 'prioridade-baixa'; break;
                case 'média': $prioridade_class = 'prioridade-media'; break;
                case 'alta': $prioridade_class = 'prioridade-alta'; break;
            }

            echo "<div class='tarefa-card'>";
            echo "<div class='tarefa-info'>";
            echo "<p><strong>Descrição:</strong> " . htmlspecialchars($tarefa['descricao']) . "</p>";
            echo "<p><strong>Usuário:</strong> " . htmlspecialchars($tarefa['nome_usuario']) . "</p>";
            echo "<p><strong>Setor:</strong> " . htmlspecialchars($tarefa['setor']) . "</p>";
            echo "<p><strong>Prioridade:</strong> <span class='{$prioridade_class}'>" . ucfirst($tarefa['prioridade']) . "</span></p>";
            echo "<p><strong>Data:</strong> " . date('d/m/Y', strtotime($tarefa['data_cadastro'])) . "</p>";
            echo "</div>";

            echo "<div class='botoes'>";
            echo "<a class='editar' title='Editar' href='editartarefa.php?id=" . $tarefa['id_tarefa'] . "'>
                    <svg width='18' height='18' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M13.5 2.5a1.414 1.414 0 0 1 2 2l-9 9-2.5.5.5-2.5 9-9Z' stroke='#222' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>
                  </a>";
            echo "<a class='excluir' title='Excluir' href='excluirtarefa.php?id=" . $tarefa['id_tarefa'] . "' onclick='return confirm(\"Tem certeza que deseja excluir esta tarefa?\");'>
                    <svg width='18' height='18' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path d='M3 5h12' stroke='#222' stroke-width='2' stroke-linecap='round'/>
                        <rect x='5' y='7' width='8' height='7' rx='1.5' stroke='#222' stroke-width='2'/>
                        <path d='M7 7V5a2 2 0 0 1 4 0v2' stroke='#222' stroke-width='2'/>
                        <path d='M8 10v3M10 10v3' stroke='#222' stroke-width='2' stroke-linecap='round'/>
                    </svg>
                  </a>";
            echo "<form method='get' action='atualizarstatus.php' style='margin:0; padding:0; display:inline;'>";
            echo "<input type='hidden' name='id' value='" . $tarefa['id_tarefa'] . "'>";
            echo "<select name='status' class='status' style='font-size:0.85em;padding:2px 4px;border-radius:4px;border:1px solid #ccc;'
                    onchange='this.form.submit()'>";
            foreach ($statusList as $key => $label) {
                $selected = ($key == $statusKey) ? "selected" : "";
                echo "<option value='$key' $selected>$label</option>";
            }
            echo    "</select>
                  </form>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nenhuma tarefa nesta categoria.</p>";
    }
    echo "</div>";
}
?>
</div>

</body>
</html>
