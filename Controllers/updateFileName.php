<?php
// updateFileName.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filePath = isset($_POST['filePath']) ? $_POST['filePath'] : '';

    if (empty($filePath)) {
        echo 'error: Dados incompletos';
        exit;
    }

    // Extrair o diretório do caminho
    $directory = pathinfo($filePath, PATHINFO_DIRNAME);

    // Novo nome do arquivo com o "_" removido antes da extensão
    $fileName = pathinfo($filePath, PATHINFO_FILENAME);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

    // Verificar se o nome do arquivo termina com "_"
    if (substr($fileName, -1) == '_') {
        $newFileName = substr($fileName, 0, -1) . '.' . $extension;
    } else {
        $newFileName = $fileName . '.' . $extension;
    }

    // Novo caminho completo do arquivo
    $newFilePath = $directory . '/' . $newFileName;

    // Renomear o arquivo
    if (rename($filePath, $newFilePath)) {
        echo 'success';
    } else {
        echo 'error: Falha ao renomear o arquivo';
    }
}
?>
