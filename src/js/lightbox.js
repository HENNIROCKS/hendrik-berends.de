import GLightbox from "glightbox";

export function initLightbox() {
  const reducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;

  return GLightbox({
    // GLightbox would default to ".glightbox"; the project binds JS
    // behaviour to "js-" classes only.
    selector: ".js-lightbox",
    loop: true,
    openEffect: reducedMotion ? "none" : "zoom",
    closeEffect: reducedMotion ? "none" : "zoom",
    slideEffect: reducedMotion ? "none" : "slide",
  });
}
