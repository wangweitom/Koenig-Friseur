//This script is reponsible for showing slides on the website.
var slideIndex1 = 0;
var timeout1 = 10000;
showSlides1(slideIndex1);
setTimeout(autoSlides1, timeout1);

// previous slide
function lastSlides1() {
  showSlides1(slideIndex1 = slideIndex1 - 1);
}

//next slide
function nextSlides1() {
  showSlides1(slideIndex1 = slideIndex1 + 1);
}

// Thumbnail image controls
function currentSlide1(targetIndex) {
  showSlides1(slideIndex1 = targetIndex);
}

function showSlides1(imageIndex) {
  var slides = document.getElementsByClassName("slides1");
  if (imageIndex > slides.length - 1) {slideIndex1 = 0}
  if (imageIndex < 0) {slideIndex1 = slides.length - 1}
  for (var i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex1].style.display = "block";
}

function autoSlides1() {
  nextSlides1();
  setTimeout(autoSlides1, timeout1);
}