// script.js - update image and simple preview (no live price calc)
document.addEventListener('DOMContentLoaded', function(){
    const colorSelect = document.getElementById('colorSelect');
    const carImage = document.getElementById('carImage');
    if(!colorSelect || !carImage) return;
    function updatePreview(){
        const colorVal = colorSelect.value.split('|')[0];
        carImage.src = 'images/' + colorVal;
    }
    colorSelect.addEventListener('change', updatePreview);
    updatePreview();
});