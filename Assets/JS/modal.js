function printImage(filePath) {
    const image = filePath;
    const modal = document.getElementById('printModal'); // Certifique-se de que o ID do modal está correto
    const showImage = document.getElementById('showImage'); // Certifique-se de que o ID do elemento para exibir a imagem está correto

    if (modal && showImage) {
        modal.style.display = "block";
        showImage.innerHTML = `<img src="${image}" alt="Imagem" style="width:80%;">`;
        
    } else {
        console.error('Modal or showImage element not found.');
    }
}

function exitModal(){
    const modal = document.getElementById('printModal');
    const showImage = document.getElementById('showImage'); 
        if (modal && showImage) {
            modal.style.display = "none";
            showImage.innerHTML = ``;
            
        } else {
            console.error('Modal or showImage element not found.');
        }
}