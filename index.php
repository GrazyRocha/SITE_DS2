<?php  // incluir a conexao
include("connection/conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link rel="icon" href="favicon/icone.ico"> -->

  <title>Site Anúncios</title>

  <!-- Principal CSS do Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- Estilos customizados para esse template -->
  <link href="css/starter-template.css" rel="stylesheet">

  <!-- FONTAWESOME -->
  <script src="https://kit.fontawesome.com/77f3dd62a7.js" crossorigin="anonymous"></script>
  <style>
    .link-anuncio {
      color: rgb(74, 74, 74);
    }

    .link-anuncio:hover {
      color: rgb(74, 74, 74);
      text-decoration: none;
    }

    .link-anuncio .titulo-anuncio:hover {
      color: rgb(110, 10, 214);
    }
  </style>
</head>

<body cz-shortcut-listen="true">

  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(atual)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Desativado</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="https://example.com/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="#">Item</a>
            <a class="dropdown-item" href="#">Outro item</a>
            <a class="dropdown-item" href="#">Algum outro item</a>
          </div>
        </li>
      </ul>
      <div class="my-2 my-lg-0">
        <a href="login.php" class="btn btn-outline-success my-2 my-sm-0"><i class="fas fa-sign-in-alt"></i> Login</a>
      </div>
    </div>
  </nav>

  <main role="main" class="container">

    <div class="row">
      <div class="col-sm-3">
        <nav class="nav flex-column  shadow p-1 mb-5 bg-white rounded">
          <h4 class="alert alert-info text-center">Categorias</h4>
          <?php
             // início da consulta de categorias               
            $sqlCategoria = "SELECT * FROM tbl_categoria ORDER BY categoria ASC";
             
             // executar a instrução sql
             $executaCategoria = $mysqli->query($sqlCategoria);
             
             // obter o número de linhas
             $totalLinhasCategoria = $executaCategoria->num_rows;

             if ($totalLinhasCategoria == 0) {
              echo "<h1> Nenhuma categoria cadastrada!</h1>";
              }else{
             
            while ($dadosCategoria = $executaCategoria->fetch_assoc() ){ ?>

              <a class="nav-link active" href=""><?php echo $dadosCategoria['categoria'];?> </a>
             
          <?php }//fim do while       
               
               
              }  // fim do else
              ?>
          </nav>
      </div>

      <div class="col-sm-9">
        <?php

        if (isset($_GET['pg'])) {

          $pagina = $_GET['pg'];

          // verificar se o arquivo existe
          if (file_exists($pagina . ".php")) {

            include($pagina . ".php");
          } else {

            include("admin/404.php");
          }
        } else {
          // incluir o arquivo padrao de boas vindas  
          include("lista-anuncios-principal.php");
        }


        ?>
      </div>
    </div>


  </main><!-- /.container -->

  <!-- Principal JavaScript do Bootstrap
    ================================================== -->
  <!-- Foi colocado no final para a página carregar mais rápido -->
  <script src="js/jquery-3.js"></script>
  <script src="js/bootstrap.js"></script>


</body>

</html>