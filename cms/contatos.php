<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Rokkitt&display=swap" rel="stylesheet">
    <link rel="stylesheet" text="text/css" href="css/reset.css">
    <link rel="stylesheet" text="text/css" href="css/header.css">
    <link rel="stylesheet" text="text/css" href="css/contatos.css">
    <title>Administrativo</title>
</head>

<body>
    <?php
    require_once('header.php');
    ?>

    <div class="title">
        <span>Contatos</span>
    </div>

    <div class="contacts">

        <div class="contactInfo">
            <label class="name">Nome</label>
            <label class="email">E-mail</label>
            <label class="options">Opções</label>
        </div>

        <?php
        /* import do arquivo que possui função para listar contatos */
        require_once('controller/controllerContatos.php');

        $listaContato = listarContatos();
        if ($listaContato) {
            foreach ($listaContato as $dados) {

        ?>
                <div class="contactData">
                    <span class="name"><?= $dados['nome'] ?></span>
                    <span class="email"><?= $dados['email'] ?></span>
                    <span class="options">
                        <a onclick="return confirm('Quer mesmo apagar o feedback de <?= $dados['nome'] ?>?')" href="router.php?component=contatos&action=deletar&id=<?= $dados['idContato'] ?>">
                            <img src="img/delete.jpg" alt="apagar" title="apagar contato">
                        </a>
                    </span>
                </div>
        <?php
            }
        }

        ?>

    </div>

</body>

</html>