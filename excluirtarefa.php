<?php
include("db/conexao.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM tarefas WHERE id_tarefa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: gerenciartarefas.php?mensagem=Tarefa excluída com sucesso");
    exit();
} else {
    echo "Erro ao excluir a tarefa.";
}
?>
