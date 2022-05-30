<?php
require_once('modulo/config.php');

$form = (string) "router.php?component=produtos&action=inserir";

$foto = (string) null;

$destacar = null;

$idCategorias = (string) null;

if (session_status()) {
    if (!empty($_SESSION['produtos'])) {
        $idProduto    = $_SESSION['produtos']['id'];
        $titulo       = $_SESSION['produtos']['titulo'];
        $autor        = $_SESSION['produtos']['autor'];
        $descricao    = $_SESSION['produtos']['descricao'];
        $foto         = $_SESSION['produtos']['foto'];
        $preco        = $_SESSION['produtos']['preco'];
        $desconto     = $_SESSION['produtos']['desconto'];
        $precoDescontado = $_SESSION['produtos']['precoDescontado'];
        $destacar     = $_SESSION['produtos']['destacar']; 
        $idCategorias = $_SESSION['produtos']['idCategorias'];

        $form = "router.php?component=produtos&action=editar&id=" . $idProduto . "&foto=" . $foto;

        /* destruindo variável de sessão */
        unset($_SESSION['produtos']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/produtos.css">
    <script src="js/imagePreview.js" defer></script>
    <title>Administração de produtos</title>
</head>

<body>
    <?php
    require_once('header.php')
    ?>

    <div class="header-title">
        <span>Administração de produtos</span>
    </div>

    <form name="frmProduto" method="post" action="<?= $form ?>" enctype="multipart/form-data">
        <div class="product-insert">
            <div class="product">
                <div class="image-container">
                    <input type="file" id="image-input" accept="image/*" name="fileFoto">
                    <label for="image-input" id="image-label"></label>
                    <img src="<?= $foto ? FILE_DIRECTORY_UPLOAD . $foto : 'img/add-image.png'?>" alt="foto do livro" id="cadaster-image">
                </div>
                <div class="highlight">
                    <input type="checkbox" id="highlight" name="chkDestacar" <?=$destacar == '1' ? 'checked' : null ?>>
                    <label for="highlight">Destacar</label>
                </div>
                <select name="sltCategorias">
                    <option value="">Selecione uma categoria</option>
                    <?php
                        require_once('controller/controllerCategorias.php');

                        $listaCategorias = listarCategorias();

                        foreach ($listaCategorias as $categoria) {

                        ?>
                            <option <?= $idCategorias == $categoria['idCategoria'] ? 'selected' : null ?> value="<?= $categoria['idCategoria'] ?>"><?= $categoria['genero'] ?></option>
                            <?php
                                }
                            ?>
                </select>
                <div class="prices">
                    <div class="price">
                        <span>Preço (R$)</span>
                        <input type="number" step="0.1" name="txtPreco" value="<?= isset($preco) ? $preco : null ?>">
                    </div>
                    <div class="promotion">
                        <span title="Opcional">Desconto (%)*</span>
                        <input type="number" step="0.1" name="txtDesconto" placeholder="10" value="<?= isset($desconto) ? $desconto : null ?>">
                    </div>
                </div>
            </div>
            <div class="description">
                <div class="title">
                    <span>Título</span>
                    <input type="text" name="txtTitulo" value="<?= isset($titulo) ? $titulo : null ?>">
                </div>
                <div class=" author">
                    <span>Autor</span>
                    <input type="text" name="txtAutor" value="<?= isset($autor) ? $autor : null ?>">
                </div>
                <div class=" describe-book">
                    <span>Descrição</span>
                    <textarea name="txtDescricao" value=""><?= isset($descricao) ? $descricao : null ?></textarea>
                </div>
                <div class=" send">
                    <input type="submit" name="btnSalvar" value="Salvar" class="save-product">
                </div>
            </div>
        </div>
    </form>

    <div class="products">
        <div class="products-content">
            <label class="product-data">Preview</label>
            <label class="product-data">Título</label>
            <label class="product-data">Autor</label>
            <label class="product-data">Categoria</label>
            <label class="product-data">Preço/Desconto(%)</label>
            <label class="product-data">Destacado</label>
            <label class="product-data">Opções</label>
        </div>

        <?php
        require_once('controller/controllerProdutos.php');

        $listaProdutos = listarProdutos();

        if ($listaProdutos) {
            foreach ($listaProdutos as $produtos) {

                $foto = $produtos['foto'];

        ?>
                <div class="products-data">
                    <span class="product-data"><img src="<?= FILE_DIRECTORY_UPLOAD . $foto ?>" alt="foto do produto"></span>
                    <span class="product-data"><?= $produtos['titulo'] ?></span>
                    <span class="product-data"><?= $produtos['autor'] ?></span>
                    <span class="product-data"><?= $produtos['genero'] ?></span>
                    <span class="product-data">R$ <?= $produtos['preco'] ?> <?= $produtos['desconto'] ? ' / ' . $produtos['desconto'] . '%' : null ?></span>
                    <span class="product-data"><img src="<?= $produtos['destacar'] == '1' ? 'img/com-destaque.png' : 'img/sem-destaque.png' ?>" alt=""></span>
                    <span class="product-data">
                        <a onclick="return confirm('Quer mesmo apagar produto?')" href="router.php?component=produtos&action=deletar&id=<?= $produtos['id'] ?>&foto=<?= $foto ?>">
                            <img src="img/delete.jpg" alt="apagar" title="apagar produto">
                        </a>
                        <a href="router.php?component=produtos&action=buscar&id=<?= $produtos['id'] ?>">
                            <img src="img/edit.png" alt="editar" title="editar produto" class="edit">
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