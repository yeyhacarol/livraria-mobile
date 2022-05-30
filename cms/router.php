<?php
/* arquivo de rota para receber requisições da view  e enviar para controler pois a view não pode manipular diretamente o banco; 
autora: Carolina Silva; data de criação: 31/03/2022; versão: 1.0 */

//declarando as variáveis presentes na action do form na index.html
$component = (string) null;
$action = (string) null;

//verificando o método da requisição do form
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
    //recebendo dados via url
    $component = strtoupper($_GET['component']);
    $action = strtoupper($_GET['action']);

    //identificando quem está fazendo a requisição
    switch ($component) {
        case 'CONTATOS':
            //importando controller
            require_once('./controller/controllerContatos.php');

            //se a action for de enviar contato
            if ($action == 'ENVIAR') {
                //chamaremos a função para inserir no banco
                $promessa = inserirContato($_POST);

                //se o retorno for um booleano, significa que deu certo! se for um array deu errado
                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo ("<script>alert('Feedback enviado!')
                             window.location.href='../index.html';</script>");
                    }
                } else if (is_array($promessa)) {
                    echo ("<script>alert('Acho que você esqueceu de preencher algo!')
                         window.history.back();</script>");
                }
                //se a action for de deletar mensagem
            } elseif ($action == 'DELETAR') {
                $idContato = $_GET['id'];

                $promessa = deletarContato($idContato);

                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo ("<script>alert('Feedback apagado!')
                            window.location.href='contatos.php';</script>");
                    }
                } elseif (is_array($promessa)) {
                    echo ("<script>alert('Tivemos problemas para apagar.')
                         window.history.back();</script>;");
                }
            }

            break;
        
        /* se for categoria */
        case 'CATEGORIAS':
            /* import da controller que faz as devidas validações etc */
            require_once('./controller/controllerCategorias.php');

            /* verificando se a ação é de inserir */
            if ($action == 'INSERIR') {
                /* se sim, chamaremos a função de inserir */
                $promessa = inserirCategoria($_POST);

                /* enviando mensagens caso a inserção tenha ocorrido com sucesso ou se o campo não foi preenchido*/
                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo ("<script>alert('Categoria inserida!')
                        window.location.href='categorias.php';</script>");
                    }
                } elseif (is_array($promessa)) {
                    echo ("<script>alert('Acho que você esqueceu de colocar a categoria!')
                             window.history.back();</script>");
                }
            } elseif ($action == 'DELETAR') {
                $idCategoria = $_GET['id'];

                $promessa = deletarCategoria($idCategoria);

                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo ("<script>alert('Categoria apagada!')
                        window.location.href='categorias.php';</script>");
                    }
                } elseif (is_array($promessa)) {
                    echo ("<script>alert('Tivemos problemas para apagar.')
                         window.history.back();</script>;");
                }
            } elseif ($action == 'BUSCAR') {
                $idCategoria = $_GET['id'];

                $categorias = buscarCategoria($idCategoria);

                session_start();

                $_SESSION['categorias'] = $categorias;

                require_once('categorias.php');
            } elseif ($action == 'EDITAR') {
                $idCategoria = $_GET['id'];

                $promessa = atualizarCategoria($_POST, $idCategoria);

                /*verificando o tipo de dado retornado. se for um booleano, verificará se é verdadeiro e emitirá uma mensagem de sucesso,
                  caso contrário, verificará se é um array nesse caso emitirá uma mensagem de erro */
                if(is_bool($promessa)) {
                    if($promessa) {
                        echo("<script>
                            alert('Categoria atualizada com sucesso!') 
                            window.location.href = 'categorias.php'; 
                        </script>");
                    }  
                } elseif (is_array($promessa)) {
                    echo("<script>
                            alert('Não foi possível editar.') 
                            window.history.back(); 
                        </script>");
                }
            } 

            break;

        case 'USUARIOS':
            require_once('controller/controllerUsuarios.php');

            if ($action == 'INSERIR') {
                $promessa = inserirUsuario($_POST);

                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo("<script>alert('Usuário inserido!')
                        window.location.href='usuarios.php';</script>");
                    }
                } elseif (is_array($promessa)) {
                    echo ("<script>alert('Acho que você esqueceu de preencher algum campo!')
                             window.history.back();</script>");
                }
            } elseif ($action == 'DELETAR') {
                $idUsuario = $_GET['id'];

                $promessa = deletarUsuario($idUsuario);

                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo ("<script>alert('Usuário apagado!')
                         window.location.href='usuarios.php';</script>");
                    }
                } elseif (is_array($promessa)) {
                    echo ("<script>alert('Tivemos problemas para apagar.')
                         window.history.back();</script>;");
                }
            } elseif ($action == 'BUSCAR') {
                /* resgatando id via get (url) */
                $idUsuario = $_GET['id'];

                /* buscando usuário de acordo com id */
                $usuarios = buscarUsuario($idUsuario);

                /* iniciando variável de sessão para conseguirmos resgatar os valores e colocarmos nos campos */
                session_start();

                $_SESSION['usuarios'] = $usuarios;

                /* carregamento da tela */
                require_once('usuarios.php');
            } elseif ($action == 'EDITAR') {
                $idUsuario = $_GET['id'];

                $promessa = atualizarUsuario($_POST, $idUsuario);

                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo ("<script>alert('Usuário modificado!')
                         window.location.href='usuarios.php';</script>");
                    }
                } elseif (is_array($promessa)) {
                    echo ("<script>alert('Não foi possível editar.') 
                     window.history.back();</script>");
                }
            }

            break;

        case 'PRODUTOS':
           require_once('./controller/controllerProdutos.php');

            if ($action == 'INSERIR') {
                if (isset($_FILES) && !empty($_FILES)) {
                   $promessa = inserirProduto($_POST, $_FILES);
                } else {
                    echo("<script>alert('".$promessa['message']."') 
                    window.history.back();</script>");
                }

                if (is_bool($promessa)) {
                   if ($promessa) {
                       echo("<script>alert('Produto inserido com sucesso!') 
                       window.location.href = 'produtos.php';</script>");
                    }
                } elseif (is_array($promessa)) {
                    echo("<script>alert('".$promessa['message']."') 
                    window.history.back();</script>");
                }
            } elseif ($action == 'DELETAR') {
                $idProduto = $_GET['id'];
                $foto = $_GET['foto'];

                $arrayDados = array(
                    "id"   => $idProduto,
                    "foto" => $foto
                );

                $promessa = deletarProduto($arrayDados);

                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo("<script>alert('Produto excluído com sucesso!') 
                        window.location.href = 'produtos.php'; </script>");
                    }
                } elseif (is_array($promessa)) {
                    echo("<script>alert('".$promessa['message']."') 
                    window.history.back();</script>");
                }
            } elseif ($action == 'BUSCAR') {
                $idProduto = $_GET['id'];

                $dados = buscarProduto($idProduto);

                session_start();

                $_SESSION['produtos'] = $dados;

                require_once('produtos.php');
            } elseif ($action == 'EDITAR') {
                $idProduto = $_GET['id'];
                $foto = $_GET['foto'];

                $arrayDados = array(
                    "id"   => $idProduto,
                    "foto" => $foto,
                    "file" => $_FILES
                );

                $promessa = atualizarProduto($_POST, $arrayDados);

                if (is_bool($promessa)) {
                    if ($promessa) {
                        echo("<script>alert('Produto atualizado com sucesso!') 
                            window.location.href = 'produtos.php';</script>");
                    }
                } elseif (is_array($promessa)) {
                    echo("<script>alert('".$promessa['message']."') 
                    window.history.back();</script>");
                }
            }

            break;
    }
}

?>