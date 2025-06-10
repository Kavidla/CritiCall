let currentSlide = 0;

function moveSlide(direction) {
  const slider = document.getElementById('slider');
  const slideWidth = slider.children[0].offsetWidth + 10; // ancho de imagen + margen
  const totalSlides = slider.children.length;
  const visibleSlides = Math.floor(document.querySelector('.slider-wrapper').offsetWidth / slideWidth);

  currentSlide += direction;

  // Control infinito
  if (currentSlide > totalSlides - visibleSlides) {
    currentSlide = 0; 
  } else if (currentSlide < 0) {
    currentSlide = totalSlides - visibleSlides; 
  }

  slider.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
}

document.getElementById('fotoInput').addEventListener('change', function(e) {
  const file = e.target.files[0];
  const preview = document.getElementById('preview');

  if (file) {
    const reader = new FileReader();
    reader.onload = () => preview.src = reader.result;
    reader.readAsDataURL(file);
  }
});


document.getElementById('perfilForm').addEventListener('submit', function(e) {
  e.preventDefault();
  alert('Cambios guardados con éxito (simulado)');
});
