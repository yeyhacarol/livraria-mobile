<?php
require_once('conexaoMySql.php');

function insertProduto($dadosProduto)
{
    $statusResposta = (bool) false;

    $conexao = abrirConexaoMySql();

    $scriptSql = "insert into tblprodutos
                    (titulo, 
                     autor, 
                     descricao, 
                     foto, 
                     preco, 
                     desconto, 
                     destacar, 
                     idCategorias)
                     
                     values(
                         '" . $dadosProduto['titulo'] . "',
                         '" . $dadosProduto['autor'] . "',
                         '" . $dadosProduto['descricao'] . "',
                         '" . $dadosProduto['foto'] . "',
                         "  . $dadosProduto['preco'] . ",
                         "  . $dadosProduto['desconto'] . ",
                         "  . $dadosProduto['destacar'] . ",
                         "  . $dadosProduto['idCategorias'] . ");";

    if (mysqli_query($conexao, $scriptSql)) {
        if (mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;
}

function deleteProduto($id)
{
    $statusResposta = (bool) false;

    $conexao = abrirConexaoMySql();

    $scriptSql = "delete from tblprodutos where idProduto=" . $id;

    if (mysqli_query($conexao, $scriptSql)) {
        if (mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;
}

function selectByIdProduto($id)
{
    $conexao = abrirConexaoMySql();

    $scriptSql = "select * from tblprodutos where idproduto=" . $id;

    $resposta = mysqli_query($conexao, $scriptSql);

    if ($resposta) {
        if ($respostaDados = mysqli_fetch_assoc($resposta)) {

            $arrayDados = array(
                "id"            => $respostaDados['idProduto'],
                "titulo"        => $respostaDados['titulo'],
                "autor"         => $respostaDados['autor'],
                "descricao"     => $respostaDados['descricao'],
                "foto"          => $respostaDados['foto'],
                "preco"         => $respostaDados['preco'],
                "desconto"      => $respostaDados['desconto'],
                "precoDescontado" => $respostaDados['precoDescontado'],
                "destacar"      => $respostaDados['destacar'],
                "idCategorias"  => $respostaDados['idCategorias']
            );
        }

        fecharConexaoMySql($conexao);
        return $arrayDados;
    }
}

function updateProduto($dadosContato)
{
    $statusResposta = (bool) false;

    $conexao = abrirConexaoMySql();

    $scriptSql = "update tblprodutos set
                    titulo       = '" . $dadosContato['titulo'] . "',
                    autor        = '" . $dadosContato['autor'] . "',
                    descricao    = '" . $dadosContato['descricao'] . "',
                    foto         = '" . $dadosContato['foto'] . "',
                    preco        =  " . $dadosContato['preco'] . ",
                    desconto     =  " . $dadosContato['desconto'] . ",
                    destacar     = '" . $dadosContato['destacar'] . "',
                    idCategorias = '" . $dadosContato['idCategorias'] . "'

                 where idproduto = "  . $dadosContato['id'];

    if (mysqli_query($conexao, $scriptSql)) {
        $statusResposta = true;   
    }

    
    fecharConexaoMySql($conexao);
    return $statusResposta;
}

function selectAllProdutos()
{   
    $conexao = abrirConexaoMySql();

    $scriptSql = "select * from tblprodutos inner join tblcategorias on tblprodutos.idCategorias = tblcategorias.idcategorias;";
   
    $resultado = mysqli_query($conexao, $scriptSql);

    if ($resultado) {
        $cont = 0;

        while ($resultadoDados = mysqli_fetch_assoc($resultado)) {
            $arrayDados[$cont] = array(
                "id"           => $resultadoDados['idProduto'],
                "titulo"       => $resultadoDados['titulo'],
                "autor"        => $resultadoDados['autor'],
                "descricao"    => $resultadoDados['descricao'],
                "foto"         => $resultadoDados['foto'],
                "preco"        => $resultadoDados['preco'],
                "desconto"     => $resultadoDados['desconto'],
                "precoDescontado" => $resultadoDados['precoDescontado'],
                "destacar"     => $resultadoDados['destacar'],
                "idCategorias" => $resultadoDados['idCategorias'],
                "genero" => $resultadoDados['genero']
            );

            $cont++;
        }

        fecharConexaoMySql($conexao);

        if (isset($arrayDados)) {
            return $arrayDados;
        } else {
            return false;
        }
    }
}

?>