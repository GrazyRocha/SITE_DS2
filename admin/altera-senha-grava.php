<?php 
include('verifica-logado.php');

// receber os campos do formulario
$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];
$confirma_nova_senha = $_POST['confirma_nova_senha'];

$_SESSION['erro'] = array();
$_SESSION['dadosFormulario'] = $_POST;

$cod_login = $_SESSION['cod_login'];

include('../connection/conexao.php');
$senhaAtualBanco = "SELECT MD5('$senha_atual') AS senha ";
$executaSenhaAtual = $mysqli->query($senhaAtualBanco);
$dadosSenhaAtual = $executaSenhaAtual->fetch_assoc();
$senha_atual = $dadosSenhaAtual['senha'];

if ( $senha_atual <> $_SESSION['senha'] ) {

    $_SESSION['erro'][]='Senha atual nao confere.';

} // fim do valida senha atual

if (strlen($nova_senha) < 6 ) {
    $_SESSION['erro'][]= 'A nova senha deve ter no minimo 6 caracteres.';
} // fim valida tamanho nova senha

if ($nova_senha <> $confirma_nova_senha) {
   $_SESSION['erro'][]='Nova senha e confirmação nao conferem.';
} // fim do confirma senha

if (sizeof($_SESSION['erro']) > 0 ) {

    header("location:index.php?pg=altera-senha&erro=erro");

}else{
    //atualizar a senha no banco

    $sqlAtualizaSenha = "UPDATE tbl_login SET senha=MD5('$nova_senha') WHERE cod_login='$cod_login' ";
    $executaAtualizaSenha = $mysqli->query($sqlAtualizaSenha);

    if ($executaAtualizaSenha==true) {

       header("location:index.php?pg=altera-senha&msg=Senha alterada com sucesso!");

        unset($_SESSION['erro']);
        unset($_SESSION['dadosFormulario']);

    }else{

        $_SESSION['erro'][]='Nao foi possivel alterar a senha. Contate o suporte!';
        header("location:index.php?pg=altera-senha&erro=erro");
    }
}
?> 