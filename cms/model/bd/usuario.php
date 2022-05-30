<?php
/* arquivo para manipular dados do banco de dados; autora: Carolina Siva; data de criação: 14/04/2022; versão: 1.0 */

/* importar aaquivo para abrir conexão com banco de dados */
require_once('conexaoMySql.php');

/* função de inserção dos dados no banco de dados */
function insertUsuario($usuario) {
    $statusResposta = (bool) false;

    /* abrindo conexão com banco */
    $conexao = abrirConexaoMySql();

    /* script responsável por inserir dados na tabela */
    $scriptSql = "insert into tblUsuarios
                    (nome,
                     login,
                     senha)
                     
                     values
                     ('".$usuario['nome']."',
                      '".$usuario['login']."',
                      '".$usuario['senha']."' )";

    /* verificando se a conexão e o script encaminharam dados ao banco */
    if (mysqli_query($conexao, $scriptSql)) {
        /* verificando se houverão linhas afetadas, ou seja, se houve inserção */
        if (mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    /* fechando conexão com banco de dados */
    fecharConexaoMySql($conexao);
    return $statusResposta;

}

/* função para listar os dados de usuário */
function selectAllUsuarios() {
    $arrayUsuarios = array();

    /* abrir conexão com o banco */
    $conexao = abrirConexaoMySql();

    /* criar script de listagem */
    $scriptSql = "select * from tblusuarios";

    /* armazenando numa variável o resultado da conexão e do script */
    $resultado = mysqli_query($conexao, $scriptSql);

    /* converter dados para um array semântico que além disso também listará todos os dados.
        se tudo der certo, percorreremos todo o array de dados e o converteremos. */
    if ($resultado) {
        $cont = 0;

        while ($resultadoUsuarios = mysqli_fetch_assoc($resultado)) {
            $arrayUsuarios[$cont] = array(
                'idUsuario'  => $resultadoUsuarios['idUsuario'],
                'nome'       => $resultadoUsuarios['nome'],
                'login'      => $resultadoUsuarios['login'],
                'senha'      => $resultadoUsuarios['senha']
            );

            $cont++;
        }

        fecharConexaoMySql($conexao);
        return $arrayUsuarios;
    }
}

/* função de deletar usuario no bd */
function deleteUsuario($idUsuario) { 
    $conexao = abrirConexaoMySql();

    $statusResposta = (bool) false;

    $scriptSql = "delete from tblusuarios where idUsuario=".$idUsuario;

    if (mysqli_query($conexao, $scriptSql)) {
        if (mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;

}

/* função para buscar usuario conforme o id */
function selectByIdUsuario($idUsuario) {
    /* abrindo conex]ao com bd */
    $conexao = abrirConexaoMySql();

    /* criando script para seleção de acordo com o id */
    $scriptSql = "select * from tblUsuarios where idUsuario =".$idUsuario;

    /* armazenando o encaminhamento/retorno em uma variável */
    $resultado = mysqli_query($conexao, $scriptSql);

    if ($resultado) {
        if ($resultadoDados = mysqli_fetch_assoc($resultado)) {
            $arrayUsuarios = array(
                "id"    => $resultadoDados['idUsuario'],
                "nome"  => $resultadoDados['nome'],
                "login" => $resultadoDados['login'],
                "senha" => $resultadoDados['senha']
            );
        }

        fecharConexaoMySql($conexao);
        return $arrayUsuarios;
    }
}

/* função para finalmente editar usuário */
function updateUsuario($usuario) {
    $statusResposta = (bool) false;

    $conexao = abrirConexaoMySql();

    $scriptSql = "update tblUsuarios set
                    nome   = '".$usuario['nome']."',
                    login  = '".$usuario['login']."',
                    senha  = '".$usuario['senha']."'
                where idUsuario = ".$usuario['idUsuario'];

    if (mysqli_query($conexao, $scriptSql)) {
        if(mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;
}


