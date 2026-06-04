<?php
session_start();
require_once("conexao.php"); // importar o conexao.php para esta página

if (!isset($_SESSION['cod_usuario'])) {
    header("Location: login.php");
    exit;
}

$cod_usuario = $_SESSION['cod_usuario'];
$mensagem = "";
$tipo_mensagem = "";

/* ============================================================
   PROCESSAMENTO DE AÇÕES (POST) - ATUALIZAR PERFIL
============================================================ */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebendo os dados do formulário
    $nome_post     = $_POST['nome'];
    $email_post    = $_POST['email'];
    $username_post = $_POST['username'];
    $senha_atual   = $_POST['senha_atual'];
    $senha_nova    = $_POST['senha_nova'];

    // Busca a senha atual no banco de dados para validar
    $sql_check = "SELECT pass FROM usuario WHERE cod_usuario = '$cod_usuario'";
    $res_check = mysqli_query($conexao_bd, $sql_check);
    
    if ($row_check = mysqli_fetch_assoc($res_check)) {
        // Verifica se a senha informada como atual confere com a do banco
        if ($row_check['pass'] === $senha_atual) {
            
            // Se uma nova senha foi digitada, usamos ela. Caso contrário, mantemos a antiga.
            $senha_db = !empty($senha_nova) ? $senha_nova : $row_check['pass'];
            
            // Prepara a query de update
            $sql_update = "UPDATE usuario SET 
                            nome = '$nome_post', 
                            email = '$email_post', 
                            username = '$username_post', 
                            pass = '$senha_db' 
                           WHERE cod_usuario = '$cod_usuario'";
                           
            if (mysqli_query($conexao_bd, $sql_update)) {
                $mensagem = "Seu perfil foi atualizado com sucesso!";
                $tipo_mensagem = "success";
            } else {
                $mensagem = "Erro ao atualizar perfil: " . mysqli_error($conexao_bd);
                $tipo_mensagem = "error";
            }
        } else {
            $mensagem = "A senha atual informada está incorreta.";
            $tipo_mensagem = "error";
        }
    }
}

/* ============================================================
   BUSCA OS DADOS ATUALIZADOS DO OPERADOR
============================================================ */
$sql = "SELECT * FROM usuario WHERE cod_usuario = '$cod_usuario'";
$result = mysqli_query($conexao_bd, $sql);

