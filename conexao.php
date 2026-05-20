<?php
// Para usar variáveis de ambiente, primeiro instale o pacote `phpdotenv` via Composer:
// no terminal, na pasta do projeto, execute: composer require vlucas/phpdotenv

// Carrega as dependências do Composer, incluindo o autoloader do phpdotenv.
// __DIR__ garante que o caminho é sempre relativo ao arquivo atual (conexao.php).
require_once __DIR__ . '/vendor/autoload.php';

// Carrega as variáveis de ambiente do arquivo .env que está na raiz do projeto.
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Pega as credenciais do banco de dados das variáveis de ambiente.
// Usar `$_ENV` é a forma recomendada para acessar as variáveis carregadas.
$host_bd     = $_ENV['DB_HOST'];
$port        = $_ENV['DB_PORT'];
$nome_bd     = $_ENV['DB_DATABASE'];
$login_bd    = $_ENV['DB_USERNAME'];
$password_bd = $_ENV['DB_PASSWORD'];

$conexao_bd = mysqli_connect($host_bd, $login_bd, $password_bd, $nome_bd, $port);

// É uma boa prática verificar se a conexão foi bem-sucedida.
if (!$conexao_bd) {
    // Em um ambiente de produção, você deve logar o erro em vez de exibi-lo na tela.
    die("Erro de conexão com o banco de dados: " . mysqli_connect_error());
}
?>
