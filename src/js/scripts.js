import { playVideoOnClick } from "./blocks/video.js";
import { activateMailtoLinks } from "./blocks/mailto.js";
import { revealLoadedImages } from "./blocks/image.js";
import { initSliders } from "./blocks/slider.js";
import { initLightbox } from "./lightbox.js";

document.addEventListener("DOMContentLoaded", () => {
  playVideoOnClick();
  activateMailtoLinks();
  // First, because the slider clones slides for its loop: the clones
  // need to be in the DOM before the images are wired up for the fade-in
  // (they would stay invisible otherwise) and before GLightbox collects
  // its links (the clones are deliberately not part of any gallery).
  initSliders();
  revealLoadedImages();
  initLightbox();

  document.querySelectorAll(".js-scrolltop-button").forEach((button) => {
    button.addEventListener("click", () => {
      window.location.href = "#top";
    });
  });
});