if ($consulta = mysqli_fetch_assoc($result)) {
    $operadorNome     = $consulta['nome'];
    $operadorEmail    = $consulta['email'];
    $operadorUsername = $consulta['username'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediAgenda - Meu Perfil</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <!-- ================ CDNs ================ -->
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- ================ ESTILOS DA APLICAÇÃO ================ -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --azul-primario: #2563eb;
            --azul-escuro:   #1e40af;
            --azul-claro:    #eff6ff;
            --cinza-fundo:   #f8fafc;
            --cinza-borda:   #e2e8f0;
            --texto-escuro:  #0f172a;
            --sidebar-larg:  260px;
        }

        body {
            background-color: var(--cinza-fundo);
            font-family: 'Inter', sans-serif;
            color: var(--texto-escuro);
            overflow-x: hidden;
        }

        /* NAVBAR SUPERIOR */
        .navbar-topo {
            background: linear-gradient(90deg, var(--azul-primario) 0%, var(--azul-escuro) 100%);
            height: 60px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1030;
        }
        .navbar-topo .navbar-brand { color: #fff; font-weight: 600; font-size: 1.25rem; }
        .navbar-topo .navbar-brand i { margin-right: 8px; }
        .btn-sanduiche {
            background: transparent; border: none; color: #fff;
            font-size: 1.3rem; padding: 6px 12px; border-radius: 6px; transition: 0.2s;
        }
        .btn-sanduiche:hover { background: rgba(255,255,255,0.15); }
        .operador-toggle {
            background: transparent; border: none; color: #fff; display: flex;
            align-items: center; gap: 8px; padding: 6px 12px; border-radius: 30px;
        }
        .operador-toggle:hover { background: rgba(255,255,255,0.15); }
        .operador-toggle i.fa-circle-user { font-size: 1.6rem; }
        
        .dropdown-menu-operador {
            min-width: 220px; border-radius: 10px; border: none;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        .dropdown-menu-operador .dropdown-item i { width: 22px; color: var(--azul-primario); }

        /* SIDEBAR LATERAL */
        .sidebar {
            position: fixed; top: 60px; left: 0; width: var(--sidebar-larg);
            height: calc(100vh - 60px); background: #fff;
            border-right: 1px solid var(--cinza-borda); padding: 20px 0;
            transition: transform 0.3s ease; z-index: 1020; overflow-y: auto;
        }
        .sidebar.oculta { transform: translateX(calc(var(--sidebar-larg) * -1)); }
        .sidebar .nav-link {
            color: var(--texto-escuro); padding: 12px 20px;
            border-left: 3px solid transparent; display: flex; align-items: center; gap: 12px;
        }
        .sidebar .nav-link i { width: 22px; color: var(--azul-primario); font-size: 1.05rem; }
        .sidebar .nav-link:hover {
            background: var(--azul-claro); border-left-color: var(--azul-primario); color: var(--azul-escuro);
        }

        /* Overlay para mobile */
        .sidebar-overlay {
            display: none; position: fixed; top: 60px; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4); z-index: 1010;
        }
        .sidebar-overlay.ativo { display: block; }

        /* CONTEÚDO PRINCIPAL */
        .conteudo-principal {
            margin-top: 60px; margin-left: var(--sidebar-larg); padding: 25px;
            transition: margin-left 0.3s ease; min-height: calc(100vh - 60px);
        }
        .conteudo-principal.expandido { margin-left: 0; }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(calc(var(--sidebar-larg) * -1)); }
            .sidebar.aberta { transform: translateX(0); }
            .conteudo-principal { margin-left: 0; }
        }

        /* PAGE HEADER E CARD */
        .page-header h2 { font-size: 1.4rem; font-weight: 700; color: var(--azul-escuro); margin-bottom: 22px; }
        .page-header h2 i { color: var(--azul-primario); margin-right: 10px; }

        .card-pagina {
            background: #fff; border-radius: 16px; border: 1px solid var(--cinza-borda);
            padding: 30px 24px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); max-width: 800px;
        }
        
        .form-label {
            font-weight: 500;
            color: #475569;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: var(--azul-primario);
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
        }
        .btn-salvar {
            padding: 10px 24px;
            font-weight: 600;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <!-- NAVBAR SUPERIOR -->
    <nav class="navbar-topo d-flex align-items-center justify-content-between px-3">
        <div class="d-flex align-items-center gap-2">
            <button class="btn-sanduiche" id="btnSanduiche" title="Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <a class="navbar-brand mb-0 d-flex align-items-center" href="principal.php">
                <i class="fa-solid fa-stethoscope"></i>
                <span>MediAgenda</span>
            </a>
        </div>

        <div class="dropdown">
            <button class="operador-toggle" type="button" id="dropdownOperador" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-circle-user"></i>
                <span class="d-none d-md-inline"><?php echo htmlspecialchars($operadorNome); ?></span>
                <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem;"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-operador" aria-labelledby="dropdownOperador">
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user"></i><?php echo htmlspecialchars($operadorNome); ?></a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-envelope"></i><?php echo htmlspecialchars($operadorEmail); ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="perfil.php"><i class="fa-solid fa-gear"></i>Configurações</a></li>
                <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Sair</a></li>
            </ul>
        </div>
    </nav>

    <!-- SIDEBAR LATERAL -->
    <aside class="sidebar" id="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="principal.php"><i class="fa-solid fa-calendar-days"></i> Calendário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastro_agendas.php"><i class="fa-solid fa-calendar-plus"></i> Agendamentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastro_medicos.php"><i class="fa-solid fa-user-doctor"></i> Cadastro de Médicos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastro_especialidades.php"><i class="fa-solid fa-list-check"></i> Cadastro de Especialidades</a>
            </li>
        </ul>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="conteudo-principal" id="conteudoPrincipal">

        <div class="page-header">
            <h2><i class="fa-solid fa-id-badge"></i> Meu Perfil</h2>
        </div>

        <div class="card-pagina">
            <form action="perfil.php" method="POST">
                
                <h5 class="mb-4 text-primary"><i class="fa-solid fa-user-pen me-2"></i>Dados Pessoais</h5>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($operadorNome); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($operadorEmail); ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label for="username" class="form-label">Nome de Usuário (Login)</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($operadorUsername); ?>" required>
                    </div>
                </div>

                <hr class="my-4 text-muted">

                <h5 class="mb-4 text-primary"><i class="fa-solid fa-lock me-2"></i>Segurança</h5>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="senha_atual" class="form-label">Senha Atual <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="senha_atual" name="senha_atual" placeholder="Digite para confirmar alterações" required>
                        <div class="form-text">Obrigatório para realizar qualquer alteração.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="senha_nova" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="senha_nova" name="senha_nova" placeholder="Deixe em branco para manter a mesma">
                    </div>
                </div>

                <div class="mt-4 pt-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-salvar">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Salvar Alterações
                    </button>
                </div>

            </form>
        </div>

    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // ==================================================
        // SIDEBAR TOGGLE
        // ==================================================
        var btnSanduiche = document.getElementById('btnSanduiche');
        var sidebar = document.getElementById('sidebar');
        var conteudoPrincipal = document.getElementById('conteudoPrincipal');
        var sidebarOverlay = document.getElementById('sidebarOverlay');

        btnSanduiche.addEventListener('click', function() {
            if (window.innerWidth <= 991.98) {
                sidebar.classList.toggle('aberta');
                sidebarOverlay.classList.toggle('ativo');
            } else {
                sidebar.classList.toggle('oculta');
                conteudoPrincipal.classList.toggle('expandido');
            }
        });
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('aberta');
            sidebarOverlay.classList.remove('ativo');
        });
    </script>

    <?php if ($mensagem !== ""): ?>
    <script>
        Swal.fire({
            icon: '<?php echo $tipo_mensagem; ?>',
            title: '<?php echo $tipo_mensagem === "success" ? "Sucesso!" : "Atenção"; ?>',
            text: '<?php echo $mensagem; ?>',
            confirmButtonColor: '#2563eb'
        });
    </script>
    <?php endif; ?>

</body>
</html>