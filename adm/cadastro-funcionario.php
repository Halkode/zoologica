<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Funcionário</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../style/estilo.css">
        <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <style>
        body {
          position: relative;
          overflow: auto;
          padding-top: 4em;
          padding-bottom: 4em;
          min-height: 100vh;
          font-family: "Raleway", sans-serif;
          font-size: 16px;
          font-weight: 500;
          line-height: 1.5;
          display: flex;
          flex-direction: row;
          justify-content: center;
          align-items: flex-start;
          color: currentcolor;
          background: radial-gradient(#dc3545 6%, transparent 6%), #6495ED;
          background-position: 0 0, 5px 5px;
          background-size: 5px 5px;
        }
        form{
        margin-left: 30%;
        margin-top: 40px;
        padding: 5px;
        }
        .form-inline{
              padding: 3px;
        }
        #caixa{
            margin-left:20%;
        }
        </style>
    </head>
    <body>
    <div id="navbar">
        <navigation></navigation>
        <?php
         if(isset($_SESSION['privateUser'])){
             include_once "../modelo/usuario.class.php";
             $usuario = unserialize($_SESSION['privateUser']);
             if($usuario->tipo == "adm"){
             }
         }
         ?>
         <div><h1>Cadastro de Funcionário</h1></div>
        <hr>
        <?php
        if(!isset($_SESSION['privateUser'])){
           echo "Você não tem permissão para acessar essa página";
           echo "<script src='../node_modules/vue/dist/vue.min.js'></script>";
           echo "<script src='../js/main.js'></script>";
           echo "</body>";
           echo "</html>";
           die();
        }
        ?>
        <?php
        if(isset($_SESSION['erros'])) {
            $erros = unserialize($_SESSION['erros']);
            foreach($erros as $erro) {
                echo "<br>".$erro;
            }
            $post = unserialize($_SESSION['post']);

            unset($_SESSION['erros']);
        }
        ?>
        <div id="caixa">
        <div id="alinhamento">
         <form name="cadastro" method="post" action="../controle/controle-funcionario.php" class="form-group">
        <div class="form-inline">
          <input type="text" name="nome" placeholder="Digite o Nome" autofocus
          required pattern="^[A-zÁù ]{2,40}$" class="form-control" value="<?php echo $post['nome'] ?? ""; ?>">
        </div>
        <div class="form-inline">
          <input type="email" name="email" placeholder="Digite o email" class="form-control" value="<?php echo $post['email'] ?? ""; ?>">
        </div>
        <div class="form-inline">
          <input type="number" name="anoNascimento" placeholder="Digite Ano de Nascimento" class="form-control" value="<?php echo $post['anoNascimento'] ?? ""; ?>">
        </div>
            <div class="form-inline">
                <label>
                    <input type="radio" name="sexo" value="Masculino" required pattern="^(Masculino|Feminino)$" class="radio-inline">
                    Masculino
                </label>
                <label>
                    <input type="radio" name="sexo" value="Feminino" required pattern="^(Masculino|Feminino)$" class="radio-inline">
                    Feminino
                </label>
            </div>
            <div class="form-inline">
              <label>Cargo: </label>
                <select name="cargo" class="form-control">
                <option value="Faxineiro(a)">Faxineiro(a)</option>
                <option value="Atendente">Atendente</option>
                <option value="Fiscal">Fiscal</option>
                <option value="Seguranca">Segurança</option>
                <option value="Medicina Veterinaria">Medicina Veterinária</option>
              </select>
            </div>
        <div>
          <input type="submit" value="Cadastrar" class="btn btn-info">
        </div>
      </form>
    </div>
    </div>
            <script src="../node_modules/vue/dist/vue.min.js"></script>
            <script src="../js/main.js"></script>
    </body>
</html>
