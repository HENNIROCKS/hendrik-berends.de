import "fslightbox";

import { playVideoOnClick } from "./blocks/video.js";
import { activateMailtoLinks } from "./blocks/mailto.js";
import { revealLoadedImages } from "./blocks/image.js";

document.addEventListener("DOMContentLoaded", () => {
  playVideoOnClick();
  activateMailtoLinks();
  revealLoadedImages();

  document.querySelectorAll(".js-scrolltop-button").forEach((button) => {
    button.addEventListener("click", () => {
      window.location.href = "#top";
    });
  });
});
