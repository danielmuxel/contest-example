window.addEventListener("load", function () {
  alert("It's loaded!");
});

const buttonNext = document.querySelector(".button-next");
const buttonPrev = document.querySelector(".button-prev");

buttonNext.addEventListener("click", function () {
  nextPrev(1);
});

buttonPrev.addEventListener("click", function () {
  nextPrev(-1);
});

function nextPrev(number) {
  // logic here
}
