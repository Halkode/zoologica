<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width">
        <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../style/estilo.css">
        <title>Alterar Funcionário</title>

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
        if(isset($_GET['id'])) {
          include "../modelo/funcionario.class.php";
          include "../dao/funcionariodao.class.php";

          $funcionarioDAO = new FuncionarioDAO;
          $array = $funcionarioDAO->filtrarFuncionario("codigo",$_GET['id']);

          $funcionario = $array[0];
        }
        ?>
        <div style="margin-top: 50px;"><h1>Alterar Funcionário</h1></div>
        <div id="caixa" style="padding: 30px;">
        <form name="alterar" method="post" action="alterar-funcionario.php" class="form-group">
          <div class="form-inline" hidden>
            <input type="text" name="codigo" value="<?php echo $funcionario->idFuncionario ?? ""; ?>" class="form-control">
          </div>
        <div class="form-inline">
          <input type="text" name="nome" placeholder="Digite o nome" autofocus required pattern="^[A-zÁù ]{2,40}$" autofocus value="<?php echo $funcionario->nome ?? ""; ?>" class="form-control">
        </div>
        <div class="form-inline">
          <input type="email" name="email" placeholder="Digite o email" required pattern="^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{1,3})+$" value="<?php echo $funcionario->email ?? ""; ?>" class="form-control">
        </div>
        <div class="form-inline">
          <input type="number" name="anoNascimento"
                 placeholder="Digite o ano " value="<?php echo $funcionario->anoNascimento ?? ""; ?>" required pattern="^[0-9]{4}$" class="form-control">
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="sexo" value="Masculino" required pattern="^(Masculino|Feminino)$ " <?php if(isset($funcionario))  if($funcionario->sexo == 'Masculino') echo 'checked'; ?>>
                Masculino
            </label>
            <label>
                <input type="radio" name="sexo" value="Feminino" required pattern="^(Macho|Feminino)$" <?php if( isset($funcionario) ) if($funcionario->sexo == 'Feminino')  echo 'checked' ?>>
                Feminino
            </label>
        </div>
		<div class="form-inline">
          <select name="cargo" class="form-control">
            <option value="Faxineiro(a)" <?php if(isset($funcionario)) if($funcionario->cargo == 'Faxineiro(a)') echo 'selected'; ?>>Faxineiro(a)</option>
            <option value="Atendente" <?php if(isset($funcionario)) if($funcionario->cargo == 'Atendente') echo 'selected'; ?>>Atendente</option>
            <option value="Fiscal" <?php if(isset($funcionario)) if($funcionario->cargo == 'Fiscal') echo 'selected'; ?>>Fiscal</option>
            <option value="Seguranca" <?php if(isset($funcionario)) if($funcionario->cargo == 'Seguranca') echo 'selected'; ?>>Segurança</option>
            <option value="Medicina Veterinaria" <?php if(isset($funcionario)) if($funcionario->cargo == 'Medicina Veterinaria') echo 'selected'; ?>>Medicina Veterinaria</option>
          </select>
        </div>
        <div>
          <input type="submit" name="alterar" value="Alterar" class="btn btn-info">
        </div>
      </form>
      </div>
      <?php
      if(isset($_POST['alterar'])) {

          include_once '../modelo/funcionario.class.php';
          include_once '../dao/funcionariodao.class.php';

          $funcionario = new Funcionario;

          $funcionario->idFuncionario = $_POST['codigo'];
          $funcionario->nome = $_POST['nome'];
          $funcionario->email = $_POST['email'];
          $funcionario->anoNascimento = $_POST['anoNascimento'];
          $funcionario->sexo = $_POST['sexo'];
          $funcionario->cargo = $_POST['cargo'];

          $funcionarioDAO = new FuncionarioDAO;
          $funcionarioDAO->alterarFuncionario($funcionario);

          echo "<script type='text/javascript'>document.location = 'buscar-funcionario.php'; </script>redirecionando...";
      }
      ?>

      </div>
       <script src="../node_modules/vue/dist/vue.min.js"></script>
       <script src="../js/main.js"></script>
    </body>
</html>
