<?php
    include('Views/Layouts/app.php');
    echo $section;
    include_once('Views/Pages/Includes/alerts.php');
    include_once('Views/Pages/Includes/preview.php');
?>

<div class="container-md mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Gerenciador de Diretórios (Imagens) - Motociclo
                </div>
                <div class="card-body">
                    <form id="uploadForm" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="prefixo" class="form-label">Prefixo <span class="text-info">(Opcional)</span></label>
                                    <input type="text" class="form-control form-control-sm" id="prefixo" name="prefixo" placeholder="P_" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="numeroBase" class="form-label">Produto</label>
                                    <input type="text" class="form-control form-control-sm" id="numeroBase" name="numeroBase" placeholder="Número base ou nome *" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sufixo" class="form-label">Sufixo Padrão _1 _2 _3...</label>
                                    <input type="text" class="form-control form-control-sm" id="sufixo" name="sufixo" placeholder="_Sufixo" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Selecione as imagens - <span class="text-danger" style="font-size: 12px;">Max 3MB por imagem</span></label>
                                    <input class="form-control form-control-sm" id="formFileSm" name="formFileSm[]" type="file" multiple required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar Processo</button>
                        <button type="reset" class="btn btn-danger">Limpar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-md mt-3 pb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Pre-visualização
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm d-table">
                        <thead>
                            <tr>
                                <th scope="col">Disponível</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Tamanho</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="fileList" class="d-block overflow-auto" style="max-height:300px !important;">
                            <?php
                                if (!empty($files)) {
                                    foreach ($files as $file) {
                                        echo '<tr>
                                                <th scope="row">
                                                    <i class="fa-solid fa-circle-check text-success"></i>
                                                </th>
                                                <td>' . htmlspecialchars($file['name']) . '</td>
                                                <td>' . round($file['size'] / 1024, 2) . ' KB</td>
                                                <td>
                                                    <div class="w-100 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-secondary me-2 btn-sm view-image-btn" data-bs-toggle="modal" data-bs-target="#exampleModal-' . htmlspecialchars($file['name']) . '"><i class="fa-solid fa-eye"></i></button>
                                                        <a class="btn btn-secondary btn-sm text-white delete-file" data-file="' . htmlspecialchars($file['path']) . '" href="#"><i class="fa-solid fa-trash"></i></a>
                                                    </div>
                                                </td>
                                              </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4" class="text-center">Nenhum arquivo encontrado.</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    echo $endSection;
?>
