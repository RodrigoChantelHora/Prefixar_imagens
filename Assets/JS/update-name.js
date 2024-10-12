function renameFile(button) {
    var filePath = button.getAttribute('data-file');

    // Enviar requisição AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'Controllers/updateFileName.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'success') {
                    // Atualizar a interface ou fazer qualquer outra ação necessária
                    console.log('Arquivo renomeado com sucesso!');
                    // Exemplo de atualização da interface após renomear o arquivo
                    // Aqui você pode atualizar a lista de arquivos, se necessário
                    // Por exemplo, recarregar a lista de arquivos após a renomeação
                    // location.reload(); // Isso recarregaria a página, mas depende do seu fluxo de aplicação
                } else {
                    console.error('Erro ao renomear o arquivo: ' + response);
                }
            } else {
                console.error('Erro ao renomear o arquivo. Código de status: ' + xhr.status);
            }
        }
    };
    xhr.send('filePath=' + encodeURIComponent(filePath));
    $('#numeroBase').trigger('input'); // Refresh the file list
}