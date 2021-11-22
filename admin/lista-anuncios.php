<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Anúncios</li>
  </ol>
</nav>
<div class="card mb-5">
  <div class="row card-body">
    <div class="col-sm-9">
      <h4>Anúncios</h4>
    </div>

    <div class="col-sm-3">
      <a href="index.php?pg=form-anuncio&operacao=cadastrar" title="Nova Categoria">
        <i class="far fa-plus-square"></i> Novo Anúncio
      </a>
    </div>
  </div>
</div>

<!-- receber e exibir a mensagem que está sendo enviada via GET  -->

<?php
if (isset($_GET['msg'])) {
  echo "<div class='alert alert-success'>" . $_GET['msg'] . "</div>";
}


  $cod_login = $_SESSION['cod_login'];  

  // criar a consulta para exibir as categorias
  $sql = " SELECT * FROM tbl_produto 
                    INNER JOIN tbl_categoria ON categoria_produto=cod_categoria
          WHERE produto_usuario='$cod_login' ";

  // incluir a conexao
  include("../connection/conexao.php");

  // executar a instrução sql
  $executa = $mysqli->query($sql);

  // obter o número de linhas
  $totalLinhas = $executa->num_rows;

  if ($totalLinhas < 1) {
    echo "<div class='row'>
            <div class='col-sm-6'> Não existem anúncios cadastrados. </div>
          </div>";
  } else {

    while ($dados = $executa->fetch_assoc()) { ?>

      <div class="row border-bottom">
        <div class="col-sm-3"> 
          <?php if (strlen($dados['imagem']) > 0) {
            echo "<img src='../imagens/".$dados['imagem']."' widht='120' height='120' >";
          }else{
            echo "<img src='../imagens/imagem_padrao.jpg' widht='120' height='120' >";
          }
          ?>    
      </div>
        <div class="col-sm-7"> 
          <p> <?php echo $dados['categoria'];?> </p>
          <p><?php echo '#'.$dados['cod_produto'].' - '.$dados['nome_produto'];?> </p>
          <p>R$ <?php echo $dados['preco'];?> </p>
        </div>  
        <div class="col-sm-1 text-right">
          <a href="index.php?pg=form-anuncio&operacao=editar&cod_produto=<?php echo $dados['cod_produto'];?>">
          <i class="fas fa-edit"></i>Editar</a>
        </div>
        <div class="col-sm-1">
          <a href="#" data-toggle="modal" data-target="#modalDeletaAnuncio" data-whatever="<?php echo $dados['cod_produto'];?>"
          data-title="<?php echo $dados['nome_produto'];?>">
            <i class="fas fa-trash-alt"></i> Excluir</a>
        </div>
      </div>

  <?php } // fim do while

  } // fim do else

  ?>
<div class="modal fade" id="modalAlertCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="POST" action="acoes.anuncio.php">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova mensagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="text-center">
          Tem certeza que deseja excluir o anuncio "<span id="tituloAnuncio"></span>"?
        </h4>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Sim</button>
        <input type="hidden" name="operacao" value="excluir">
        <input type="hidden" name="cod_produto" value="" id="cod_produto">
      </div>
    </div></form>
  </div>
</div>

  <script>
    $(document).ready( function(){ 
      $('#modalDeletaAnuncio').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever') // Extrai informação dos atributos data-*
  var tituloAnuncio = button.data('title')
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-body').html(recipient)
  $('#tituloAnuncio').html(tituloAnuncio)
  $('#cod_produto').val(recipient)
 })

    } );
  </script>

