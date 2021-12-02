<div class="row">
  <div class="col-sm-12 border pt-1 pb-1 mb-4 shadow rounded">
    <h3>Confira os melhores anúncios</h3>
  </div>
</div>

<?php
      // início da consulta de categorias
  $sqlAnuncio = " SELECT * FROM tbl_produto 
    INNER JOIN tbl_categoria ON categoria_produto=cod_categoria";

// executar a instrução sql
$executaAnuncio = $mysqli->query($sqlAnuncio);

// obter o número de linhas
$totalLinhasAnuncio = $executaAnuncio->num_rows;

if ($totalLinhasAnuncio == 0) {
echo "<h1> Nenhum anúncio disponível!</h1>";
}else{

  while($dadosAnuncio = $executaAnuncio->fetch_assoc() ){ ?>

 <!-- início do bloco que deve ficar dentro do while -->
 <a href="" class="link-anuncio">
      <div class="row border-bottom mb-1 pb-1">
        <div class="col-sm-3">
        <?php if (strlen($dadosAnuncio['imagem']) > 0) {
            echo "<img src='imagens/".$dadosAnuncio['imagem']."' class='img-fluid' >";
        }else{
            echo "<img src='imagens/imagem_padrao.jpg' class='img-fluid'>";
          }
          ?>    
        </div>
        <div class="col-sm-5 titulo-anuncio">
          <p><?php echo $dadosAnuncio['nome_produto'];?> </p>
        </div>
        <div class="col-sm-2">
          <strong>R$ <?php echo $dadosAnuncio['preco'];?> </strong></p>
        </div>
      </div>
    </a>
    <!-- fim do bloco que deve ficar dentro do while -->


 <?php }//fim do while

}// fim do else

      
      ?>
   