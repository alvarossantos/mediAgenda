<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
    content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MediAgenda - Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; 
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .card-cadastro {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            border: 1px solid #e2e8f0;
            padding: 40px 30px;
            width: 100%;
            max-width: 450px;
        }
        
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
        }
        
        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="card-cadastro">
        <h3 class="text-center mb-2" style="color: #1e40af; font-weight: 700;">
            <i class="fa-solid fa-user-plus me-2"></i>Criar Conta
        </h3>
        <p class="text-center text-muted mb-4">Preencha os dados abaixo para se cadastrar.</p>
        
        <form action="processar_cadastro.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label text-secondary fw-bold" style="font-size: 0.9rem;">Nome Completo</label>
                <input type="text" name="nome" id="nome" placeholder="Ex: João Silva" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-secondary fw-bold" style="font-size: 0.9rem;">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Ex: joao@email.com" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label text-secondary fw-bold" style="font-size: 0.9rem;">Nome de Usuário</label>
                <input type="text" name="username" id="username" placeholder="Crie um nome de usuário" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="senha" class="form-label text-secondary fw-bold" style="font-size: 0.9rem;">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Crie uma senha" class="form-control" required>
            </div>
            <div class="d-flex gap-2">
                <a href="index.php" class="btn btn-outline-secondary w-50">
                    <i class="fa-solid fa-arrow-left me-1"></i> Voltar
                </a>
                <button type="submit" class="btn btn-primary w-50">
                    <i class="fa-solid fa-check me-1"></i> Cadastrar
                </button>
            </div>
        </form>
    </div>
</body>
</html>