$(document).ready(function(){
    $('#numeroBase').on('input', function(){
        var numeroBase = $(this).val();
        
        if(numeroBase.length > 0) {
            $.ajax({
                url: 'Controllers/check_directory.php',
                type: 'POST',
                data: { numeroBase: numeroBase },
                success: function(response) {
                    $('#fileList').html(response);
                    // Attach event handler for delete buttons
                    $('.delete-file').on('click', function(e){
                        e.preventDefault();
                        var filePath = $(this).data('file');
                        $.ajax({
                            url: 'Controllers/delete_file.php',
                            type: 'POST',
                            data: { file: filePath },
                            success: function(response) {
                                if (response == 'success') {
                                    //alert('Arquivo deletado com sucesso');

                                    const alerts = document.getElementById('alerts');
                                    const success = document.getElementById('alert-success');

                                    alerts.style.display = "block";
                                    success.style.display = "block";
                                    success.innerHTML = "Arquivo deletado com sucesso";
                                    setTimeout(function(){
                                        alerts.style.display = "none";
                                        success.style.display = "none";
                                    }, 3000);
                                    $('#numeroBase').trigger('input'); // Refresh the file list
                                } else {
                                    alert('Falha ao deletar arquivo');
                                }
                            }
                        });
                    });
                }
            });
        } else {
            $('#fileList').html('<tr><td colspan="4" class="text-center">Nenhum arquivo encontrado.</td></tr>');
        }
    });

    $('#formFileSm').on('change', function(){
        var files = this.files;
        var fileList = $('#fileList');
        var existingRows = fileList.html(); // Save existing rows

        var newFilesHtml = '';
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.size <= 3 * 1024 * 1024) { // Check file size
                newFilesHtml += '<tr>' +
                    '<th scope="row"><i class="fa-solid fa-circle-check text-success"></i></th>' +
                    '<td>' + file.name + '</td>' +
                    '<td>' + (file.size / 1024).toFixed(2) + ' KB</td>' +
                    '<td>' +
                        '<div class="w-100 d-flex justify-content-end">' +
                            '<a class="btn btn-secondary btn-sm text-white delete-file" data-file="' + file.name + '" href="#"><i class="fa-solid fa-trash"></i></a>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
            } else {
                alert('O arquivo ' + file.name + ' excede o tamanho máximo de 3MB.');
            }
        }
        
        // Append new files to the existing ones
        fileList.html(existingRows + newFilesHtml);

        // Attach event handler for delete buttons
        $('.delete-file').on('click', function(e){
            e.preventDefault();
            var fileName = $(this).data('file');
            $(this).closest('tr').remove();
        });
    });

    $('#uploadForm').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'Controllers/upload_images.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                //alert(response);
                // Atualizar a lista de arquivos se necessário
                const alerts = document.getElementById('alerts');
                const success = document.getElementById('alert-success');

                success.innerHTML = '';

                alerts.style.display = "block";
                success.style.display = "block";
                success.innerText = response;
                setTimeout(function(){
                    alerts.style.display = "none";
                    success.style.display = "none";
                }, 3000);
                $('#numeroBase').trigger('input'); // Refresh the file list
            },
            error: function(xhr, status, error) {
                //alert('Erro ao enviar o formulário: ' + error);
                const alerts = document.getElementById('alerts');
                const alertError = document.getElementById('alert-error');

                alerts.style.display = "block";
                alertError.style.display = "block";
                alertError.innerHTML = "Erro ao enviar o formulário: " + error;
                setTimeout(function(){
                    alerts.style.display = "none";
                    alertError.style.display = "none";
                }, 3000);
                $('#numeroBase').trigger('input'); // Refresh the file list
            }
        });
    });

});
