let currentSlide = 0;

function moveSlide(direction) {
  const slider = document.getElementById('slider');
  const slideWidth = slider.children[0].offsetWidth + 10; // ancho de imagen + margen
  const totalSlides = slider.children.length;
  const visibleSlides = Math.floor(document.querySelector('.slider-wrapper').offsetWidth / slideWidth);

  currentSlide += direction;

  // Control infinito
  if (currentSlide > totalSlides - visibleSlides) {
    currentSlide = 0; // reinicia al principio
  } else if (currentSlide < 0) {
    currentSlide = totalSlides - visibleSlides; // salta al final
  }

  slider.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
}
