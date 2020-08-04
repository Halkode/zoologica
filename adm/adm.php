<?php
session_start();
ob_start();
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width">
        <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../style/estilo.css">

        <title>Administração</title>
    </head>
    <body>
    <div>
    <nav id="navbar">
        <?php
         if(isset($_SESSION['privateUser'])){
             include_once "../modelo/usuario.class.php";
             $usuario = unserialize($_SESSION['privateUser']);
             if($usuario->tipo == "adm"){
         ?>
            <navigation></navigation>
         <?php
             }
         }
         ?>

       <?php
       if(isset($_SESSION['privateUser'])){
           include_once "../modelo/usuario.class.php";
           $usuario = unserialize($_SESSION['privateUser']);
           echo "<h2>Olá {$usuario->login}, seja bem vindo!</h2>";
       ?>

       <form name="deslogar" method="post" action="">
         <div class="form-group">
           <input type="submit" name="deslogar" value="Sair" class="btn btn-primary">
         </div>
       </form>
       <?php
       if(isset($_POST['deslogar'])){
         unset($_SESSION['privateUser']);
         header("location:adm.php");
       }

       } else {
       ?>
       <div id="caixa2">
       <form name="login" method="post" action="adm.php" class="form-group">
         <div class="form-group">
           <input type="text" name="login" placeholder="Login" class="form-control">
         </div>
         <div class="form-group">
           <input type="password" name="senha" placeholder="Digite sua senha" class="form-control">
         </div>
         <div class="form-group">
           <select name="tipo" class="form-control">
             <option value="adm">Adm</option>
             <option value="visitante">Visitante</option>
           </select>
         </div>
         <div class="form-group">
           <input type="submit" name="entrar" value="Entrar" class="btn btn-primary">
           <a href="../index.php">cancelar</a>
         </div>
       </form>
       </div>
       <?php
       }
       ?>


       <?php
        if (isset($_POST['entrar'])) {

        include '../modelo/usuario.class.php';
        include '../dao/usuariodao.class.php';
        include '../util/seguranca.class.php';

        $usuario = new Usuario();
        $usuario->login = $_POST['login'];
        $usuario->senha = Seguranca::criptografar($_POST['senha']);
        $usuario->tipo = $_POST['tipo'];
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->verificarUsuario($usuario);

        if ($usuario == null) {
          echo "<h2>Usuário e/ou senha inválido(s)!</h2>";
        } else {
           $_SESSION['privateUser'] = serialize($usuario);
           header("location:adm.php");
        }
       }
       ?>

    </nav>

    </div>

    <script src="../node_modules/vue/dist/vue.min.js"></script>
    <script src="../js/main.js"></script>
    </body>

    </html>
