<?php 
$form = (string) "router.php?component=categorias&action=inserir";

if (session_status()) {
    if(!empty($_SESSION['categorias'])) {
        $idCategoria = $_SESSION['categorias']['id'];
        $genero = $_SESSION['categorias']['genero'];

        $form = "router.php?component=categorias&action=editar&id=".$idCategoria;

        /* destruindo variável da memória do servidor */
        unset($_SESSION['categorias']);
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
    <link rel="stylesheet" type="text/css" href="css/categorias.css">
    <title>Cadastro de categorias</title>
</head>

<body>
    <?php
    require_once('header.php');
    ?>

    <div class="title">
        <span>Administração de categorias</span>
    </div>

    <form name="frmCategoria" method="post" action="<?= $form ?>">
        <div class="category">
            <div class="insert">
                <span class="gender">Gênero a inserir</span>
                <input type="text" name="txtGenero" value="<?=  isset($genero) ? $genero : null ?>" class="input-gender">
                <input type="submit" name="btnSalvar" value="Salvar" class="save-gender">
            </div>
        </div>
    </form>

    <div class="categories">
        <div class="categories-content">
            <div class="categoriesInfo">
                <label class="gender-data">Gênero</label>
                <label class="actions">Opções</label>
            </div>

            <?php
            /* import do arquivo que possui função para listar contatos */
            require_once('controller/controllerCategorias.php');

            /* chamando função para listar contatos */
            $listaCategoria = listarCategorias();

            /* verificando se a lista existe para evitar erro quando não houver categorias inseridas */
            if ($listaCategoria) {
                foreach ($listaCategoria as $generos) {

            ?>
                    <div class="categoriesData">
                        <span class="gender-data"><?= $generos['genero'] ?></span>
                        <span class="actions">
                            <a onclick="return confirm('Quer mesmo apagar a categoria <?= $generos['genero'] ?>?')" href="router.php?component=categorias&action=deletar&id=<?= $generos['idCategoria'] ?>">
                                <img src="img/delete.jpg" alt="apagar" title="apagar categoria">
                            </a>
                            <a href="router.php?component=categorias&action=buscar&id=<?= $generos['idCategoria'] ?>">
                                <img src="img/edit.png" alt="editar categoria" title="editar categoria" class="edit">
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