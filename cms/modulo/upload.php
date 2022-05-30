<?php
function uploadFile($arrayFile) 
{
    require_once('modulo/config.php');

    $arquivo = $arrayFile;
    $sizeFile = (int) 0;
    $typeFile = (string) null;
    $nameFile = (string) null;
    $tempFile = (string) null;

    if ($arquivo['size'] > 0 && $arquivo['type'] != "") {
        $sizeFile = $arquivo['size'] / 1024;
        $typeFile = $arquivo['type'];
        $nameFile = $arquivo['name'];
        $tempFile = $arquivo['tmp_name'];

        if ($sizeFile <= MAX_SIZE_FILE_UPLOAD) {
            if (in_array($typeFile, FILE_EXT_UPLOAD)) {
                $nome = pathinfo($nameFile, PATHINFO_FILENAME);
                $extensao = pathinfo($nameFile, PATHINFO_EXTENSION);

                $nomeCriptografado = md5($nome . uniqid(time()));
                $foto = $nomeCriptografado . "." . $extensao;

                if (move_uploaded_file($tempFile, FILE_DIRECTORY_UPLOAD . $foto)) {
                    return $foto;
                }  else {
                    return array(
                        'idErro'  => 13,
                        'message' => 'Não foi possível fazer upload no arquivo no servidor.'
                    );
                }
            } else {
                return array(
                    'idErro'  => 12,
                    'message' => 'Extensão do arquivo inválida para upload.'
                );
            }
        } else {
            return array(
                'idErro'  => 10,
                'message' => 'Arquivo grande demais para upload.'
            );
        }
    } else {
        return array(
            'idErro'  => 11,
            'message' => 'Não foi possível fazer upload de imagem. Arquivo não selecionado.'
        );
    }
}


?>