<?php
/* arquivo que manipula dados no banco; autora: Carolina Silva: data de criação; 07/04/2022; versão: 1.0 */

/* importanto arquivo para possibilitar a abertura da conexão com o banco de dados */
require_once('conexaoMySql.php');

/* função para inserir categoria no banco de dados */
function insertCategoria($categoria)
{
    /* variável para evitar criar else's que retornarão false para conseguirmos fechar a conexão com sucesso */
    $statusResposta = (bool) false;

    /* abrindo conexao com bd */
    $conexao = abrirConexaoMySql();

    /* criando script para inserir genero */
    $scriptSql = "insert into tblCategorias
                    (genero)
                    
                    values
                    ('" . strtolower($categoria['genero']) . "');";

    /* verificando se o script está correto e encaminhará dados para o bd */
    if (mysqli_query($conexao, $scriptSql)) {
        /* verificando se houveram linhas afetadas no bd */
        if (mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;
}

/* função para selecionar/listar todas categorias existentes no banco de dados */
function selectAllCategorias()
{
    /* inicializando array vazio para evitar erro */
    $arrayCategorias = array();

    /* abrir conexão com bd */
    $conexao = abrirConexaoMySql();

    /* criar script que lista todos os dados da tabela */
    $scriptSql = "select * from tblcategorias order by genero asc";

    /* armazenando retorno dos dados, trazidos através da conexão e do script, numa variável */
    $resultado =  mysqli_query($conexao, $scriptSql);

    /* se a variável resultado nos retornar algo, percorreremos cada um dos dados e os converteremos para o nosso array */
    if ($resultado) {
        $cont = 0;

        while ($resultadoCategorias = mysqli_fetch_assoc($resultado)) {
            $arrayCategorias[$cont] = array(
                'idCategoria' => $resultadoCategorias['idCategorias'],
                'genero'      => $resultadoCategorias['genero']
            );

            $cont++;
        }

        fecharConexaoMySql($conexao);
        /* SEMPRE RETORNAR O ARRAY */
        return $arrayCategorias;
    }
}

/* função para deletar categorias no banco de dados */
function deleteCategoria($idCategoria)
{
    $conexao = abrirConexaoMySql();

    $statusResposta = (bool) false;

    $scriptSql = "delete from tblcategorias where idCategorias=".$idCategoria;

    if (mysqli_query($conexao, $scriptSql)) {
        if (mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;
}

/* função para selecionar a categoria conforme o id */
function selectByIdCategoria($idCategoria)
{
    $conexao = abrirConexaoMySql();

    $scriptSql = "select * from tblCategorias where idCategorias=" . $idCategoria;

    $resultado = mysqli_query($conexao, $scriptSql);

    if ($resultado) {
        if ($resultadoDados = mysqli_fetch_assoc($resultado)) {
            $arrayCategorias = array(
                "id"     => $resultadoDados['idCategorias'],
                "genero" => $resultadoDados['genero']
            );
        }

        fecharConexaoMySql($conexao);

        return $arrayCategorias;
    }
}

function updateCategoria($categoria)
{
    $statusResposta = (bool) false;

    //abrir a conexão com o banco de dados, só assim poderemos fazer a inserção
    $conexao = abrirConexaoMySql();

    //variável para armazenar o script do banco
    $sql = "update tblcategorias set
                genero        = '" . $categoria['genero'] . "'
            where idCategorias = "  . $categoria['idCategorias'];

    //executar o script no banco. _query é a função para encaminhar o script para o banco que retorna um booleano
    //primeira validação para sabermos se o script sql está correto ou não
    if (mysqli_query($conexao, $sql)) {
        //validando se houve alguma modificação; linha acrescentada no banco de dados
        if (mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;
}
