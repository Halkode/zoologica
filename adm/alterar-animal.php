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
        <title>Alterar Animal</title>
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
         if(isset($_SESSION['privateUser'])){
             include_once "../modelo/usuario.class.php";
             $usuario = unserialize($_SESSION['privateUser']);
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
          include "../modelo/animal.class.php";
          include "../dao/animaldao.class.php";

          $animalDAO = new AnimalDAO;
          $array = $animalDAO->filtrarAnimal("codigo",$_GET['id']);

          $animal = $array[0];
        }
        ?>

        <div style="margin-top: 50px;"><h1>Alterar Animal Domestico</h1></div>
        <div id="caixa" style="padding: 30px;">
        <form name="alterar" method="post" action="alterar-animal.php" class="form-group">
          <div class="form-inline" hidden>
            <input type="text" name="codigo" value="<?php echo $animal->idAnimal ?? ""; ?>"
             class="form-control">
          </div>
        <div  class="form-inline">
          <input type="text" name="nome" placeholder="Digite o nome" autofocus required pattern="^[A-zÁù ]{2,40}$" value="<?php echo $animal->nome ?? ""; ?>"  class="form-control">
        </div>
        <div  class="form-inline">
          <input type="number" name="peso" placeholder="Digite o peso" required pattern="^([0-9]{1,2}(,|.)[0-9]{1,2}|[0-9]{1,2})$" value="<?php echo $animal->peso ?? ""; ?>"  class="form-control">
        </div>
        <div  class="form-inline">
          <input type="number" name="anoNascimento" placeholder="Digite o ano" required pattern="^[0-9]{4}$" value="<?php echo $animal->anoNascimento ?? ""; ?>"  class="form-control">
        </div>
        <div  class="form-inline">
          <select name="especie"  class="form-control" required pattern="^(Cachorro|Gato|Tartaruga|Peixe|Passáro)$">
            <option value="Cachorro" <?php if(isset($animal)) if($animal->especie == 'Cachorro') echo 'selected'; ?>>Cachorro</option>
            <option value="Gato" <?php if(isset($animal)) if($animal->especie == 'Gato') echo 'selected'; ?>>Gato</option>
            <option value="Tartaruga" <?php if(isset($animal)) if($animal->especie == 'Tartaruga') echo 'selected'; ?>>Tartaruga</option>
            <option value="Peixe" <?php if(isset($animal)) if($animal->especie == 'Peixe') echo 'selected'; ?>>Peixe</option>
            <option value="Passaro" <?php if(isset($animal)) if($animal->especie == 'Passaro') echo 'selected'; ?>>Passaro</option>
          </select>
        </div>
            <div class="radio">
                <label>
                    <input type="radio" name="sexo" value="Macho" required pattern="^(Macho|Femea)$ " <?php if(isset($animal)) if($animal->sexo == 'Macho') echo 'checked'; ?> >
                    Macho
                </label>
                <label>
                    <input type="radio" name="sexo" value="Femea" required pattern="^(Macho|Femea)$" <?php if(isset($animal)) if($animal->sexo == 'Femea') echo 'checked'; ?>>
                    Femea
                </label>
            </div>
        <div>
          <input type="submit" name="alterar" value="Alterar"  class="btn btn-primary">
        </div>
      </form>
      </div>
      <?php
      if(isset($_POST['alterar'])) {

          include_once '../modelo/animal.class.php';
          include_once '../dao/animaldao.class.php';

          $animal = new Animal;

          $animal->idAnimal = $_POST['codigo'];
          $animal->nome = $_POST['nome'];
          $animal->peso = $_POST['peso'];
          $animal->anoNascimento = $_POST['anoNascimento'];
          $animal->especie = $_POST['especie'];
          $animal->sexo = $_POST['sexo'];

          $animalDAO = new AnimalDAO;
          $animalDAO->alterarAnimal($animal);

          echo "<script type='text/javascript'>document.location = 'buscar-animal.php'; </script>redirecionando...";
      }
      ?>

      </div>
       <script src="../node_modules/vue/dist/vue.min.js"></script>
       <script src="../js/main.js"></script>
    </body>
</html>
