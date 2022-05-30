<?php 
/* arquivo responsável pela manipulação dos dados de contato. ponte entre view e model; autora: Carolina Silva; data de criação: 31/04/2022; versão: 1.0*/

/* lembrando que essas funções recebem os dados da view (front-end) e encaminham para a model (banco de dados) */

//função para inserir os contatos da view na model 
function inserirContato($dadosContato) {
    //verificando se os dados de contato está vazio
    if (!empty($dadosContato)) {
        //verificando se as caixas de texto para nome e mensagem não estão vazias, pois são os campos obrigatórios de acordo com o banco
        if (!empty($dadosContato['txtNome']) && !empty($dadosContato['txtObs'])) {
            //refatorando o array para algo com maior semântica
            $arrayDados = array(
                "nome"       => $dadosContato['txtNome'],
                "email"      => $dadosContato['txtEmail'],
                "mensagem"   => $dadosContato['txtObs']
            );

            //import da model que contém a função de inserir
            require_once('model/bd/contato.php');

            //verificando se o insert ocorreu com sucesso ou não. retornando um boolean ou um array de erro
            if (insertContato($arrayDados)) {
                return true;
            } else {
                return array(
                    'idErro'  => 1,
                    'message' => 'Não foi possível inserir no banco de dados!'
                );
            }
        } else {
            return array(
                'idErro'  => 2,
                'message' => 'Há campos obrigatórios não preenchidos!'
            );
        }
    }
}

//função para listar contatos na tela de cms
function listarContatos() {
    //importando arquivo model que possui os dados do banco
    require_once('model/bd/contato.php');

    $dados = selectAllContatos();
    if(!empty($dados)) {
        return $dados;
    } else {
        return false;
    }
}

//função para deletarmos contatos no cms
function deletarContato($id) {
    if($id != 0 && !empty($id) && is_numeric($id)) {
        require_once('model/bd/contato.php');

        if(deleteContato($id)) {
            return true;
        } else {
            return array('idErro' => 3,
                         'message' => 'Banco não conseguiu deletar registro.');
        }
    } else {
        return array('idErro'  => 4,
                     'message' => 'ID inválido ou não inserido. Exclusão impossível!');
    }
}
