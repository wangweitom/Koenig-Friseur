//This script is reponsible for showing slides on the website.
var slideIndex2 = 0;
var timeout2 = 10000;
showSlides2(slideIndex2);
setTimeout(autoSlides2, timeout2);

// previous slide
function lastSlides2() {
  showSlides2(slideIndex2 = slideIndex2 - 1);
}

//next slide
function nextSlides2() {
  showSlides2(slideIndex2 = slideIndex2 + 1);
}

// Thumbnail image controls
function currentSlide2(targetIndex) {
  showSlides2(slideIndex2 = targetIndex);
}

function showSlides2(imageIndex) {
  var slides = document.getElementsByClassName("slides2");
  if (imageIndex > slides.length - 1) {slideIndex2 = 0} 
  if (imageIndex < 0) {slideIndex2 = slides.length - 1}
  for (var i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex2].style.display = "block";
}

function autoSlides2() {
  nextSlides2();
  setTimeout(autoSlides2, timeout2);
}