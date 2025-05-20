<?php
include("db/conexao.php");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $novo_status = $_GET['status'];

    $status_validos = ['a fazer', 'fazendo', 'concluído'];
    if (!in_array($novo_status, $status_validos)) {
        die("Status inválido.");
    }

    $sql = "UPDATE tarefas SET status = ? WHERE id_tarefa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $novo_status, $id);

    if ($stmt->execute()) {
        header("Location: gerenciartarefas.php?mensagem=Status atualizado com sucesso");
        exit();
    } else {
        echo "Erro ao atualizar o status: " . $conn->error;
    }
} else {
    echo "Parâmetros inválidos.";
}
?>
