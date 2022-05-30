<?php
/* inicindo a url como sendo sempre de inserir */
$form = (string) "router.php?component=usuarios&action=inserir";

/* se a variável estiver ativa, armazena tais variáveis e altera a url indicando que a action é de editar */
if (session_status()) {
    if (!empty($_SESSION['usuarios'])) {
        $idUsuario = $_SESSION['usuarios']['id'];
        $nome      = $_SESSION['usuarios']['nome'];
        $login     = $_SESSION['usuarios']['login'];
        $senha     = $_SESSION['usuarios']['senha'];

        $form = "router.php?component=usuarios&action=editar&id=" . $idUsuario;

        /* destruindo variável de sessão */
        unset($_SESSION['usuarios']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Rokkitt&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/usuarios.css">
    <title>Usuários</title>
</head>

<body>
    <?php
    require_once('header.php');
    ?>

    <div class="title">
        <span>Administração de usuários</span>
    </div>

    <form name="frmUsuario" method="post" action="<?= $form ?>">
        <div class="user-cadaster">
            <div class="insert">
                <span class="user-insert">Usuário a inserir</span>
                <div class="name-area">
                    <label>Nome</label>
                    <input type="text" name="txtNome" class="input-name" value="<?= isset($nome) ? $nome : null ?>">
                </div>
                <div class="login-area">
                    <label>Login</label>
                    <input type="text" name="txtLogin" class="input-login" value="<?= isset($login) ? $login : null ?>">
                </div>
                <div class="passwd-area">
                    <label>Senha</label>
                    <input type="password" name="txtSenha" class="input-password" value="<?= isset($senha) ? $senha : null ?>">
                </div>
                <input type="submit" name="btnSalvar" value="Salvar" class="save-user">
            </div>
        </div>
    </form>

    <div class="users">
        <div class="users-content">
            <div class="usersInfo">
                <label class="user-data">Nome</label>
                <label class="user-data">Login</label>
                <label class="actions">Opções</label>
            </div>

            <?php
            /* import do arquivo que possui função para listar contatos */
            require_once('controller/controllerUsuarios.php');

            /* chamando função para listar contatos */
            $listaUsuarios = listarUsuarios();

            /* verificando se a lista existe para evitar erro quando não houver categorias inseridas */
            if ($listaUsuarios) {
                foreach ($listaUsuarios as $usuarios) {

            ?>

                    <div class="usersData">
                        <span class="user-data"><?= $usuarios['nome'] ?></span>
                        <span class="user-data"><?= $usuarios['login'] ?></span>
                        <span class="actions">
                            <a onclick="return confirm('Quer mesmo apagar usuário?')" href="router.php?component=usuarios&action=deletar&id=<?= $usuarios['idUsuario'] ?>">
                                <img src="img/delete.jpg" alt="apagar" title="apagar usuário">
                            </a>
                            <a href="router.php?component=usuarios&action=buscar&id=<?= $usuarios['idUsuario'] ?>">
                                <img src="img/edit.png" alt="editar usuario" title="editar usuário" class="edit">
                            </a>
                        </span>
                    </div>

            <?php
                }
            }

            ?>

        </div>

    </div>
</body>

</html>