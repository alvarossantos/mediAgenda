<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agendador de consultas</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous">
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
        }
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 15px;
        }
        .card-login {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            border: 1px solid #e2e8f0;
            padding: 40px 30px;
        }
        .card-login h3 {
            font-weight: 700;
            color: #1e40af;
            text-align: center;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        .card-login p {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
        }
        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            transform: translateY(-1px);
        }
        .input-group-text {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-right: none;
            color: #64748b;
            border-radius: 8px 0 0 8px;
        }
        .form-control {
            border-left: none;
        }
        .form-control:focus + .input-group-text {
            border-color: #2563eb;
        }
    </style>
    <script type="text/javascript">
        function validateForm(){
            var usuarioTela = document.getElementById("usuario").value;
            var senhaTela   = document.getElementById("senha").value;
            if(usuarioTela.length == 0){
                //alert("Usuário em branco. Verifique!");
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Usuário em branco. Verifique!"                    
                });
                return false;
            }else{
                if(senhaTela.length == 0){
                    //alert("Senha em branco. Verifique!");
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Senha em branco. Verifique!"                    
                    });
                    return false;
                }else{
                    return true;
                }
            }
        }
    </script>
</head>
<body>
    <div class="login-container">
        <div class="card-login">
            <h3><i class="fa-solid fa-stethoscope me-2"></i>MediAgenda</h3>
            <p>Sistema de Agendamento de Consultas<br>Digite seu Usuário e Senha</p>
            <form role="form" 
                  action="cadastrobanco.php" 
                  method="POST"
                  class="login-form"
                  onSubmit="return validateForm()">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="usuario" id="usuario"
                               placeholder="Usuário" 
                               class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="senha" id="senha"
                               placeholder="Senha" 
                               class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(isset($_GET['erro']) && $_GET['erro'] == '1'): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Acesso Negado',
                text: 'Usuário ou senha incorretos. Verifique e tente novamente.',
                confirmButtonColor: '#2563eb'
            });
        });
    </script>
    <?php endif; ?>
</body>
</html>