<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Animais Domesticos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width">
        <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../style/estilo.css">

    </head>
    <body>

    <div id="navbar">
        <navigation></navigation>
        <div style="margin-top: 50px;"><h1>Animais Domesticos</h1></div>
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
        include "../modelo/animal.class.php";
        include "../dao/animaldao.class.php";

        $animalDAO = new AnimalDAO;
        $animal = $animalDAO->buscarAnimais();

        if(count($animal) == 0) {
            echo "<h1>A aguia não encontrou nenhum animal!</h1>";
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
                <option value="peso">Peso</option>
                <option value="anoNascimento">Ano Nascimento</option>
                <option value="especie">Espécie</option>
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
          include_once "../dao/animaldao.class.php";
          $pesquisa = $_POST['pesquisa'];
          $filtro = $_POST['filtro'];

          $animalDAO = new AnimalDAO;
          $animal = $animalDAO->filtrarAnimal($filtro, $pesquisa);

          if(count($animal)) :

        ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-condensed" style="background-color: #FFF">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Peso</th>
                        <th>Ano Nascimento</th>
                        <th>Espécie</th>
                        <th>Sexo</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($animal as $animal) {
                        echo "<tr>";
                            echo "<td>$animal->idAnimal</td>";
                            echo "<td>$animal->nome</td>";
                            echo "<td>$animal->peso</td>";
                            echo "<td>$animal->anoNascimento</td>";
                            echo "<td>$animal->especie</td>";
                            echo "<td>$animal->sexo</td>";
                            echo "<td><a href='alterar-animal.php?id=$animal->idAnimal' class='btn btn-warning' id='app'>Alterar</td>";
                            echo "<td><a href='buscar-animal.php?id=$animal->idAnimal' class='btn btn-danger'>Excluir</td>";
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
            $animalDAO = new AnimalDAO;
            $animalDAO->deletarAnimal($_GET['id']);

            echo "<script type='text/javascript'>document.location = 'buscar-animal.php'; </script>redirecionando...";
        }
        ?>
    </div>
    </div>
            <script src="../node_modules/vue/dist/vue.min.js"></script>
            <script src="../js/main.js"></script>

    </body>
</html>
