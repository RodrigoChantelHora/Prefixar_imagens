<?php

$section = "
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Gerenciador</title>
    <link rel='stylesheet' href='Assets/CSS/bootstrap.css'>
    <link rel='stylesheet' href='Assets/CSS/custom.css'>
    <script src='Assets/JS/modal.js'></script>
</head>
<body class='bg-secondary'>
<header>
<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <div class='container-fluid'>
        <a class='navbar-brand fw-bold' href='#'>GDIR <span class='text-danger'>Motociclo</span></a>
    </div>
</nav>
</header>
";

    
$endSection = "
<script src='Assets/JS/fontawesome.js'></script>
<script src='Assets/JS/bootstrap.js'></script>
<script>
    $(document).ready(function() {
        $('.view-image-btn').on('click', function() {
            var fileName = $(this).data('file');
            var imagePath = $(this).data('image-path'); // Verifique se está passando corretamente o caminho da imagem

            $('#modalImage').attr('src', imagePath);
        });
    });
</script>
<script src='Assets/JS/jquery-3.3.1.min.js'></script>
<script src='Assets/JS/search-exists.js'></script>
<script src='Assets/JS/update-name.js'></script>
</body>
</html>
";