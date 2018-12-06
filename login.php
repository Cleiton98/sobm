<?php 
        if($_POST){
            //echo "A página foi postada";
            require_once "conecta.php";
            extract($_POST);
            //Trocar esse procedimento por uma classe ou função
            $pdoSQL = $pdo->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha");
            $pdoSQL->bindValue(":email", $txtEmail);
            $pdoSQL->bindValue(":senha", md5($txtSenha));
            $pdoSQL->execute();
            $registro = $pdoSQL->fetch();
            $qtdRegistros = $pdoSQL->rowCount();
            if($qtdRegistros > 0){
                session_start();
                $_SESSION['logado'] = 1;
                $_SESSION['id'] = $registro['id'];
                $_SESSION['nome'] = $registro['nome'];
                $_SESSION['nivelUsuario'] = $registro['nivel'];
                $_SESSION['status'] = $registro['status'];
                header("location:index.php");
            }else{
                echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');</script>";
                /* $mensagem = "Usuário ou senha incorretos"; */}
    
            ///////////////////////////////////////////////////
    
    
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS v4.1.3 -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Login</title>
    </head>
    <body style="background-image:url('img/background.jpeg');">
        <div class="container">
            <div class="row format">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card1">
                        <img class="logo logoTipo img-fluid" src="img/DISTINTIVO_INSTITUCIONAL_CBMBA.png" alt="Logo do CBMBA">
                        <form action="#" class="form" method="POST">
                            <div class="form-group">
                                <label for="login">USUÁRIO</label>
                                <input type="text" class="form-control" id="login" name="txtEmail" aria-describedby="emailHelp"
                                    placeholder="Identificação de Usuário">
                            </div>
                            <div class="form-group">
                                <label for="senha">SENHA</label>
                                <input type="password" class="form-control" id="senha" name="txtSenha" placeholder="Senha">
                            </div>
                            <input type="submit" class="btn btn-primary" name="btn-entrar" value="Entrar"/>
                            <a href="#" class="recuperarSenha">Esqueceu a Senha?</a>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    
    
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <footer>
        </footer>
    </body>
</html>