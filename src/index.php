<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
     content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MediAgenda - Bem-vindo</title>
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
        
        .hero-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            border: 1px solid #e2e8f0;
            padding: 50px 40px;
            max-width: 650px;
            text-align: center;
        }
        
        .hero-icon {
            font-size: 4.5rem;
            color: #2563eb;
            margin-bottom: 20px;
        }
        
        .hero-card h1 {
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 15px;
            font-size: 2.2rem;
        }
        
        .hero-card p {
            color: #64748b;
            margin-bottom: 35px;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-custom {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="hero-card">
        <i class="fa-solid fa-stethoscope hero-icon"></i>
        <h1>MediAgenda</h1>
        <p>Um sistema moderno e intuitivo para o gerenciamento de clínicas. Organize seus agendamentos, cadastre médicos e gerencie especialidades com total praticidade e eficiência no seu dia a dia.</p>
        
        <div class="actions">
            <a href="login.php" class="btn btn-primary btn-custom shadow-sm"><i class="fa-solid fa-right-to-bracket"></i> Fazer Login</a>
            <a href="cadastro.php?name=Novo%20Usuario&course=MediAgenda" class="btn btn-outline-secondary btn-custom bg-white"><i class="fa-solid fa-user-plus"></i> Cadastrar</a>
        </div>
    </div>
</body>
</html>