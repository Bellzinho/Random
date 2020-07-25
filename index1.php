<?php
  require_once "conexao.php";
  /* Botão de update */
  if(isset($_REQUEST['update_id']))
  {
    try
    {
      $row = array();
      $id = $_REQUEST['update_id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable
      $select_stmt = $db->prepare('SELECT * FROM waifus WHERE id =:id'); //sql select query
      $select_stmt->bindParam(':id',$id);
      $select_stmt->execute(); 
      $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
      extract($row);
    }
    catch(PDOException $e)
    {
      $e->getMessage();
    }
	}
  /* Botão de delet */
  if(isset($_REQUEST['delete_id'])){
    // select record from db to delete
    $id=$_REQUEST['delete_id']; //get delete_id and store in $id variable
        
    $select_stmt= $db->prepare('SELECT * FROM waifus WHERE id =:id');   //sql select query
    $select_stmt->bindParam(':id',$id);
    $select_stmt->execute();
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
        
    //Deletando o registro no banco
    $delete_stmt = $db->prepare('DELETE FROM waifus WHERE id =:id');
    $delete_stmt->bindParam(':id',$id);
    $delete_stmt->execute();
	
    header("Location:index1.php");
  }
  if(isset($_POST['txt_nome']))
  {
    if(isset($_REQUEST['update_id']) && !empty($_REQUEST['update_id'])){
      $personagem = $_POST['txt_nome'];  //Campo de texto: Nome
      $anime = $_POST['txt_anime'];      //Campo de texto: Anime
      $genero = $_POST['selec_genero'];    //Selec de genero
      try
      {
        $id = $_REQUEST['update_id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable
        $update_stmt = $db->prepare('UPDATE waifus SET NOME = :wnome, GENERO = :wgenero, ANIME = :wanime WHERE id =:id'); //sql select query
        $update_stmt->bindParam(':wnome', $personagem);
        $update_stmt->bindParam(':wgenero', $genero);
        $update_stmt->bindParam(':wanime', $anime);
        $update_stmt->bindParam(':id',$id);
        $update_stmt->execute(); 

      }
      catch(PDOException $e)
      {
        $e->getMessage();
      }
    }
    else{
      $personagem = $_POST['txt_nome'];  //Campo de texto: Nome
      $anime = $_POST['txt_anime'];      //Campo de texto: Anime
      $genero = $_POST['selec_genero'];    //Selec de genero
      //$img = */
      if(empty($personagem)){
        $errorMsg = "Por favor coloque o nome do personagem!";
      }
      else if(empty($anime)){
        $errorMsg = "Por favor coloque o anime que o personagem pertence!";
      }
      /*elseif(empty($img)){
        $errorMsg = "Por favor insira uma imagem do nome do personagem!";
      }*/
      else{
        try {
          if(!isset($errorMsg)){
            
            $insert_stmt=$db->prepare('INSERT INTO `waifus`(NOME,GENERO,ANIME) VALUES(:wnome,:wgenero,:wanime)');
            $insert_stmt->bindParam(':wnome', $personagem);
            $insert_stmt->bindParam(':wgenero', $genero);
            $insert_stmt->bindParam(':wanime', $anime);

            if($insert_stmt->execute()){
              $insertMsg="Waifu cadastrada com Sucesso! você ja pode dar um Pull ^^";

            }
          }
        } catch (PDOException $e) {
          echo $e->getMessage();
        } 
      }
    }
  }

  
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Random Waifu</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules\bootstrap\dist\css\bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- Scripts -->
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Fonts Awesome -->
    <script src="https://kit.fontawesome.com/35483405b7.js" crossorigin="anonymous"></script>
    <!-- Prograss Bar-->
    <script src="js\progressbar.min.js"></script>
    <!-- Parallax -->
    <script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
    
  </head>
    
  <body>

    <header>
    <div class="container" id="nav-container">
      <!-- add essa class -->
      <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="index1.php">
        <img src="imagens/waifu_logo.png" id="logo" 
            alt="ZERO TWO">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RANDOM WAIFUS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbar-links">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="#" id="home-menu">Home</a>
            <a class="nav-item nav-link" href="" id="waifu-cad">Waifus cadastradas</a>
            <a class="nav-item nav-link" href="" id="cad-waifu">Cadastro</a>
          </div>
        </nav>
      </div>
    </header>
    <main >
      <!-- Slider -->
      <div class="container-fluid">
        <div id="mainSlider" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
            <li data-target="#mainSlider" data-slide-to="1"></li>
            <li data-target="#mainSlider" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="imagens\Best-Waifu-Husbando-2019.png" class="d-block h-100 w-100" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h2 id="txtcarrosel">Registre suas Waifus!</h2>
                <p id="txtcarrosel">Coloque suas waifus ou husbando preferidos!</p>
                <a class="main-btn"  href="#txt-title-cadastro">Registre aqui!</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="imagens\A66.png" class="d-block h-100 w-100" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h2 id="txtcarrosel">Teste sua sorte!</h2>
                <p id="txtcarrosel">Já registrou suas waifus? Rolete por elas para ver o que a sorte te reserva!</p>
                <a class="main-btn" href="#">De um roll!</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="imagens\842336.png" class="d-block h-100 w-100" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h2 id="txtcarrosel">Edite sua waifu list</h2>
                <p id="txtcarrosel">Edite suas waifus registradas ou apague aquelas que você nao gosta mais!</p>
                <a class="main-btn" href="#">Edite suas waifus</a>
              </div>
            </div>
          </div>
          <a href="#mainSlider" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
          </a>
          <a href="#mainSlider" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
          </a>
        </div>
      </div>
      <!-- Cadastros -->
      <div id="cadastro">
        <div class="container-fluid" id="cad_exb">
          <div class="row">
            <div class="col-12" >
              <h3 class="main-title">Cadastre sua Waifu</h3>
            </div>
            <!-- Cadastro -->
            <div class="col-md-5">
              <div id="test">
                <div class="container" id="container-pd">
                  <div class="row">
                    <div class="col-12 ">
                      <h2 id="txt-title-cadastro" class="main-title">Cadastro</h2>
                    </div>
                    <form method="POST" id="Form">
                      <p id="title">Nome</p>
                      <input value="<?php if(isset($_REQUEST['update_id'])) {echo $row['NOME'];} ?>" for="nome" id="form" type="text" name="txt_nome" id="nome">
                      <p id="title">Anime</p>
                      <input value="<?php if(isset($_REQUEST['update_id'])) {echo $row['ANIME'];} ?>" for="anime" id="form" type="text" name="txt_anime" id="anime">
                      
                      <p id="title">Genero</p>
                      <select id="formSelect" name="selec_genero">
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Nenhum">Nenhum</option>
                      </select>
                      <div class="form-group">
                        <input form="formImage" class="center" id="formImage" type="file" class="form-control-file" id="exampleFormControlFile1" name="imagem" id="imagem">
                      </div>
                      <div id="cad">
                        <input type="submit" id="btn-form" value="<?php if(isset($_REQUEST['update_id'])) {echo "Atualizar";} else {echo "Cadastrar";}?>">
                      </div>
                    </form>
                    <!-- Em construção 
                      <?php
                        if(isset($errorMsg))
                        {
                      ?>
                        <div class="alert alert-danger">
                          <strong><?php echo $errorMsg; ?></strong>
                        </div>
                      <?php
                      }
                        if(isset($insertMsg)){
                      ?>
                        <div class="alert alert-success">
                          <strong><?php echo $insertMsg; ?></strong>
                        </div>
                      <?php
                      }
                      ?>
                      -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-1">
              
            </div>
            <div class="col-md-6">
              <div id="test">
                <div class="container" id="container-pd">
                  <div class="row">
                    <div class="col-12">
                      <h2 id="txt-title-cadastro" class="main-title">Waifus</h2>
                    </div>
                      <?php
                        $select_stmt=$db->prepare("SELECT * FROM waifus");	//sql select query
                        $select_stmt->execute();
                        while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                        {
                      ?>
                        <div class="col-md-4">
                          <div class="card">
                            <img src="" class="card-img-top" alt="">
                            <div id="card-body" class="card-body">
                              <h5 class="card-title text-center"><?php echo $row['NOME']?></h5>
                              <p id="txt-card" class="card-text">Anime:<?php echo $row['ANIME']?> </p>
                              <p id="txt-card" class="card-text">Genero: <?php echo $row['GENERO']?></p>
                            </div>
                            <hr>
                            <div id="card-body" class="card-body">
                              <a href="index1.php?update_id=<?php echo $row['ID']; ?>" class="card-link">Editar</a>
                              <a href="index1.php?delete_id=<?php echo $row['ID'];?>" class="card-link">Excluir</a>
                            </div>
                          </div>
                        </div>
                      <?php
                        }
                      ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    </main>


    
    <!-- JS -->
    <script src="js/scripts.js"></script>
  </body>
</html>