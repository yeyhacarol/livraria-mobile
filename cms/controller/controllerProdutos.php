<?php
function inserirProduto($dadosProduto, $file)
{
    $nomeFoto = (string) null;
    $destacar = (int) 0;

    if (!empty($dadosProduto)) {
        if (
            !empty($dadosProduto['txtTitulo']) && !empty($dadosProduto['txtAutor']) && !empty($dadosProduto['txtDescricao'])
            && !empty($dadosProduto['txtPreco']) && !empty($dadosProduto['sltCategorias'] && !empty($file['fileFoto']['name']))
        ) {
            if ($file['fileFoto']['name'] != null) {
                require_once('modulo/upload.php');

                $nomeFoto = uploadFile($file['fileFoto']);

                if (is_array($nomeFoto)) {
                    return $nomeFoto;
                }

                if ($dadosProduto['chkDestacar']) {
                    if ($dadosProduto['chkDestacar'] == 'on') {
                        $destacar = 1;
                    }
                }
            }

            $arrayDados = array(
                "titulo"        => $dadosProduto['txtTitulo'],
                "autor"         => $dadosProduto['txtAutor'],
                "descricao"     => $dadosProduto['txtDescricao'],
                "foto"          => $nomeFoto,
                "preco"         => $dadosProduto['txtPreco'],
                "desconto"      => $dadosProduto['txtDesconto'] ? $dadosProduto['txtDesconto'] : 0,
                "destacar"      => $destacar,
                "idCategorias"  => $dadosProduto['sltCategorias']
            );

            require_once('model/bd/produto.php');

            if (insertProduto($arrayDados)) {
                return true;
            } else {
                return array(
                    'idErro'  => 1,
                    'message' => 'Não foi possível inserir dados no banco.'
                );
            }
        } else {
            return array(
                'idErro'  => 2,
                'message' => 'Há campos obrigatórios não preenchidos.'
            );
        }
    }
}

function buscarProduto($id)
{
    if ($id != 0 && !empty($id) && is_numeric($id)) {
        require_once('model/bd/produto.php');

        $dados = selectByIdProduto($id);

        if (!empty($dados)) {
            return $dados;
        } else {
            return false;
        }
    } else {
        return array(
            'idErro'  => 4,
            'message' => 'Não foi possível buscar registro. ID inválido.'
        );
    }
}

function atualizarProduto($dadosProduto, $arrayDados)
{
    $statusUpload = (bool) false;

    $id = $arrayDados['id'];
    $foto = $arrayDados['foto'];
    $file = $arrayDados['file'];

    $destacar = (int) 0;

    if (!empty($dadosProduto)) {
        if (
            !empty($dadosProduto['txtTitulo']) && !empty($dadosProduto['txtAutor']) && !empty($dadosProduto['txtDescricao'])
            && !empty($dadosProduto['txtPreco']) && !empty($dadosProduto['sltCategorias'])
        ) {

            if ($id != 0 && !empty($id) && is_numeric($id)) {
                if ($file['fileFoto']['name'] != null) {

                    require_once('modulo/upload.php');

                    $novaFoto = uploadFile($file['fileFoto']);

                    $statusUpload = true;
                } else {
                    $novaFoto = $foto;
                }

                if (isset($dadosProduto['chkDestacar'])) {
                    if ($dadosProduto['chkDestacar'] == 'on') {
                        $destacar = 1;
                    }
                }

                $arrayDados = array(
                    "id"           => $id,
                    "titulo"       => $dadosProduto['txtTitulo'],
                    "autor"        => $dadosProduto['txtAutor'],
                    "descricao"    => $dadosProduto['txtDescricao'],
                    "foto"         => $novaFoto,
                    "preco"        => $dadosProduto['txtPreco'],
                    "desconto"     => $dadosProduto['txtDesconto'] ? $dadosProduto['txtDesconto'] : 0,
                    "destacar"     => $destacar,
                    "idCategorias" => $dadosProduto['sltCategorias'],
                );
                
                require_once('model/bd/produto.php');
                require_once('modulo/config.php');

                if (updateProduto($arrayDados)) {
                    if ($statusUpload) {
                        unlink(FILE_DIRECTORY_UPLOAD . $foto);
                    }
                    return true;
                } else {
                    return array(
                        'idErro'  => 1,
                        'message' => 'Não foi possível editar dados no banco.'
                    );
                }
            } else {
                return array(
                    'idErro'  => 4,
                    'message' => 'Não foi possível editar registro. ID inválido ou não inserido.'
                );
            }
        } else {
            return array(
                'idErro'  => 2,
                'message' => 'Algum campo obrigatório não preenchido.'
            );
        }
    }
}

function deletarProduto($arrayDados)
{
    $id = $arrayDados['id'];
    $foto = $arrayDados['foto'];

    if ($id != 0 && !empty($id) && is_numeric($id)) {
        require_once('model/bd/produto.php');
        require_once('modulo/config.php');

        if (deleteProduto($id)) {
            if ($foto != null) {
                if (unlink(FILE_DIRECTORY_UPLOAD . $foto)) {
                    return true;
                } else {
                    return array(
                        'idErro'  => 5,
                        'message' => 'O banco conseguiu deletar registro, mas a imagem não foi excluída do diretório no servidor.'
                    );
                }
            } else {
                return true;
            }
        } else {
            return array(
                'idErro'  => 3,
                'message' => 'O banco não conseguiu deletar registro.'
            );
        }
    } else {
        return array(
            'idErro'  => 4,
            'message' => 'Não foi possível excluir registro. ID inválido ou não inserido.'
        );
    }
}

function listarProdutos()
{
    require_once('model/bd/produto.php');

    $dados = selectAllProdutos();
    if (!empty($dados)) {
        return $dados;
    } else {
        return false;
    }
}

?>
