const inputFoto = document.getElementById('foto');
const preview = document.getElementById('preview');
const contenido = document.getElementById('upload-content');
const removeBtn = document.getElementById('remove-image');

inputFoto.addEventListener('change', function(){
    const archivo = this.files[0];
    if(!archivo) return;
    const reader = new FileReader();
    reader.onload = function(e){
        preview.src = e.target.result;
        preview.style.display = 'block';
        contenido.style.display = 'none';
        removeBtn.style.display = 'block';
    };
    reader.readAsDataURL(archivo);
});

removeBtn.addEventListener('click', function(){
    inputFoto.value = '';
    preview.src = '';
    preview.style.display = 'none';
    contenido.style.display = 'block';
    removeBtn.style.display = 'none';
});