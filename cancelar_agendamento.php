<?php
session_start();
require_once("conexao.php");

if (!isset($_SESSION['cod_usuario'])) {
    header("Location: login.php");
    exit;
}

$cod_usuario = $_SESSION["cod_usuario"];
$nomeUsuario = "";
$emailUsuario = "";
$sql = "SELECT * FROM usuario WHERE cod_usuario = '$cod_usuario'";

$result = mysqli_query($conexao_bd, $sql);

if ($consulta = mysqli_fetch_assoc($result)) {
    $nomeUsuario = $consulta["nome"];
    $emailUsuario = $consulta["email"];
}

$operadorNome = $nomeUsuario;
$operadorEmail = $emailUsuario;

/* ============================================================
   cancelar_agendamento.php
   Endpoint chamado via fetch() pelo principal.php para
   cancelar (status = 'Cancelado') um agendamento pelo id.

   Método esperado : POST
   Parâmetro       : id (int) — id do agendamento
   Retorno         : JSON  { "sucesso": true }
                        ou { "sucesso": false, "mensagem": "..." }
============================================================ */

// Garante que a resposta será sempre JSON
header('Content-Type: application/json; charset=utf-8');

/* ============================================================
   VALIDAÇÃO DA REQUISIÇÃO
============================================================ */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(array('sucesso' => false, 'mensagem' => 'Método não permitido.'));
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(array('sucesso' => false, 'mensagem' => 'ID inválido.'));
    exit;
}

/* ============================================================
   CANCELAMENTO DO AGENDAMENTO
   Utiliza exclusão lógica: atualiza o status para 'Cancelado'
   em vez de remover o registro fisicamente da tabela.

   Para exclusão física, substitua o UPDATE por:
   $sql = 'DELETE FROM agendamentos WHERE id = ?';
============================================================ */

$sql  = "UPDATE agendamentos SET status = 'Cancelado' WHERE id = ?";
$stmt = mysqli_prepare($conexao_bd, $sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(array('sucesso' => false, 'mensagem' => 'Erro ao preparar a query.'));
    mysqli_close($conexao_bd);
    exit;
}

mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) === 0) {
    http_response_code(404);
    echo json_encode(array('sucesso' => false, 'mensagem' => 'Agendamento não encontrado ou já cancelado.'));
    mysqli_stmt_close($stmt);
    mysqli_close($conexao_bd);
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conexao_bd);

/* ============================================================
   RESPOSTA DE SUCESSO
============================================================ */
echo json_encode(array('sucesso' => true));
