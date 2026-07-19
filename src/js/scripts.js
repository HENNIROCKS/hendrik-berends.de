import "fslightbox";

import { playVideoOnClick } from "./blocks/video.js";
import { activateMailtoLinks } from "./blocks/mailto.js";

document.addEventListener("DOMContentLoaded", () => {
  playVideoOnClick();
  activateMailtoLinks();

  document.querySelectorAll(".js-scrolltop-button").forEach((button) => {
    button.addEventListener("click", () => {
      window.location.href = "#top";
    });
  });
});
