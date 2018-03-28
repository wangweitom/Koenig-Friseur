//This script is reponsible for showing slides on the website.
var slideIndex0 = 0;
var timeout0 = 10000;
showSlides0(slideIndex0);
setTimeout(autoSlides0, timeout0);

// previous slide
function lastSlides0() {
  showSlides0(slideIndex0 = slideIndex0 - 1);
}

//next slide
function nextSlides0() {
  showSlides0(slideIndex0 = slideIndex0 + 1);
}

// Thumbnail image controls
function currentSlide0(targetIndex) {
  showSlides0(slideIndex0 = targetIndex);
}

function showSlides0(imageIndex) {
  var slides = document.getElementsByClassName("slides0");
  if (imageIndex > slides.length - 1) {slideIndex0 = 0} 
  if (imageIndex < 0) {slideIndex0 = slides.length - 1}
  for (var i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex0].style.display = "block";
}

function autoSlides0() {
  nextSlides0();
  setTimeout(autoSlides0, timeout0);
}