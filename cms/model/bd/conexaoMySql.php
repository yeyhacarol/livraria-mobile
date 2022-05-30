<?php 
/* arquivo para conexão com o banco de dados; autora: Carolina Silva; data de criação: 31/03/2022; versão: 1.0
modificado em: 02/04/22 */

// criar constantes que estabelecem conexão com banco de dados. SEMPRE NECESSÁRIO!
const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = 'bcd127';
const DATABASE = 'dbBookery';

//testando se a conexão foi feita com sucesso
/* $resultado = abrirConexaoMySql();
echo($resultado); */

//abrir a conexão com o banco
function abrirConexaoMySql() {
    $conexao = array();

    //a conexão só será efetuada caso as constantes tenham valores corretos!
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    //vericando se a conexão foi feita com sucesso
    if ($conexao) {
        return $conexao;
    } else {
        return false;
    }
}

function fecharConexaoMySql($conexao) {
    mysqli_close($conexao);
}

?>