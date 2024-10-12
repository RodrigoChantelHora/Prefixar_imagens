<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numeroBase = $_POST['numeroBase'];
    $directory = '../Storage';
    $files = [];

    if (is_dir($directory)) {
        $dir = opendir($directory);
        while ($subdir = readdir($dir)) {
            if ($subdir != '.' && $subdir != '..' && strpos($subdir, $numeroBase) !== false) {
                $subdirPath = $directory . '/' . $subdir;
                if (is_dir($subdirPath)) {
                    $subDirHandle = opendir($subdirPath);
                    while ($file = readdir($subDirHandle)) {
                        if ($file != '.' && $file != '..') {
                            $filePath = $subdirPath . '/' . $file;
                            $filesize = filesize($filePath);
                            $files[] = ['name' => $file, 'size' => $filesize, 'path' => $filePath];
                        }
                    }
                    closedir($subDirHandle);
                }
            }
        }
        closedir($dir);
    }

    if (!empty($files)) {
        // Ordenar os arquivos em ordem crescente pelo nome
        usort($files, function($a, $b) {
            // Extrair a parte numérica do nome do arquivo
            preg_match('/_(\d+)(?=\.[^.]+$)|(?<=_)(?=\.[^.]+$)/', $a['name'], $matchesA);
            preg_match('/_(\d+)(?=\.[^.]+$)|(?<=_)(?=\.[^.]+$)/', $b['name'], $matchesB);
    
            $numA = isset($matchesA[1]) ? (int)$matchesA[1] : 0;
            $numB = isset($matchesB[1]) ? (int)$matchesB[1] : 0;
    
            // Comparar como inteiros
            return $numA - $numB;
        });
    
        foreach ($files as $file) {
            // Verifica se o nome do arquivo contém o caractere _
            if (strpos($file["name"], '_.') !== false) {
                echo '<tr>
                    <th scope="row">
                        <i class="fa-solid fa-circle-check text-success"></i>
                    </th>
                    <td>' . htmlspecialchars($file['name']) . '</td>
                    <td>' . round($file['size'] / 1024, 2) . ' KB</td>
                    <td>
                        <div class="w-100 d-flex justify-content-end">
                            <img class="me-2 rounded rounded-circle" style="width: 30px; height: 30px;" src="Storage/' . htmlspecialchars($file['path']) . '" class="img-fluid" alt="Imagem">
                            <button class="btn btn-sm btn-success text-white me-2" onclick="renameFile(this)" data-file="' . htmlspecialchars($file['path']) . '"><i class="fa-solid fa-arrows-rotate"></i></button>
                            <button class="btn btn-sm btn-dark me-2" onclick="printImage(\'Storage/' . htmlspecialchars($file['path']) . '\')"><i class="fa-solid fa-eye"></i></button>
                            <a class="btn btn-danger btn-sm text-white delete-file" data-file="' . htmlspecialchars($file['path']) . '" href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>';
            } else {
                echo '<tr>
                    <th scope="row">
                        <i class="fa-solid fa-circle-check text-success"></i>
                    </th>
                    <td>' . htmlspecialchars($file['name']) . '</td>
                    <td>' . round($file['size'] / 1024, 2) . ' KB</td>
                    <td>
                        <div class="w-100 d-flex justify-content-end">
                            <img class="me-2 rounded rounded-circle" style="width: 30px; height: 30px;" src="Storage/' . htmlspecialchars($file['path']) . '" class="img-fluid" alt="Imagem">
                            <button class="btn btn-sm btn-dark me-2" onclick="printImage(\'Storage/' . htmlspecialchars($file['path']) . '\')"><i class="fa-solid fa-eye"></i></button>
                            <a class="btn btn-danger btn-sm text-white delete-file" data-file="' . htmlspecialchars($file['path']) . '" href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>';
            }
        }
    } else {
        echo '<tr><td colspan="4" class="text-center">Nenhum arquivo encontrado.</td></tr>';
    }
    
}
?>
