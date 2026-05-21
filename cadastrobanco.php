<?php
    require_once("conexao.php");// importar o conexao.php para esta página
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    
    /* VALIDA O ACESSO AO SISTEMA */

    //zerar as sessões:
    session_start();
    $_SESSION["cod_usuario"] = "";
    
    //$conexao_bd = mysqli_connect($host_bd, $login_bd, $password_bd,$nome_bd, $port);
    //$conectar = mysql_select_db($nome_bd, $conexao_bd);

    //conferir se o usuário está preenchido
    //conferir se a senha está preenchida
    if(strlen($usuario) > 0 && strlen($senha) > 0){
        $sql = "SELECT * FROM usuario WHERE username = '$usuario'";
        
        $result = mysqli_query($conexao_bd,$sql); //pega o resultado da query e lança num array
        
        if($consulta = mysqli_fetch_assoc($result)){ //leitura do array
            $cod_usuario = $consulta['cod_usuario'];
            $nome        = $consulta['nome'];
            $password    = $consulta['pass'];
            
            if(
                strtoupper(ltrim(rtrim($senha))) == 
                strtoupper(ltrim(rtrim($password)))
            ){
                //usuário autenticado!
                $_SESSION["cod_usuario"] = $cod_usuario;
                header("location:principal.php");
                exit;
            }else{
                //usuário não autenticado
                header("location:login.php?erro=1");
                exit;
            }
        }else{
            header("location:login.php?erro=1");
            exit;
        }
    }else{
        header("location:login.php?erro=1");
        exit;
    }
    //validar no banco de dados
    //ir para página autenticada
    //ou retornar para index
    /*
    echo "Cadastrar no banco o $usuario com a $senha <br>";

    echo "<a href='index.php'>Retornar</a>";*/
?>