/*!
 * Version - 1.0.0
 * author : khalil mecha
 * Copyright (c) 2021 khalil mecha
 */

const dragndropArea = document.getElementById('dragndrop');
const dragndropText = document.getElementById('text-desc');
const openUploader = document.getElementById('openUploader');

openUploader.addEventListener('click',()=>{  
  document.getElementById('documentHolder').click()
})

dragndropArea.addEventListener('dragover', (event)=>{
  event.preventDefault()
  dragndropText.textContent = 'Déposer le fichier ici pour télécharger'
})

dragndropArea.addEventListener('dragleave',(event)=>{
  dragndropText.textContent = 'Glisser ici pour télécharger le fichier'
})

dragndropArea.addEventListener('drop',(event)=>{
  event.preventDefault()
  holdFiles(event.dataTransfer.files);
})

function holdFiles(files) {
  document.getElementById('documentHolder').files = files;
}