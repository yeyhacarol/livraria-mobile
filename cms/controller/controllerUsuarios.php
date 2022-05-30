<?php
/* arquivo de manipulação dos dados de usuários e validação dos mesmos; autora: Carolina Silva; data de criação: 14/04/2022; versão: 1.0 */

/* função para inserir usuários na model */
function inserirUsuario($usuario)
{
    /* validando se o usuario existe */
    if (!empty($usuario)) {
        /* validando campos obrigatórios */
        if (!empty($usuario['txtNome']) && !empty($usuario['txtLogin']) && !empty($usuario['txtSenha'])) {
            /* se os campos obrigatórios estiverem preenchidos, criar novo array refatorando os nomes dos campos */
            $arrayUsuarios = array(
                "nome"  => $usuario['txtNome'],
                "login" => $usuario['txtLogin'],
                "senha" => $usuario['txtSenha']
            );

            /* importaremos a model que contém função para inserção no banco de dados */
            require_once('model/bd/usuario.php');

            /* verificando se a inserção pôde ocorrer, se não retornaremos mensagens de erro */
            if (insertUsuario($arrayUsuarios)) {
                return true;
            } else {
                return array(
                    'idErro'  => 1,
                    'message' => 'Não foi possível inserir no banco de dados.'
                );
            }
        } else {
            return array(
                'idErro'  => 2,
                'message' => 'Campos obrigatórios não preenchidos.'
            );
        }
    }
}

/* função para listar usuários cadastrados */
function listarUsuarios()
{
    /* importar model */
    require_once('model/bd/usuario.php');

    $usuarios = selectAllUsuarios();
    if (!empty($usuarios)) {
        return $usuarios;
    } else {
        return false;
    }
}

/* função para excluir usuario */
function deletarUsuario($idUsuario)
{
    /* validando o id */
    if ($idUsuario != 0 && !empty($idUsuario) && is_numeric($idUsuario)) {
        /* import da model */
        require_once('model/bd/usuario.php');

        if (deleteUsuario($idUsuario)) {
            return true;
        } else {
            return array(
                'idErro'  => 3,
                'message' => 'Banco não conseguiu deletar usuário.'
            );
        }
    } else {
        return array(
            'idErro'  => 4,
            'message' => 'ID inválido.'
        );
    }
}

/* função para buscar o usuario a ser editado */
function buscarUsuario($idUsuario)
{
    /* validando o id */
    if ($idUsuario != 0 && !empty($idUsuario) && is_numeric($idUsuario)) {
        require_once('model/bd/usuario.php');

        /* buscando usuário */
        $usuarios = selectByIdUsuario($idUsuario);

        /* retornando uma resposta, sendo ela true o retorno do usuário clicado ou false/mensagem de erro */
        if (!empty($usuarios)) {
            return $usuarios;
        } else {
            return false;
        }
    } else {
        return array(
            'idErro'  => 4,
            'message' => 'ID inválido.'
        );
    }
}

/* função para atualizar o usuário */
function atualizarUsuario($usuario, $idUsuario)
{
    if (!empty($usuario)) {
        /* verificando se os campos obrigatórios não estão vazios */
        if (!empty($usuario['txtNome']) && !empty($usuario['txtLogin']) && !empty($usuario['txtSenha'])) {
            /* validando o id */
            if ($idUsuario != 0 && !empty($idUsuario) && is_numeric($idUsuario)) {
                $arrayUsuario = array(
                    "idUsuario" => $idUsuario,
                    "nome"      => $usuario['txtNome'],
                    "login"     => $usuario['txtLogin'],
                    "senha"     => $usuario['txtSenha']
                );

                require_once('model/bd/usuario.php');

                if (updateUsuario($arrayUsuario)) {
                    return true;
                } else {
                    return array(
                        'idErro'  => 1,
                        'message' => 'Não foi possível editar no banco.');
                }
            } else {
                return array(
                    'idErro'  => 4,
                    'message' => 'Não conseguimos editar registro. ID inválido ou não inserido.');
            }
        } else {
            return array(
                'idErro'  => 2,
                'message' => 'Algum campo obrigatório não preenchido.');
        }
    }
}
