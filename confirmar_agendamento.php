<?php
session_start();
require_once("conexao.php");

if (!isset($_SESSION['cod_usuario'])) {
    http_response_code(401);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['sucesso' => false, 'mensagem' => 'Acesso não autorizado.']);
    exit;
}

/* ============================================================
   confirmar_agendamento.php
   Endpoint chamado via fetch() para confirmar um agendamento.

   Método esperado : POST
   Parâmetro       : id (int) — id do agendamento
   Retorno         : JSON  { "sucesso": true }
                        ou { "sucesso": false, "mensagem": "..." }
============================================================ */

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido.']);
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'mensagem' => 'ID inválido.']);
    exit;
}

$sql  = "UPDATE agendamentos SET status = 'Confirmado' WHERE id = ?";
$stmt = mysqli_prepare($conexao_bd, $sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao preparar a query.']);
    mysqli_close($conexao_bd);
    exit;
}

mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo json_encode(['sucesso' => true]);
} else {
    http_response_code(404);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Agendamento não encontrado ou já está confirmado.']);
}

mysqli_stmt_close($stmt);
mysqli_close($conexao_bd);