<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Funcionários Cadastrados</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width">
        <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../style/estilo.css">

    </head>
    <body>

        <nav id="navbar">
        <navigation></navigation>
        <div style="margin-top: 50px;"><h1>Funcionários Cadastrados</h1></div>
        <div>
        <?php
         if(isset($_SESSION['privateUser'])){
             include_once "../modelo/usuario.class.php";
             $usuario = unserialize($_SESSION['privateUser']);
        if($usuario->tipo == "adm")
            {
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
        include "../modelo/funcionario.class.php";
        include "../dao/funcionariodao.class.php";

        $funcionarioDAO = new FuncionarioDAO;
        $funcionario = $funcionarioDAO->buscarFuncionario();

        if(count($funcionario) == 0) {
            echo "<h1>Não possui nenhum cadastro</h1>";
            echo "</body>";
            echo "</html>";
        }
        ?>
        <form name="pesquisa" method="post" action="">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="pesquisa"
              class="form-control" placeholder="Digite sua pesquisa">
            </div>
            <div class="form-group col-md-6">
              <select name="filtro" class="form-control">
                <option value="todos">Todos</option>
                <option value="codigo">Código</option>
                <option value="nome">Nome</option>
                <option value="email">Email</option>
                <option value="anoNascimento">Ano Nascimento</option>
                <option value="cargo">Cargo</option>
                <option value="sexo">Sexo</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" name="filtrar" value="Filtrar"
                   class="btn btn-primary btn-block">
          </div>
        </form>

        <?php
        if(isset($_POST['filtrar'])) :
          include_once "../dao/funcionariodao.class.php";
          $pesquisa = $_POST['pesquisa'];
          $filtro = $_POST['filtro'];

          $funcionarioDAO = new FuncionarioDAO;
          $funcionario = $funcionarioDAO->filtrarFuncionario($filtro, $pesquisa);

          if(count($funcionario)) :
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-condensed" style="background-color: #FFF; margin-top: 50px;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ano Nascimento</th>
                        <th>Cargo</th>
                        <th>Sexo</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($funcionario as $funcionarios) {
                        echo "<tr>";
                            echo "<td>$funcionarios->idFuncionario</td>";
                            echo "<td>$funcionarios->nome</td>";
                            echo "<td>$funcionarios->email</td>";
                            echo "<td>$funcionarios->anoNascimento</td>";
                            echo "<td>$funcionarios->cargo</td>";
                            echo "<td>$funcionarios->sexo</td>";
                            echo "<td><a href='alterar-funcionario.php?id=$funcionarios->idFuncionario' class='btn btn-warning'>Alterar</td>";
                            echo "<td><a href='buscar-funcionario.php?id=$funcionarios->idFuncionario' class='btn btn-danger'>Excluir</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
            endif;
            endif;
        if(isset($_GET['id'])) {
            $funcionarioDAO = new FuncionarioDAO;
            $funcionarioDAO->demitirFuncionario($_GET['id']);

            echo "<script type='text/javascript'>document.location = 'buscar-funcionario.php'; </script>redirecionando...";
        }
        ?>
    </div>
    </nav>
            <script src="../node_modules/vue/dist/vue.min.js"></script>
            <script src="../js/main.js"></script>

    </body>
</html>
