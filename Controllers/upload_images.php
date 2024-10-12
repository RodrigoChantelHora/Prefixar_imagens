<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prefixo = isset($_POST['prefixo']) ? $_POST['prefixo'] : '';
    $numeroBase = isset($_POST['numeroBase']) ? $_POST['numeroBase'] : '';
    $sufixo = isset($_POST['sufixo']) ? $_POST['sufixo'] : '';
    $uploadDir = '../Storage';
    
    // Verificar se o número base foi fornecido
    if (empty($numeroBase)) {
        echo 'Número base é obrigatório.';
        exit;
    }

    // Criar o diretório se não existir
    $directory = $uploadDir . '/' . "P_" . $numeroBase;
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    // Processar cada arquivo enviado
    $files = $_FILES['formFileSm'];
    $totalFiles = count($files['name']);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    // Contador para gerar o sufixo numérico das imagens
    $counter = "";
    $existingFiles = scandir($directory);

    // Encontrar o próximo número disponível para nomear as imagens
    foreach ($existingFiles as $file) {
        if (preg_match('/_(\d+)\./', $file, $matches)) {
            $num = (int)$matches[1];
            if ($num >= $counter) {
                $counter = $num + 1;
            }
        }
    }

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileTmpPath = $files['tmp_name'][$i];
        $fileName = $files['name'][$i];
        $fileSize = $files['size'][$i];
        $fileType = $files['type'][$i];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        
        // Verificar se a extensão do arquivo é permitida
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            echo 'Arquivo ' . $fileName . ' não é uma imagem válida.<br>';
            continue;
        }

        $newFileName = "P_" . $numeroBase . '_' . $counter . '.' . $fileExtension;
        $destination = $directory . '/' . $newFileName;

        // Verificar o tamanho do arquivo (max 3MB)
        if ($fileSize > 3 * 1024 * 1024) {
            echo 'Arquivo ' . $fileName . ' excede o tamanho máximo de 3MB.<br>';
            continue;
        }

        // Mover o arquivo para o destino
        if (move_uploaded_file($fileTmpPath, $destination)) {
            var_dump('Arquivo ' . $newFileName . ' carregado com sucesso.');
            $counter++;
        } else {
            echo 'Erro ao carregar o arquivo ' . $fileName . '.';
        }
    }
}
?>
